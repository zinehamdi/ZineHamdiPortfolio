<?php

namespace App\Domain\Marketing\Listeners;

use App\Domain\Marketing\Events\PromoSaved;
use Illuminate\Support\Facades\Cache;

class FlushPromoCache
{
    public function handle(PromoSaved $event): void
    {
        Cache::forget('promos.active');
    }
}
