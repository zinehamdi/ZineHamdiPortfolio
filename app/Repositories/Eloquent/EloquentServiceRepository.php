<?php

namespace App\Repositories\Eloquent;

use App\Domain\Services\Service;
use App\Repositories\Contracts\ServiceRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class EloquentServiceRepository implements ServiceRepository
{
    public function tree(): Collection
    {
        $query = Service::query();

        if (Schema::hasColumn('services', 'parent_id')) {
            $query->whereNull('parent_id')
                ->with(['children' => function (Builder $childQuery) {
                    $this->applyOrdering($childQuery);
                }]);
        }

        $this->applyOrdering($query);

        return $query->get();
    }

    public function active(): Collection
    {
        $query = Service::where('is_active', true);

        $this->applyOrdering($query);

        return $query->get();
    }

    public function find(int $id): ?Service
    {
        $query = Service::query();

        if (Schema::hasColumn('services', 'parent_id')) {
            $query->with('children');
        }

        return $query->find($id);
    }

    public function findBySlug(string $slug): ?Service
    {
        $query = Service::query()->where('slug', $slug);

        if (Schema::hasColumn('services', 'parent_id')) {
            $query->with('children');
        }

        return $query->first();
    }

    private function applyOrdering(Builder $query): void
    {
        if (Schema::hasColumn('services', 'display_order')) {
            $query->orderBy('display_order');
        } else {
            $query->orderBy('created_at');
        }
    }
}
