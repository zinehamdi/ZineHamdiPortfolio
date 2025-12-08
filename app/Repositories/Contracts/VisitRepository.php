<?php

namespace App\Repositories\Contracts;

use App\Domain\Marketing\Visit;

interface VisitRepository
{
    public function log(array $attributes): Visit;

    public function count(): int;
}
