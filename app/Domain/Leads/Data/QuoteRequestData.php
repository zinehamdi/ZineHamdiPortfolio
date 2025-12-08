<?php

namespace App\Domain\Leads\Data;

use App\Domain\Shared\Data\BaseData;
use Illuminate\Http\Request;

final class QuoteRequestData extends BaseData
{
    public readonly ?string $name;
    public readonly ?string $email;
    /** @var array<int|string,mixed> */
    public readonly array $needs;
    public readonly ?string $budgetRange;
    public readonly ?string $packageSlug;
    public readonly ?string $locale;
    public readonly ?string $phone;
    public readonly ?string $notes;
    public readonly ?bool $agreeTerms;
    public readonly ?string $company;
    public readonly ?string $businessType;
    /** @var array<string,mixed> */
    public readonly array $metadata;
    /** @var array<int,int> */
    public readonly array $serviceIds;
    public readonly ?string $source;
    public readonly ?string $stageCode;

    /**
     * @param array<string,mixed> $payload
     */
    public static function fromArray(array $payload): static
    {
        return new static([
            'name' => isset($payload['name']) ? (string) $payload['name'] : null,
            'email' => isset($payload['email']) ? (string) $payload['email'] : null,
            'needs' => is_array($payload['needs'] ?? null) ? $payload['needs'] : [],
            'budgetRange' => $payload['budget_range'] ?? null,
            'packageSlug' => $payload['package_slug'] ?? ($payload['package'] ?? null),
            'locale' => $payload['locale'] ?? app()->getLocale(),
            'phone' => $payload['phone'] ?? null,
            'notes' => $payload['notes'] ?? null,
            'agreeTerms' => isset($payload['agree_terms']) ? (bool) $payload['agree_terms'] : null,
            'company' => $payload['company'] ?? null,
            'businessType' => $payload['business_type'] ?? null,
            'metadata' => is_array($payload['metadata'] ?? null) ? $payload['metadata'] : [],
            'serviceIds' => array_map('intval', is_array($payload['service_ids'] ?? null) ? $payload['service_ids'] : []),
            'source' => $payload['source'] ?? null,
            'stageCode' => $payload['stage_code'] ?? null,
        ]);
    }

    public static function fromRequest(Request $request): static
    {
        return static::fromArray($request->all());
    }
}
