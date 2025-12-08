<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\ContactMessageRepository;
use App\Repositories\Contracts\LeadRepository;
use App\Repositories\Contracts\OrderRepository;
use App\Repositories\Contracts\SubscriptionRepository;
use App\Repositories\Contracts\VisitRepository;
use Illuminate\Support\Collection;

class AdminDashboardService
{
    public function __construct(
        private readonly LeadRepository $leads,
        private readonly OrderRepository $orders,
        private readonly SubscriptionRepository $subscriptions,
        private readonly ContactMessageRepository $messages,
        private readonly VisitRepository $visits,
    ) {}

    public function metrics(): array
    {
        return [
            'lead_count' => $this->leads->count(),
            'order_count' => $this->orders->count(),
            'subscription_count' => $this->subscriptions->count(),
            'inbox_count' => $this->messages->count(),
            'visit_count' => $this->visits->count(),
        ];
    }

    public function recentLeads(int $limit = 5): Collection
    {
        return $this->leads->recent($limit);
    }

    public function recentOrders(int $limit = 5): Collection
    {
        return $this->orders->recent($limit);
    }
}
