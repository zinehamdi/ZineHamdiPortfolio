<?php

namespace App\Providers;

use App\Models\Lead;
use App\Models\Package;
use App\Models\Service;
use App\Policies\LeadPolicy;
use App\Policies\PackagePolicy;
use App\Policies\ServicePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Service::class => ServicePolicy::class,
        Package::class => PackagePolicy::class,
        Lead::class => LeadPolicy::class,
    ];

    public function boot(): void
    {
        // Policies are auto-registered via $policies
    }
}
