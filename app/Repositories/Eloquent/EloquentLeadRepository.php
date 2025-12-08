<?php

namespace App\Repositories\Eloquent;

use App\Domain\Leads\Lead;
use App\Repositories\Contracts\LeadRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class EloquentLeadRepository implements LeadRepository
{
    public function create(array $attributes): Lead
    {
        /** @var Lead $lead */
        $lead = Lead::create($attributes);

        return $lead->fresh(['stage', 'package', 'services']);
    }

    public function update(Lead $lead, array $attributes): Lead
    {
        $lead->fill($attributes);
        $lead->save();

        return $lead->fresh(['stage', 'package', 'services']);
    }

    public function find(int $id): ?Lead
    {
        return Lead::with(['stage', 'package', 'services'])->find($id);
    }

    public function paginate(array $filters = [], int $perPage = 20): LengthAwarePaginator
    {
        $query = Lead::query()->with(['stage', 'package']);

        if (!empty($filters['stage'])) {
            $query->where('lead_stage_id', $filters['stage']);
        }

        if ($search = $filters['search'] ?? null) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['locale'])) {
            $query->where('locale', $filters['locale']);
        }

        return $query->latest()->paginate($perPage);
    }

    public function recent(int $limit = 5): Collection
    {
        return Lead::with(['stage', 'package'])
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function syncServices(Lead $lead, array $serviceIds): void
    {
        if (! Schema::hasTable('lead_service')) {
            return;
        }

        $lead->services()->sync($serviceIds);
    }

    public function count(): int
    {
        return Lead::count();
    }
}
