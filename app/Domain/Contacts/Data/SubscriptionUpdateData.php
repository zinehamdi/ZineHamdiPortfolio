<?php

namespace App\Domain\Contacts\Data;

use DateTimeInterface;
use Illuminate\Support\Carbon;

final class SubscriptionUpdateData
{
    public function __construct(
        public readonly ?string $plan,
        public readonly ?string $status,
        public readonly ?DateTimeInterface $renewsAt,
    ) {}

    /**
     * @param array<string,mixed> $payload
     */
    public static function fromArray(array $payload): self
    {
        $renewsAt = $payload['renews_at'] ?? null;

        if (is_string($renewsAt)) {
            $renewsAt = Carbon::parse($renewsAt);
        }

        return new self(
            plan: $payload['plan'] ?? null,
            status: $payload['status'] ?? null,
            renewsAt: $renewsAt instanceof DateTimeInterface ? $renewsAt : null,
        );
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        $attributes = [
            'plan' => $this->plan,
            'status' => $this->status,
            'renews_at' => $this->renewsAt?->toDateTimeString(),
        ];

        return array_filter($attributes, static fn ($value) => $value !== null);
    }
}
