<?php

namespace App\Repositories\Eloquent;

use App\Domain\Contacts\Subscription;
use App\Repositories\Contracts\SubscriptionRepository;

class EloquentSubscriptionRepository implements SubscriptionRepository
{
    public function create(array $attributes): Subscription
    {
        return Subscription::create($attributes);
    }

    public function findByEmail(string $email): ?Subscription
    {
        return Subscription::where('email', $email)->first();
    }

    public function update(Subscription $subscription, array $attributes): Subscription
    {
        $subscription->fill($attributes);
        $subscription->save();

        return $subscription->fresh();
    }

    public function count(): int
    {
        return Subscription::count();
    }
}
