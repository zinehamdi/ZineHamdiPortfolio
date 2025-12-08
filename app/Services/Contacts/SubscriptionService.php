<?php

namespace App\Services\Contacts;

use App\Domain\Contacts\Data\SubscriptionData;
use App\Domain\Contacts\Data\SubscriptionUpdateData;
use App\Domain\Contacts\Events\SubscriptionActivated;
use App\Domain\Contacts\Events\SubscriptionCreated;
use App\Domain\Contacts\Subscription;
use App\Repositories\Contracts\SubscriptionRepository;
use Illuminate\Support\Carbon;

class SubscriptionService
{
    public function __construct(private readonly SubscriptionRepository $subscriptions)
    {
    }

    public function subscribe(SubscriptionData $data): Subscription
    {
        $existing = $this->subscriptions->findByEmail($data->email);

        if ($existing) {
            $updated = $this->subscriptions->update($existing, [
                'status' => 'pending',
                'plan' => $data->plan,
            ]);

            return $updated;
        }

        $subscription = $this->subscriptions->create([
            'email' => $data->email,
            'status' => 'pending',
            'plan' => $data->plan,
        ]);

        event(new SubscriptionCreated($subscription));

        return $subscription;
    }

    public function confirm(Subscription $subscription): Subscription
    {
        $subscription = $this->subscriptions->update($subscription, [
            'status' => 'active',
            'confirmed_at' => Carbon::now(),
        ]);

        event(new SubscriptionActivated($subscription));

        return $subscription;
    }

    public function update(Subscription $subscription, SubscriptionUpdateData $data): Subscription
    {
        return $this->subscriptions->update($subscription, $data->toArray());
    }
}
