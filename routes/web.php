<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Mail;
use App\Models\Lead;
use App\Models\Order;
use App\Models\Subscription;
use App\Models\Visit;
use App\Models\AdminMessage;
use App\Models\Promo;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use App\Models\ContactMessage;
use App\Http\Controllers\AdminAuthController;
use App\Mail\ContactMessage as ContactMessageMailable;

Route::group(['prefix' => '{locale?}'], function () {
    Route::get('/', fn () => view('home'))->name('home');
    Route::get('/about', fn () => view('about'))->name('about');
    Route::get('/services', fn () => view('services'))->name('services');
    Route::get('/packages', fn () => view('packages'))->name('packages');
    Route::get('/portfolio', fn () => view('portfolio'))->name('portfolio');
    Route::get('/blog', fn () => view('blog'))->name('blog');
    Route::get('/contact', fn () => view('contact'))->name('contact');
    Route::get('/quote', function (Request $request) {
        $pkg = $request->query('package');
        return view('quote', compact('pkg'));
    })->name('quote');
    Route::post('/contact', function (Request $request) {
        Log::info('Contact POST received', [
            'path' => $request->path(),
            'locale' => app()->getLocale(),
            'host' => $request->getHost(),
            'keys' => array_keys($request->all()),
        ]);
        // Honeypot field (bots fill hidden field)
        if ($request->filled('hp_field')) {
            Log::warning('Contact honeypot triggered', [
                'ip' => $request->ip(),
                'ua' => substr((string) $request->header('User-Agent'), 0, 200),
            ]);
            return back();
        }

        $data = $request->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:50',
            'budget' => 'nullable|string|max:100',
            'message' => 'required|string|min:10',
        ]);
        Log::info('Contact validation passed', ['email' => $data['email'] ?? null]);

        // Throttle by IP: max 5 per hour (only in production)
        if (app()->environment('production')) {
            $key = 'contact:' . $request->ip();
            if (RateLimiter::tooManyAttempts($key, 5)) {
                return back()->withErrors(['rate' => __('quote.rate_limit')])->withInput();
            }
            RateLimiter::hit($key, 3600);
        }

        // Persist message for inbox
        try {
            $msg = ContactMessage::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'budget' => $data['budget'] ?? null,
                'message' => $data['message'],
                'locale' => app()->getLocale(),
                'source' => 'contact',
                'ip' => $request->ip(),
                'user_agent' => substr((string) $request->header('User-Agent'), 0, 500),
                'path' => '/'.$request->path(),
        'referrer' => (string) $request->headers->get('referer'),
            ]);
            Log::info('Contact saved', ['id' => $msg->id]);
        } catch (\Throwable $e) {
            Log::error('Failed to save contact message', ['error' => $e->getMessage()]);
        }

        // Send Mailable to admin
        $to = config('site.admin_email') ?? config('mail.from.address');
        try {
            Mail::to($to)->send(new ContactMessageMailable($data));
            Log::info('Contact mail dispatched');
        } catch (\Throwable $e) {
            Log::error('Failed to send contact mail', ['error' => $e->getMessage()]);
        }
        Log::info('Contact finished, redirecting back with success');
        return back()->with('status', __('contact.form.success'));
    })->name('contact.submit');
})->where(['locale' => 'ar|en|fr']);

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['ar', 'en', 'fr'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
});

Route::get('/hello', function () {
    return view('hello');
})->name('hello');

// Sitemap (basic)
Route::get('/sitemap.xml', function () {
    $base = url('/');
    $locales = ['en','fr','ar'];
    $paths = ['','about','services','packages','portfolio','blog','contact','quote'];
    $now = now()->toAtomString();
    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach ($locales as $locale) {
        foreach ($paths as $p) {
            $loc = rtrim($base, '/').'/'.$locale.($p ? '/'.$p : '');
            $priority = $p === '' ? '1.0' : '0.7';
            $xml .= '<url>';
            $xml .= '<loc>'.e($loc).'</loc>';
            $xml .= '<lastmod>'.e($now).'</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>'.$priority.'</priority>';
            $xml .= '</url>';
        }
    }
    $xml .= '</urlset>';
    return response($xml, 200)->header('Content-Type', 'application/xml');
});

// Legacy non-localized routes (optional fallbacks). Limit to GET to avoid redirecting POST submissions.
Route::get('/services', fn() => redirect('/'.app()->getLocale().'/services'));
Route::get('/packages', fn() => redirect('/'.app()->getLocale().'/packages'));
Route::get('/contact', fn() => redirect('/'.app()->getLocale().'/contact'));
Route::get('/quote', fn() => redirect('/'.app()->getLocale().'/quote'));

// Chat API removed per request; endpoint disabled.

// Admin Auth (session-based)
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

// Admin area (requires session auth)
Route::middleware('admin.auth')->prefix('admin')->group(function () {
    $dashboard = function () {
        $visits = Visit::count();
        $leads = Lead::count();
        $ordersCount = Order::count();
        $subsCount = Subscription::count();
        $inboxCount = ContactMessage::count();
        $recentOrders = Order::latest()->take(5)->get(['created_at','customer_name','total_cents','currency','status']);
        $recentSubs = Subscription::latest()->take(5)->get(['created_at','email','plan','status']);
        return view('admin.dashboard', compact('visits','leads','ordersCount','subsCount','inboxCount','recentOrders','recentSubs'));
    };

    Route::get('/', $dashboard)->name('admin.dashboard');
    Route::get('/dashboard', $dashboard)->name('admin.dashboard.page');

    // Promo/Vlog editor
    Route::get('/promo', function () {
        $promo = Promo::query()
            ->when(request('locale'), fn($q,$loc) => $q->where('locale', $loc))
            ->latest('id')
            ->first();
        return view('admin.promo', compact('promo'));
    })->name('admin.promo');
    Route::post('/promo', function (Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'nullable|string',
            'cta' => 'nullable|string|max:120',
            'link' => 'nullable|string|max:500',
            'image_path' => 'nullable|string|max:500',
            'image' => 'nullable|image|max:5120', // up to ~5MB
            'locale' => 'nullable|string|in:en,fr,ar',
        ]);

        // If a file was uploaded, store it and override image_path
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('promos', 'public');
            // public disk URLs resolve under /storage
            $data['image_path'] = 'storage/' . $path;
        }

        // Normalize locale: empty string -> null (global)
        $data['locale'] = ($data['locale'] ?? null) !== '' ? ($data['locale'] ?? null) : null;
        // Normalize link: empty string -> null so the homepage falls back to blog route
        if (array_key_exists('link', $data) && trim((string)$data['link']) === '') {
            $data['link'] = null;
        }
        $promo = Promo::query()
            ->when($data['locale'] ?? null, fn($q,$loc) => $q->where('locale', $loc))
            ->latest('id')
            ->first();
        if ($promo) {
            $promo->update($data);
        } else {
            $promo = Promo::create($data);
        }
        if ($request->boolean('view')) {
            // Redirect to the home page vlog/promo section with a hash so it scrolls there.
            $loc = app()->getLocale();
            return redirect()->to(url('/'.$loc.'#vlog'));
        }
        return back()->with('status', 'Saved');
    })->name('admin.promo.save');

    Route::get('/leads', function (Request $request) {
        $q = trim((string) $request->query('q'));
        $stage = $request->query('stage');

        $items = Lead::query()
            ->when($q, function ($query, $q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%$q%")
                        ->orWhere('email', 'like', "%$q%");
                });
            })
            ->when($stage, fn($query) => $query->where('stage', $stage))
            ->latest()
            ->paginate(20)
            ->appends(['q' => $q, 'stage' => $stage]);

        $stages = ['new','qualified','proposal','won','lost'];

        return view('admin.leads', compact('items','q','stage','stages'));
    })->name('admin.leads');

    Route::get('/leads/export', function (Request $request) {
        $q = trim((string) $request->query('q'));
        $stage = $request->query('stage');

        $rows = Lead::query()
            ->when($q, function ($query, $q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%$q%")
                        ->orWhere('email', 'like', "%$q%");
                });
            })
            ->when($stage, fn($query) => $query->where('stage', $stage))
            ->latest()
            ->get([
                'id','created_at','name','email','phone','locale','business_type','need_website','need_content','need_ai','need_seo','budget_range','price_estimate_min','price_estimate_max','currency','stage','source'
            ]);

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="leads.csv"',
        ];

        $callback = function () use ($rows) {
            $out = fopen('php://output', 'w');
            // UTF-8 BOM for Excel compatibility
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, array_keys($rows->first()?->toArray() ?? []));
            foreach ($rows as $r) {
                fputcsv($out, $r->toArray());
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    })->name('admin.leads.export');

    Route::post('/index', function () {
        Artisan::call('content:index', ['--locale' => app()->getLocale()]);
        return back()->with('status', 'Indexed');
    })->name('admin.index');

    Route::post('/message', function (Request $request) {
        $data = $request->validate([
            'subject' => 'required|string|min:3',
            'body' => 'required|string|min:5',
            'from_name' => 'nullable|string|max:120',
            'from_email' => 'nullable|email|max:200',
        ]);
        $msg = AdminMessage::create($data);
        $to = config('site.admin_email') ?? config('mail.from.address');
        try {
            Mail::raw($data['body'], function ($m) use ($data, $to) {
                $m->to($to)->subject('[Admin Message] '.$data['subject']);
            });
        } catch (\Throwable $e) {
            Log::error('Failed to send admin message', ['error' => $e->getMessage()]);
        }
        return back()->with('status', 'Message sent');
    })->name('admin.message');

    // Inbox
    Route::get('/inbox', function (Request $request) {
        $q = trim((string) $request->query('q'));
        $items = ContactMessage::query()
            ->when($q, function ($query, $q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%$q%")
                        ->orWhere('email', 'like', "%$q%")
                        ->orWhere('message', 'like', "%$q%");
                });
            })
            ->latest()
            ->paginate(20)
            ->appends(['q' => $q]);
        return view('admin.inbox', compact('items','q'));
    })->name('admin.inbox');

    Route::get('/inbox/{id}', function ($id) {
        $msg = ContactMessage::findOrFail($id);
        return view('admin.message-show', compact('msg'));
    })->name('admin.inbox.show');
});
