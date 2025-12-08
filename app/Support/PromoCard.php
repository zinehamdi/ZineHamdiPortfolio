<?php

namespace App\Support;

use App\Models\Promo;
use Illuminate\Support\Facades\Schema;

class PromoCard
{
    protected static ?array $cached = null;

    public static function current(): array
    {
        if (self::$cached !== null) {
            return self::$cached;
        }

        $promoRecord = null;

        if (Schema::hasTable('promos')) {
            $promoRecord = Promo::query()
                ->where(function ($query) {
                    $query->whereNull('locale')->orWhere('locale', app()->getLocale());
                })
                ->latest('id')
                ->first();

            if (!$promoRecord) {
                $promoRecord = Promo::query()->latest('id')->first();
            }
        }

        $fallback = config('site.hero_promo') ?? [];

        $title = $promoRecord->title ?? ($fallback['title'] ?? null);
        $text = $promoRecord->text ?? ($fallback['text'] ?? null);
        $cta = $promoRecord->cta ?? ($fallback['cta'] ?? null);
        $link = $promoRecord->link ?? ($fallback['link'] ?? null);
        $imagePath = $promoRecord->image_path ?? ($fallback['image'] ?? null);

        return self::$cached = [
            'title' => $title,
            'text' => $text,
            'cta' => $cta,
            'link' => $link,
            'image_url' => self::resolveImageUrl($imagePath),
        ];
    }

    protected static function resolveImageUrl(?string $path): string
    {
        $path = trim((string) ($path ?? ''));
        if ($path === '') {
            return self::fallbackImage();
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            return $path;
        }

        if (str_starts_with($path, '/storage/')) {
            return $path;
        }

        if (str_starts_with($path, 'storage/')) {
            return '/' . ltrim($path, '/');
        }

        if (file_exists(public_path($path))) {
            return '/' . ltrim($path, '/');
        }

        return self::fallbackImage();
    }

    protected static function fallbackImage(): string
    {
        if (file_exists(public_path('images/home.jpg'))) {
            return asset('images/home.jpg');
        }

        if (file_exists(public_path('images/zinedev.png'))) {
            return asset('images/zinedev.png');
        }

        return asset('favicon.ico');
    }
}
