<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use App\Models\Lead;
use App\Models\Package;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\NewLeadNotification;

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

    public $errors = [];

    public function nextStep()
    {
        if (!$this->validateStep()) return;
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
        $rules = [
            1 => [
                'business_type' => 'nullable|string|max:100',
                'company' => 'nullable|string|max:255',
            ],
            2 => [
                'need_website' => 'boolean',
                'need_content' => 'boolean',
                'need_ai' => 'boolean',
                'need_seo' => 'boolean',
            ],
            3 => [
                'budget_range' => 'required|in:<=1000,1000-2500,>=2500',
            ],
            4 => [
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'nullable|string|max:50',
                'notes' => 'nullable|string|max:2000',
                'agree_terms' => 'accepted',
            ],
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($this->all(), $rules[$this->step]);
        if ($validator->fails()) {
            $this->errors = $validator->errors()->toArray();
            $this->dispatch('validationFailed');
            return false;
        }
        $this->errors = [];
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

        // Currency by locale
        $locale = app()->getLocale();
        $this->currency = match ($locale) {
            'en' => 'USD',
            'fr' => 'EUR',
            'ar' => 'TND',
            default => 'USD',
        };

        // Price engine
        [$min, $max] = $this->computePriceBand();
        $this->price_estimate_min = $min;
        $this->price_estimate_max = $max;

        // Persist lead
        $lead = Lead::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'locale' => $locale,
            'business_type' => $this->business_type,
            'need_website' => (bool)$this->need_website,
            'need_content' => (bool)$this->need_content,
            'need_ai' => (bool)$this->need_ai,
            'need_seo' => (bool)$this->need_seo,
            'budget_range' => $this->budget_range,
            'notes' => $this->notes,
            'package_id' => $this->package_id,
            'price_estimate_min' => $this->price_estimate_min,
            'price_estimate_max' => $this->price_estimate_max,
            'currency' => $this->currency,
            'stage' => 'new',
            'source' => 'site',
        ]);

        // Log submission for quick analytics
        Log::info('Quote submission', [
            'lead_id' => $lead->id,
            'locale' => $locale,
            'package_id' => $this->package_id,
            'ip' => request()->ip(),
        ]);

        // Email admin (queued if possible, fallback to sync)
        $to = config('site.admin_email') ?? config('mail.admin_address') ?? config('mail.from.address');
        try {
            Mail::to($to)->queue(new NewLeadNotification($lead));
        } catch (\Throwable $e) {
            // Fallback if queue not configured
            Mail::to($to)->send(new NewLeadNotification($lead));
        }
    }

    public function computePriceBand(): array
    {
        $base = 0;
        if ($this->need_website) $base += 1200;
        if ($this->need_content) $base += 400;
        if ($this->need_ai) $base += 300;
        if ($this->need_seo) $base += 350;

        $packageSlug = null;
        if ($this->package_id) {
            $pkg = Package::find($this->package_id);
            $packageSlug = $pkg?->slug;
        }
        $multiplier = match($packageSlug) {
            'starter' => 0.9,
            'pro' => 1.15,
            default => 1.0, // smart or null
        };
        $base = (int) round($base * $multiplier);
        $min = (int) round($base * 0.9);
        $max = (int) round($base * 1.2);
        return [$min, $max];
    }

    public function selectPackage(string $slug): void
    {
        $this->selected_slug = $slug;
        $this->package_id = \App\Models\Package::where('slug', $slug)->value('id');
    }

    public function mount()
    {
        // Prefill from package query
        $package = request('package');
        if (in_array($package, ['starter','smart','pro'])) {
            $this->selected_slug = $package;
            $this->package_id = Package::where('slug', $package)->value('id');
        }
    }

    public function render()
    {
        return view('livewire.quote-wizard');
    }
}
