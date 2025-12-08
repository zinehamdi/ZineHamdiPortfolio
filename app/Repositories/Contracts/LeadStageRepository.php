<?php

namespace App\Repositories\Contracts;

use App\Domain\Leads\LeadStage;
use Illuminate\Support\Collection;

interface LeadStageRepository
{
    public function all(): Collection;

    public function findByCode(string $code): ?LeadStage;

    public function find(int $id): ?LeadStage;
}
