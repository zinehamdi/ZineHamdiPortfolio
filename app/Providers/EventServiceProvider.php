<?php

namespace App\Providers;

use App\Domain\Contacts\Events\SubscriptionActivated;
use App\Domain\Contacts\Events\SubscriptionCreated;
use App\Domain\Contacts\Listeners\QueueSubscriptionSync;
use App\Domain\Contacts\Listeners\SendSubscriptionWelcomeEmail;
use App\Domain\Leads\Events\LeadStageChanged;
use App\Domain\Leads\Listeners\InvalidateLeadMetricsCache;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        LeadStageChanged::class => [
            InvalidateLeadMetricsCache::class,
        ],
        SubscriptionCreated::class => [
            QueueSubscriptionSync::class,
        ],
        SubscriptionActivated::class => [
            SendSubscriptionWelcomeEmail::class,
        ],
    ];
}
