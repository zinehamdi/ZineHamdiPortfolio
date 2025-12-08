<?php

namespace App\Domain\Contacts\Events;

use App\Domain\Contacts\Subscription;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SubscriptionCreated
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public readonly Subscription $subscription)
    {
    }
}
