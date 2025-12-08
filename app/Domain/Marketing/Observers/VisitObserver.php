<?php

namespace App\Domain\Marketing\Observers;

use App\Domain\Marketing\Events\VisitLogged;
use App\Domain\Marketing\Visit;

class VisitObserver
{
    public function created(Visit $visit): void
    {
        VisitLogged::dispatch($visit);
    }
}
