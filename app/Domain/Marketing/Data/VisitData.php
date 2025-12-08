<?php

namespace App\Domain\Marketing\Data;

final class VisitData
{
    public function __construct(
        public readonly string $ip,
        public readonly ?string $userAgent,
        public readonly ?string $path,
        public readonly ?string $locale,
        public readonly ?string $referrer,
    ) {}

    /**
     * @param array<string,mixed> $payload
     */
    public static function fromArray(array $payload): self
    {
        return new self(
            ip: (string) $payload['ip'],
            userAgent: $payload['user_agent'] ?? null,
            path: $payload['path'] ?? null,
            locale: $payload['locale'] ?? null,
            referrer: $payload['referrer'] ?? null,
        );
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        $attributes = [
            'ip' => $this->ip,
            'user_agent' => $this->userAgent,
            'path' => $this->path,
            'locale' => $this->locale,
            'referrer' => $this->referrer,
        ];

        return array_filter($attributes, static fn ($value) => $value !== null);
    }
}
