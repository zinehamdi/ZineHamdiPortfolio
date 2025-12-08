<?php

namespace App\Services\Marketing;

use App\Domain\Marketing\Data\VisitData;
use App\Repositories\Contracts\VisitRepository;

class VisitLogger
{
    public function __construct(private readonly VisitRepository $visits)
    {
    }

    public function log(VisitData $data): void
    {
        $this->visits->log($data->toArray());
    }

    public function count(): int
    {
        return $this->visits->count();
    }
}
