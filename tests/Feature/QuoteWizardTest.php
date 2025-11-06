<?php

use App\Livewire\QuoteWizard;
use App\Models\Lead;
use App\Models\Package;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewLeadNotification;
use Livewire\Livewire;

beforeEach(function () {
    // Ensure a package exists for prefill/multiplier logic
    Package::factory()->create(['slug' => 'smart']);
});

it('validates each step and prevents advancing on invalid data', function () {

    // Mount component
    Livewire::test(QuoteWizard::class)
        // Step 1: optional fields - no validation errors expected when empty
        ->call('nextStep')
        ->assertSet('step', 2)

        // Step 2: toggle some needs and continue
        ->set('need_website', true)
        ->set('need_ai', true)
        ->call('nextStep')
        ->assertSet('step', 3)

        // Step 3: budget required - attempt to continue without selection
        ->call('nextStep')
        ->assertSet('step', 3) // should not advance

        // Set required budget and proceed
        ->set('budget_range', '<=1000')
        ->call('nextStep')
        ->assertSet('step', 4)

        // Step 4: missing name/email/terms prevents submission
        ->call('nextStep')
        ->assertSet('step', 4)

        // Fill valid contact data but without agreeing terms
        ->set('name', 'Alice')
        ->set('email', 'alice@example.com')
        ->set('phone', '123456')
        ->set('agree_terms', false)
        ->call('nextStep')
        ->assertSet('step', 4)

        // Accept terms, then it should submit
        ->set('agree_terms', true)
        ->call('nextStep')
        ->assertSet('price_estimate_min', fn ($val) => is_int($val) && $val > 0)
        ->assertSet('price_estimate_max', fn ($val) => is_int($val) && $val > 0);
});

it('saves a Lead and sets price band on success', function () {
    Mail::fake();

    expect(Lead::count())->toBe(0);

    $comp = Livewire::test(QuoteWizard::class)
        ->set('need_website', true)
        ->set('budget_range', '1000-2500')
        ->set('name', 'Bob')
        ->set('email', 'bob@example.com')
        ->set('agree_terms', true)
        ->set('step', 4)
        ->call('nextStep');

    // Lead persisted
    expect(Lead::count())->toBe(1);
    $lead = Lead::first();
    expect($lead->name)->toBe('Bob');
    expect($lead->price_estimate_min)->not()->toBeNull();
    expect($lead->price_estimate_max)->not()->toBeNull();

    // Email queued/sent
    Mail::assertQueued(NewLeadNotification::class);

    // Component reflects estimates
    $comp->assertSet('price_estimate_min', $lead->price_estimate_min)
         ->assertSet('price_estimate_max', $lead->price_estimate_max);
});

it('rate limiter blocks excessive submissions', function () {
    // Identify key via email + ip per component logic
    $email = 'rate@example.com';

    // Prime the component to step 4 with required fields
    $make = fn() => Livewire::test(QuoteWizard::class)
        ->set('need_website', true)
        ->set('budget_range', '>=2500')
        ->set('name', 'Rater')
        ->set('email', $email)
        ->set('agree_terms', true)
        ->set('step', 4);

    // First 5 submissions allowed
    for ($i = 0; $i < 5; $i++) {
        $make()->call('nextStep');
    }

    // 6th should be blocked by limiter and not create a lead
    $countBefore = Lead::count();
    $comp = $make()->call('nextStep');
    $countAfter = Lead::count();

    expect($countAfter)->toBe($countBefore); // no new lead

    // Component should have an error for rate limit (Livewire error bag)
    $comp->assertHasErrors(['rate']);
});
