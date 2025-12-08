<?php

namespace App\Repositories\Contracts;

use App\Domain\Leads\Lead;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface LeadRepository
{
    public function create(array $attributes): Lead;

    public function update(Lead $lead, array $attributes): Lead;

    public function find(int $id): ?Lead;

    public function paginate(array $filters = [], int $perPage = 20): LengthAwarePaginator;

    public function recent(int $limit = 5): Collection;

    public function syncServices(Lead $lead, array $serviceIds): void;

    public function count(): int;
}
