<?php

namespace App\Infrastructure\Crm;

use App\Application\Contracts\CrmClient;
use App\Domain\Contacts\Subscription;

class FakeCrmClient implements CrmClient
{
    public function syncSubscription(Subscription $subscription): void
    {
        // Intentionally left blank for testing and local development scenarios.
    }
}
