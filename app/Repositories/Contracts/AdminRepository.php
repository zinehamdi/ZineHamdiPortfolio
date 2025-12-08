<?php

namespace App\Repositories\Contracts;

use App\Domain\Shared\Admin;

interface AdminRepository
{
    public function findByUsername(string $username): ?Admin;

    public function find(int $id): ?Admin;
}
