<?php

namespace App\Services\Marketing;

use App\Domain\Marketing\Data\PromoData;
use App\Domain\Marketing\Events\PromoSaved;
use App\Domain\Marketing\Promo;
use App\Repositories\Contracts\PromoRepository;

class PromoService
{
    public function __construct(private readonly PromoRepository $promos)
    {
    }

    public function latest(?string $locale = null): ?Promo
    {
        return $this->promos->latest($locale);
    }

    public function save(PromoData $data): Promo
    {
        $promo = $this->promos->save($data->toArray());

        event(new PromoSaved($promo));

        return $promo;
    }
}
