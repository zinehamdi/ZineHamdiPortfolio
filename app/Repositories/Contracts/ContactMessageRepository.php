<?php

namespace App\Repositories\Contracts;

use App\Domain\Contacts\ContactMessage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ContactMessageRepository
{
    public function create(array $attributes): ContactMessage;

    public function paginate(array $filters = [], int $perPage = 20): LengthAwarePaginator;

    public function updateStatus(ContactMessage $message, string $status): ContactMessage;

    public function find(int $id): ?ContactMessage;

    public function count(): int;
}
