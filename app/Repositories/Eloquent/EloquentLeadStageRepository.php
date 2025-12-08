<?php

namespace App\Repositories\Eloquent;

use App\Domain\Leads\LeadStage;
use App\Repositories\Contracts\LeadStageRepository;
use Illuminate\Support\Collection;

class EloquentLeadStageRepository implements LeadStageRepository
{
    public function all(): Collection
    {
        return LeadStage::orderBy('rank')->get();
    }

    public function findByCode(string $code): ?LeadStage
    {
        return LeadStage::where('code', $code)->first();
    }

    public function find(int $id): ?LeadStage
    {
        return LeadStage::find($id);
    }
}
