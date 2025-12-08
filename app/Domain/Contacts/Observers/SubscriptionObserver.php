<?php

namespace App\Domain\Contacts\Observers;

use App\Domain\Contacts\Events\SubscriptionActivated;
use App\Domain\Contacts\Events\SubscriptionCreated;
use App\Domain\Contacts\Subscription;

class SubscriptionObserver
{
    public function created(Subscription $subscription): void
    {
        SubscriptionCreated::dispatch($subscription);
    }

    public function updated(Subscription $subscription): void
    {
        if ($subscription->wasChanged('status') && $subscription->status === 'active') {
            SubscriptionActivated::dispatch($subscription);
        }
    }
}
