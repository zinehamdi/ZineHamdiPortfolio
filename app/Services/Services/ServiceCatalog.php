<?php

namespace App\Services\Services;

use App\Repositories\Contracts\ServiceRepository;
use Illuminate\Support\Collection;

class ServiceCatalog
{
    public function __construct(private readonly ServiceRepository $services)
    {
    }

    public function tree(): Collection
    {
        return $this->services->tree();
    }

    public function active(): Collection
    {
        return $this->services->active();
    }
}
