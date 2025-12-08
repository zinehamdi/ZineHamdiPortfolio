<?php

namespace App\Repositories\Eloquent;

use App\Domain\Marketing\Visit;
use App\Repositories\Contracts\VisitRepository;

class EloquentVisitRepository implements VisitRepository
{
    public function log(array $attributes): Visit
    {
        return Visit::create($attributes);
    }

    public function count(): int
    {
        return Visit::count();
    }
}
