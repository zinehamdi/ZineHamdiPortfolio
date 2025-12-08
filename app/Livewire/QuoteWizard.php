<?php

namespace App\Livewire;

use Livewire\Component;

use App\Domain\Leads\Data\QuoteRequestData;
use App\Domain\Leads\Lead as DomainLead;
use App\Mail\NewLeadNotification;
use App\Models\Package;
use App\Services\Quote\QuoteService;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class QuoteWizard extends Component
{
    public $step = 1;
    // Step 1
    public $business_type = null;
    public $company = null;
    // Step 2
    public $need_website = false;
    public $need_content = false;
    public $need_ai = false;
    public $need_seo = false;
    // Step 3
    public $budget_range = null;
    // Step 4
    public $name = null;
    public $email = null;
    public $phone = null;
    public $notes = null;
    public $agree_terms = false;

    // Prefill & computed
    public $package_id = null;
    public $selected_slug = null;
    public $price_estimate_min = null;
    public $price_estimate_max = null;
    public $currency = 'TND';

    // Honeypot
    public $website = null; // bots may fill

    public function nextStep()
    {
        $this->validateStep();
        if ($this->step < 4) { $this->step++; } else { $this->submit(); }
    }

    public function prevStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function validateStep()
    {
        if ($this->step === 1) {
            $this->validate([
                'business_type' => 'nullable|string|max:100',
                'company' => 'nullable|string|min:2|max:255',
            ]);
        } elseif ($this->step === 2) {
            $this->validate([
                'need_website' => 'boolean',
                'need_content' => 'boolean',
                'need_ai' => 'boolean',
                'need_seo' => 'boolean',
            ]);

            if (!$this->need_website && !$this->need_content && !$this->need_ai && !$this->need_seo) {
                $this->addError('needs', __('quote.needs_required'));
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'needs' => [__('quote.needs_required')],
                ]);
            }
        } elseif ($this->step === 3) {
            $this->validate([
                'budget_range' => 'required|in:<=1000,1000-2500,>=2500',
            ]);
        } elseif ($this->step === 4) {
            $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'nullable|string|max:50',
                'notes' => 'nullable|string|max:2000',
                'agree_terms' => 'accepted',
            ]);
        }
        
        return true;
    }

    public function submit()
    {
        // Honeypot
        if (!empty($this->website)) {
            return; // silently drop
        }

        $key = 'quote-wizard:' . ($this->email ?? 'guest') . ':' . request()->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $this->addError('rate', Lang::get('quote.rate_limit'));
            return;
        }
        RateLimiter::hit($key, 3600); // 1 hour window

        $locale = app()->getLocale();

        $packageSlug = $this->selected_slug;
        if (! $packageSlug && $this->package_id) {
            $packageSlug = Package::whereKey($this->package_id)->value('slug');
        }

        $dto = QuoteRequestData::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'business_type' => $this->business_type,
            'locale' => $locale,
            'needs' => $this->selectedNeeds(),
            'budget_range' => $this->budget_range,
            'notes' => $this->notes,
            'package_slug' => $packageSlug,
            'agree_terms' => $this->agree_terms,
            'metadata' => [
                'user_agent' => request()->userAgent(),
                'path' => request()->path(),
            ],
            'source' => 'site',
        ]);

        /** @var QuoteService $service */
        $service = app(QuoteService::class);
        $estimate = $service->handle($dto);

        $this->price_estimate_min = $estimate->min;
        $this->price_estimate_max = $estimate->max;
        $this->currency = $estimate->currency;

        $lead = DomainLead::where('email', $this->email)
            ->where('created_at', '>=', now()->subMinutes(5))
            ->orderByDesc('id')
            ->first();

        if ($lead) {
            Log::info('Quote submission', [
                'lead_id' => $lead->id,
                'locale' => $locale,
                'package_id' => $lead->package_id,
                'ip' => request()->ip(),
            ]);

            $to = config('site.admin_email') ?? config('mail.admin_address') ?? config('mail.from.address');

            if ($to) {
                try {
                    Mail::to($to)->queue(new NewLeadNotification($lead));
                } catch (\Throwable $e) {
                    Mail::to($to)->send(new NewLeadNotification($lead));
                }
            }
        }
    }

    public function selectPackage(string $slug): void
    {
        $this->selected_slug = $slug;
        $this->package_id = Package::where('slug', $slug)->value('id');
    }

    public function mount()
    {
        // Prefill from package query
        $package = request('package');
        if ($package) {
            $this->selected_slug = $package;
            $this->package_id = Package::where('slug', $package)->value('id');
        }
    }

    public function render()
    {
        return view('livewire.quote-wizard');
    }

    private function selectedNeeds(): array
    {
        $needs = [];

        if ($this->need_website) {
            $needs[] = 'website';
        }

        if ($this->need_content) {
            $needs[] = 'content';
        }

        if ($this->need_ai) {
            $needs[] = 'ai';
        }

        if ($this->need_seo) {
            $needs[] = 'seo';
        }

        return $needs;
    }
}
