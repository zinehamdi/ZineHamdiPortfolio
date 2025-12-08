<?php

namespace App\Repositories\Eloquent;

use App\Domain\Contacts\ContactMessage;
use App\Repositories\Contracts\ContactMessageRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentContactMessageRepository implements ContactMessageRepository
{
    public function create(array $attributes): ContactMessage
    {
        return ContactMessage::create($attributes);
    }

    public function paginate(array $filters = [], int $perPage = 20): LengthAwarePaginator
    {
        $query = ContactMessage::query();

        if ($status = $filters['status'] ?? null) {
            $query->where('status', $status);
        }

        if ($search = $filters['search'] ?? null) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }

    public function updateStatus(ContactMessage $message, string $status): ContactMessage
    {
        $message->status = $status;
        $message->save();

        return $message->fresh();
    }

    public function find(int $id): ?ContactMessage
    {
        return ContactMessage::find($id);
    }

    public function count(): int
    {
        return ContactMessage::count();
    }
}
