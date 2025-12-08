<?php

namespace App\Repositories\Eloquent;

use App\Domain\Shared\Admin;
use App\Repositories\Contracts\AdminRepository;

class EloquentAdminRepository implements AdminRepository
{
    public function findByUsername(string $username): ?Admin
    {
        return Admin::where('username', $username)->first();
    }

    public function find(int $id): ?Admin
    {
        return Admin::find($id);
    }
}
