<?php

namespace App\Repositories\Contracts;

use App\Domain\Services\Service;
use Illuminate\Support\Collection;

interface ServiceRepository
{
    public function tree(): Collection;

    public function active(): Collection;

    public function find(int $id): ?Service;

    public function findBySlug(string $slug): ?Service;
}
