<?php

namespace App\Domain\Shared\Data;

final class AdminMessageData
{
    public function __construct(
        public readonly string $subject,
        public readonly string $body,
        public readonly ?string $fromName,
        public readonly ?string $fromEmail,
    ) {}

    /**
     * @param array<string,mixed> $payload
     */
    public static function fromArray(array $payload): self
    {
        return new self(
            subject: (string) $payload['subject'],
            body: (string) $payload['body'],
            fromName: $payload['from_name'] ?? null,
            fromEmail: $payload['from_email'] ?? null,
        );
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        $attributes = [
            'subject' => $this->subject,
            'body' => $this->body,
            'from_name' => $this->fromName,
            'from_email' => $this->fromEmail,
        ];

        return array_filter($attributes, static fn ($value) => $value !== null);
    }
}
