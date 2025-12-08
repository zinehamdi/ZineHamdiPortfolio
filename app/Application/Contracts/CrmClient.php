<?php

namespace App\Application\Contracts;

use App\Domain\Contacts\Subscription;

interface CrmClient
{
    public function syncSubscription(Subscription $subscription): void;
}
