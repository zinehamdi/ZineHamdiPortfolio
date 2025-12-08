<?php

namespace App\Services\Packages;

use App\Domain\Packages\Package;
use App\Repositories\Contracts\PackageRepository;
use Illuminate\Support\Collection;

class PackageCatalog
{
    public function __construct(private readonly PackageRepository $packages)
    {
    }

    public function active(): Collection
    {
        return $this->packages->allActive();
    }

    public function featured(int $limit = 3): Collection
    {
        return $this->packages->featured($limit);
    }

    public function findBySlug(string $slug): ?Package
    {
        return $this->packages->findBySlug($slug);
    }

    public function find(int $id): ?Package
    {
        return $this->packages->find($id);
    }
}
