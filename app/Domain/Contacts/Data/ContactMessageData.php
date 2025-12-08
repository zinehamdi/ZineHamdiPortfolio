<?php

namespace App\Domain\Contacts\Data;

use App\Domain\Shared\Data\BaseData;
use Illuminate\Http\Request;

final class ContactMessageData extends BaseData
{
    public readonly ?string $name;
    public readonly ?string $email;
    public readonly ?string $phone;
    public readonly ?string $budget;
    public readonly ?string $message;
    public readonly ?string $locale;
    public readonly ?string $source;
    public readonly ?string $status;
    /** @var array<string,mixed> */
    public readonly array $metadata;

    /**
     * @param array<string,mixed> $payload
     */
    public static function fromArray(array $payload): static
    {
        $metadata = is_array($payload['metadata'] ?? null) ? $payload['metadata'] : [];

        return new static([
            'name' => $payload['name'] ?? null,
            'email' => $payload['email'] ?? null,
            'phone' => $payload['phone'] ?? null,
            'budget' => $payload['budget'] ?? null,
            'message' => $payload['message'] ?? null,
            'locale' => $payload['locale'] ?? null,
            'source' => $payload['source'] ?? null,
            'status' => $payload['status'] ?? null,
            'metadata' => $metadata,
        ]);
    }

    public static function fromRequest(Request $request): static
    {
        return static::fromArray($request->all());
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return array_filter(parent::toArray(), static fn ($value) => $value !== null);
    }
}
