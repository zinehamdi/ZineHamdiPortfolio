<?php

namespace App\Repositories\Eloquent;

use App\Domain\Shared\AdminMessage;
use App\Repositories\Contracts\AdminMessageRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentAdminMessageRepository implements AdminMessageRepository
{
    public function create(array $attributes): AdminMessage
    {
        return AdminMessage::create($attributes);
    }

    public function paginate(array $filters = [], int $perPage = 20): LengthAwarePaginator
    {
        $query = AdminMessage::query();

        if ($search = $filters['search'] ?? null) {
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%")
                    ->orWhere('from_email', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
