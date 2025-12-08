<?php

namespace App\Domain\Shared\Data;

final class PriceEstimate
{
    public function __construct(
        public readonly int $min,
        public readonly int $max,
        public readonly string $currency,
    ) {}

    public static function fromValues(int $min, int $max, string $currency): static
    {
        return new static($min, $max, $currency);
    }

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

    public function midpoint(): int
    {
        return (int) round(($this->min + $this->max) / 2);
    }
}
