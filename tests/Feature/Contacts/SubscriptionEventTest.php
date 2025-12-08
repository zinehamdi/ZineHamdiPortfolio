<?php

namespace Tests\Feature\Contacts;

use App\Domain\Contacts\Data\SubscriptionData;
use App\Domain\Contacts\Events\SubscriptionActivated;
use App\Domain\Contacts\Events\SubscriptionCreated;
use App\Domain\Contacts\Jobs\SyncSubscriptionToCrm;
use App\Mail\SubscriptionWelcomeMail;
use App\Services\Contacts\SubscriptionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SubscriptionEventTest extends TestCase
{
    use RefreshDatabase;

    public function test_subscription_created_dispatches_sync_job(): void
    {
        config(['queue.default' => 'sync']);

        Bus::fake();

        $service = app(SubscriptionService::class);
        $dto = SubscriptionData::fromArray([
            'email' => 'subscriber@example.com',
            'plan' => 'newsletter',
        ]);

        $result = Event::fakeFor(function () use ($service, $dto) {
            $subscription = $service->subscribe($dto);

            Event::assertDispatched(SubscriptionCreated::class, function (SubscriptionCreated $event) use ($subscription) {
                return $event->subscription->is($subscription);
            });

            return [
                'subscription' => $subscription,
                'events' => Event::dispatched(SubscriptionCreated::class),
            ];
        });

        collect($result['events'])->each(static function (array $arguments): void {
            event($arguments[0]);
        });

        Bus::assertDispatched(SyncSubscriptionToCrm::class, function (SyncSubscriptionToCrm $job) use ($result) {
            return $job->subscriptionId === $result['subscription']->id;
        });
    }

    public function test_subscription_activation_sends_welcome_email(): void
    {
        config(['queue.default' => 'sync']);

        Mail::fake();

        $service = app(SubscriptionService::class);
        $dto = SubscriptionData::fromArray([
            'email' => 'subscriber@example.com',
            'plan' => 'newsletter',
        ]);

        $subscribeResult = Event::fakeFor(function () use ($service, $dto) {
            $subscription = $service->subscribe($dto);

            return [
                'subscription' => $subscription,
                'events' => Event::dispatched(SubscriptionCreated::class),
            ];
        });

        collect($subscribeResult['events'])->each(static function (array $arguments): void {
            event($arguments[0]);
        });

        $confirmResult = Event::fakeFor(function () use ($service, $subscribeResult) {
            $subscription = $service->confirm($subscribeResult['subscription']);

            Event::assertDispatched(SubscriptionActivated::class, function (SubscriptionActivated $event) use ($subscription) {
                return $event->subscription->is($subscription);
            });

            return [
                'subscription' => $subscription,
                'events' => Event::dispatched(SubscriptionActivated::class),
            ];
        });

        collect($confirmResult['events'])->each(static function (array $arguments): void {
            event($arguments[0]);
        });

        Mail::assertQueued(SubscriptionWelcomeMail::class, function (SubscriptionWelcomeMail $mail) use ($confirmResult) {
            return $mail->subscription->is($confirmResult['subscription']);
        });
    }
}
