<?php

namespace App\Domain\Leads\Data;

final class PriceEstimateData
{
    public function __construct(
        public readonly int $min,
        public readonly int $max,
        public readonly string $currency,
    ) {}

    /**
     * @return array<string,int|string>
     */
    public function toArray(): array
    {
        return [
            'min' => $this->min,
            'max' => $this->max,
            'currency' => $this->currency,
        ];
    }

    public function mid(): int
    {
        return (int) round(($this->min + $this->max) / 2);
    }
}
