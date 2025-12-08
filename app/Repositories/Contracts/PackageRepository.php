<?php

namespace App\Repositories\Contracts;

use App\Domain\Packages\Package;
use Illuminate\Support\Collection;

interface PackageRepository
{
    public function allActive(): Collection;

    public function featured(int $limit = 3): Collection;

    public function find(int $id): ?Package;

    public function findBySlug(string $slug): ?Package;
}
