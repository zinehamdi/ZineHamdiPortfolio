<?php

namespace App\Repositories\Eloquent;

use App\Domain\Leads\Order;
use App\Repositories\Contracts\OrderRepository;
use Illuminate\Support\Collection;

class EloquentOrderRepository implements OrderRepository
{
    public function create(array $attributes): Order
    {
        return Order::create($attributes);
    }

    public function recent(int $limit = 5): Collection
    {
        return Order::latest()->limit($limit)->get();
    }

    public function count(): int
    {
        return Order::count();
    }
}
