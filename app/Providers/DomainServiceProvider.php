<?php

namespace App\Providers;

use App\Domain\Contacts\Events\ContactMessageCreated;
use App\Domain\Contacts\Listeners\SendContactNotification;
use App\Domain\Leads\Events\LeadCreated;
use App\Domain\Leads\Listeners\SendNewLeadNotification;
use App\Domain\Marketing\Events\PromoSaved;
use App\Domain\Marketing\Listeners\FlushPromoCache;
use App\Repositories\Contracts\AdminMessageRepository;
use App\Repositories\Contracts\AdminRepository;
use App\Repositories\Contracts\ContactMessageRepository;
use App\Repositories\Contracts\LeadRepository;
use App\Repositories\Contracts\LeadStageRepository;
use App\Repositories\Contracts\OrderRepository;
use App\Repositories\Contracts\PackageRepository;
use App\Repositories\Contracts\PromoRepository;
use App\Repositories\Contracts\ServiceRepository;
use App\Repositories\Contracts\SubscriptionRepository;
use App\Repositories\Contracts\VisitRepository;
use App\Repositories\Eloquent\EloquentAdminMessageRepository;
use App\Repositories\Eloquent\EloquentAdminRepository;
use App\Repositories\Eloquent\EloquentContactMessageRepository;
use App\Repositories\Eloquent\EloquentLeadRepository;
use App\Repositories\Eloquent\EloquentLeadStageRepository;
use App\Repositories\Eloquent\EloquentOrderRepository;
use App\Repositories\Eloquent\EloquentPackageRepository;
use App\Repositories\Eloquent\EloquentPromoRepository;
use App\Repositories\Eloquent\EloquentServiceRepository;
use App\Repositories\Eloquent\EloquentSubscriptionRepository;
use App\Repositories\Eloquent\EloquentVisitRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Register domain-specific bindings.
     */
    public function register(): void
    {
        $bindings = [
            LeadRepository::class => EloquentLeadRepository::class,
            LeadStageRepository::class => EloquentLeadStageRepository::class,
            PackageRepository::class => EloquentPackageRepository::class,
            ServiceRepository::class => EloquentServiceRepository::class,
            PromoRepository::class => EloquentPromoRepository::class,
            VisitRepository::class => EloquentVisitRepository::class,
            ContactMessageRepository::class => EloquentContactMessageRepository::class,
            SubscriptionRepository::class => EloquentSubscriptionRepository::class,
            OrderRepository::class => EloquentOrderRepository::class,
            AdminRepository::class => EloquentAdminRepository::class,
            AdminMessageRepository::class => EloquentAdminMessageRepository::class,
        ];

        foreach ($bindings as $contract => $implementation) {
            $this->app->bind($contract, $implementation);
        }
    }

    /**
     * Bootstrap domain observers.
     */
    public function boot(): void
    {
        Event::listen(ContactMessageCreated::class, SendContactNotification::class);
        Event::listen(LeadCreated::class, SendNewLeadNotification::class);
        Event::listen(PromoSaved::class, FlushPromoCache::class);
    }
}
