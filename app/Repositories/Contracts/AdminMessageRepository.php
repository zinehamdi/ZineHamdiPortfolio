<?php

namespace App\Repositories\Contracts;

use App\Domain\Shared\AdminMessage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AdminMessageRepository
{
    public function create(array $attributes): AdminMessage;

    public function paginate(array $filters = [], int $perPage = 20): LengthAwarePaginator;
}
