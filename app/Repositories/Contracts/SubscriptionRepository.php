<?php

namespace App\Repositories\Contracts;

use App\Domain\Contacts\Subscription;

interface SubscriptionRepository
{
    public function create(array $attributes): Subscription;

    public function findByEmail(string $email): ?Subscription;

    public function update(Subscription $subscription, array $attributes): Subscription;

    public function count(): int;
}
