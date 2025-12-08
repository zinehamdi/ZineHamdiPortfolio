<?php

namespace App\Services\Admin;

use App\Domain\Shared\Admin;
use App\Repositories\Contracts\AdminRepository;
use Illuminate\Contracts\Hashing\Hasher;

class AdminAuthService
{
    public function __construct(
        private readonly AdminRepository $admins,
        private readonly Hasher $hasher,
    ) {}

    public function validateCredentials(string $username, string $password): ?Admin
    {
        $admin = $this->admins->findByUsername($username);

        if ($admin && $this->hasher->check($password, $admin->password)) {
            return $admin;
        }

        return null;
    }
}
