<?php

namespace App\Domain\Marketing\Events;

use App\Domain\Marketing\Promo;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PromoSaved
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public readonly Promo $promo)
    {
    }
}
