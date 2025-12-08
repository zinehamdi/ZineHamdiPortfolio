<?php

namespace App\Repositories\Eloquent;

use App\Domain\Packages\Package;
use App\Repositories\Contracts\PackageRepository;
use Illuminate\Support\Collection;

class EloquentPackageRepository implements PackageRepository
{
    public function allActive(): Collection
    {
        return Package::with('services')
            ->where('is_active', true)
            ->orderByDesc('is_featured')
            ->orderBy('delivery_days')
            ->get();
    }

    public function featured(int $limit = 3): Collection
    {
        return Package::where('is_active', true)
            ->where('is_featured', true)
            ->limit($limit)
            ->get();
    }

    public function find(int $id): ?Package
    {
        return Package::with('services')->find($id);
    }

    public function findBySlug(string $slug): ?Package
    {
        return Package::with('services')->where('slug', $slug)->first();
    }
}
