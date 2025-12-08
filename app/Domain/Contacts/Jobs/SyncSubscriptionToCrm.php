<?php

namespace App\Domain\Contacts\Jobs;

use App\Application\Contracts\CrmClient;
use App\Domain\Contacts\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class SyncSubscriptionToCrm implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(public readonly int $subscriptionId)
    {
    }

    public function handle(CrmClient $client): void
    {
        $subscription = Subscription::query()->find($this->subscriptionId);

        if (! $subscription) {
            return;
        }

        try {
            $client->syncSubscription($subscription);
        } catch (Throwable $exception) {
            Log::error('Failed to sync subscription with CRM', [
                'subscription_id' => $this->subscriptionId,
                'error' => $exception->getMessage(),
            ]);

            $this->fail($exception);
        }
    }
}
