<?php

namespace App\Services\Quote;

use App\Domain\Leads\Data\QuoteRequestData;
use App\Domain\Shared\Data\PriceEstimate;
use App\Domain\Packages\Package;

class QuoteEstimator
{
    /**
     * Compute price range based on declared needs and optional package pricing.
     */
    public function compute(QuoteRequestData $request, ?Package $package = null): PriceEstimate
    {
        $weights = config('quote.needs', []);

        $score = 0;

        // Accept either associative (key => bool) or numeric (value string) needs payloads.
        foreach ($request->needs as $key => $value) {
            $needKey = is_string($key) ? $key : (is_string($value) ? $value : null);
            $selected = is_bool($value) ? $value : $needKey !== null;

            if ($selected && $needKey && isset($weights[$needKey])) {
                $score += $weights[$needKey]['weight'] ?? 0;
            }
        }

        $baseOnce = $package?->price_once ?? 0;
        $baseMonthly = $package?->price_monthly ?? 0;
        $min = (int) round($baseOnce + ($score * 0.9));
        $max = (int) round(($baseOnce ?: $baseMonthly * 12) + ($score * 1.2));

        if ($min > $max) {
            [$min, $max] = [$max, $min];
        }

        $currencyCode = $package?->currency ?? config('quote.currency', 'USD');

        return PriceEstimate::fromValues($min, $max, $currencyCode);
    }
}
