<?php

namespace App\Domain\Marketing\Observers;

use App\Domain\Marketing\Events\PromoSaved;
use App\Domain\Marketing\Promo;

class PromoObserver
{
    public function saved(Promo $promo): void
    {
        PromoSaved::dispatch($promo);
    }
}
