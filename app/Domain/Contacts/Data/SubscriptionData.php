<?php

namespace App\Domain\Contacts\Data;

final class SubscriptionData
{
    public function __construct(
        public readonly string $email,
        public readonly ?string $plan,
    ) {}

    /**
     * @param array<string,mixed> $payload
     */
    public static function fromArray(array $payload): self
    {
        return new self(
            email: (string) $payload['email'],
            plan: $payload['plan'] ?? null,
        );
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return array_filter([
            'email' => $this->email,
            'plan' => $this->plan,
        ], static fn ($value) => $value !== null);
    }
}
