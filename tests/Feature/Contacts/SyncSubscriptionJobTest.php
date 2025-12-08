<?php

namespace Tests\Feature\Contacts;

use App\Application\Contracts\CrmClient;
use App\Domain\Contacts\Jobs\SyncSubscriptionToCrm;
use App\Domain\Contacts\Subscription;
use App\Infrastructure\Crm\HttpCrmClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SyncSubscriptionJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_job_posts_subscription_payload_to_crm(): void
    {
        config([
            'services.crm.endpoint' => 'https://crm.test/api',
            'services.crm.token' => 'secret-token',
            'queue.default' => 'sync',
        ]);

        Http::fake([
            'https://crm.test/api/subscriptions' => Http::response(['status' => 'ok'], 201),
        ]);

        $this->app->bind(CrmClient::class, HttpCrmClient::class);

        $subscription = Subscription::query()->create([
            'email' => 'subscriber@example.com',
            'plan' => 'newsletter',
            'status' => 'active',
        ]);

        SyncSubscriptionToCrm::dispatchSync($subscription->id);

        Http::assertSent(function ($request) use ($subscription) {
            return $request->url() === 'https://crm.test/api/subscriptions'
                && $request->method() === 'POST'
                && $request->hasHeader('Authorization')
                && str_starts_with($request->header('Authorization')[0], 'Bearer ')
                && $request['email'] === $subscription->email
                && $request['plan'] === $subscription->plan;
        });
    }
}
