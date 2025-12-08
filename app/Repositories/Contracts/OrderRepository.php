<?php

namespace App\Repositories\Contracts;

use App\Domain\Leads\Order;
use Illuminate\Support\Collection;

interface OrderRepository
{
    public function create(array $attributes): Order;

    public function recent(int $limit = 5): Collection;

    public function count(): int;
}
