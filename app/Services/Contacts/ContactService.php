<?php

namespace App\Services\Contacts;

use App\Domain\Contacts\ContactMessage;
use App\Domain\Contacts\Events\ContactMessageCreated;
use App\Domain\Contacts\Data\ContactMessageData;
use App\Repositories\Contracts\ContactMessageRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ContactService
{
    public function __construct(private readonly ContactMessageRepository $messages)
    {
    }

    public function submit(ContactMessageData $data): ContactMessage
    {
        $message = $this->messages->create($data->toArray());

        event(new ContactMessageCreated($message));

        return $message;
    }

    public function paginate(array $filters = [], int $perPage = 20): LengthAwarePaginator
    {
        return $this->messages->paginate($filters, $perPage);
    }

    public function mark(ContactMessage $message, string $status): ContactMessage
    {
        return $this->messages->updateStatus($message, $status);
    }

    public function find(int $id): ?ContactMessage
    {
        return $this->messages->find($id);
    }
}
