<?php

namespace App\Repositories\Contracts;

use App\Domain\Marketing\Promo;

interface PromoRepository
{
    public function latest(?string $locale = null): ?Promo;

    public function save(array $attributes): Promo;
}
