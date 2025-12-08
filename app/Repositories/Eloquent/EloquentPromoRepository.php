<?php

namespace App\Repositories\Eloquent;

use App\Domain\Marketing\Promo;
use App\Repositories\Contracts\PromoRepository;

class EloquentPromoRepository implements PromoRepository
{
    public function latest(?string $locale = null): ?Promo
    {
        $query = Promo::query();

        if ($locale) {
            $query->where('locale', $locale);
        } else {
            $query->whereNull('locale');
        }

        return $query->latest()->first();
    }

    public function save(array $attributes): Promo
    {
        if (!empty($attributes['id'])) {
            $promo = Promo::findOrFail($attributes['id']);
            $promo->fill($attributes);
            $promo->save();

            return $promo->fresh();
        }

        return Promo::create($attributes);
    }
}
