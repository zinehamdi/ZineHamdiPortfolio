<?php

namespace App\Services\Admin;

use App\Domain\Shared\AdminMessage;
use App\Domain\Shared\Data\AdminMessageData;
use App\Repositories\Contracts\AdminMessageRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AdminMessageService
{
    public function __construct(private readonly AdminMessageRepository $messages)
    {
    }

    public function create(AdminMessageData $data): AdminMessage
    {
        return $this->messages->create($data->toArray());
    }

    public function paginate(array $filters = [], int $perPage = 20): LengthAwarePaginator
    {
        return $this->messages->paginate($filters, $perPage);
    }
}
