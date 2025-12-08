<?php

namespace App\Services\Leads;

use App\Domain\Leads\Data\LeadData;
use App\Domain\Leads\Data\LeadUpdateData;
use App\Domain\Leads\Lead;
use App\Domain\Leads\Events\LeadCreated;
use App\Domain\Leads\Events\LeadStageChanged;
use App\Domain\Leads\Events\LeadUpdated;
use App\Repositories\Contracts\LeadRepository;
use App\Repositories\Contracts\LeadStageRepository;
use App\Repositories\Contracts\ServiceRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class LeadService
{
    public function __construct(
        private readonly LeadRepository $leads,
        private readonly LeadStageRepository $stages,
        private readonly ServiceRepository $services,
    ) {}

    public function create(LeadData $data): Lead
    {
        $stage = $this->resolveStage($data->stageCode);

        $attributes = $data->toLeadAttributes();

        if ($stage) {
            $attributes['lead_stage_id'] = $stage->id;
        }

        if (!$stage && $data->stageId !== null) {
            $attributes['lead_stage_id'] = $data->stageId;
        }

        $lead = $this->leads->create($attributes);

        if (!empty($data->serviceIds)) {
            $this->leads->syncServices($lead, $data->serviceIds);
        }

        $lead->loadMissing(['stage', 'package', 'services']);

        event(new LeadCreated($lead));

        return $lead;
    }

    public function update(Lead $lead, LeadUpdateData $data): Lead
    {
        $attributes = $data->toArray();

        if ($data->stageCode) {
            $stage = $this->resolveStage($data->stageCode);
            if ($stage) {
                $attributes['lead_stage_id'] = $stage->id;
            }
        }

        $previousStageId = $lead->lead_stage_id;

        $lead = $this->leads->update($lead, $attributes);

        if ($data->serviceIds !== null) {
            $this->leads->syncServices($lead, $data->serviceIds);
        }

        $lead->loadMissing(['stage', 'package', 'services']);

        if (($attributes['lead_stage_id'] ?? null) !== null && ($attributes['lead_stage_id'] ?? null) !== $previousStageId) {
            $previousStage = $previousStageId ? $this->stages->find($previousStageId) : null;
            event(new LeadStageChanged($lead, $previousStage, $lead->stage));
        }

        if (!empty($attributes)) {
            event(new LeadUpdated($lead, array_keys($attributes)));
        }

        return $lead;
    }

    public function find(int $id): ?Lead
    {
        return $this->leads->find($id);
    }

    public function paginate(array $filters = [], int $perPage = 20): LengthAwarePaginator
    {
        return $this->leads->paginate($filters, $perPage);
    }

    public function recent(int $limit = 5): Collection
    {
        return $this->leads->recent($limit);
    }

    private function resolveStage(?string $code)
    {
        return $code ? $this->stages->findByCode($code) : null;
    }
}
