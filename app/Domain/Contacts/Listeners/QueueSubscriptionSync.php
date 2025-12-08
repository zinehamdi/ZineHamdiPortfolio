<?php

namespace App\Domain\Contacts\Listeners;

use App\Domain\Contacts\Events\SubscriptionCreated;
use App\Domain\Contacts\Jobs\SyncSubscriptionToCrm;

class QueueSubscriptionSync
{
    public function handle(SubscriptionCreated $event): void
    {
        SyncSubscriptionToCrm::dispatch($event->subscription->id);
    }
}
