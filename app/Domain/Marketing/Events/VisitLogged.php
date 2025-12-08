<?php

namespace App\Domain\Marketing\Events;

use App\Domain\Marketing\Visit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VisitLogged
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public readonly Visit $visit)
    {
    }
}
