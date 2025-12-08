<?php

namespace App\Domain\Leads\Listeners;

use App\Domain\Leads\Events\LeadStageChanged;
use Illuminate\Support\Facades\Cache;

class InvalidateLeadMetricsCache
{
    public function handle(LeadStageChanged $event): void
    {
        Cache::forget('admin.dashboard.metrics');
        Cache::forget('admin.dashboard.leads_by_stage');
    }
}
