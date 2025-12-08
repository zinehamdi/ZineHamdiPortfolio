<?php

namespace App\Domain\Leads\Data;

final class LeadUpdateData
{
    /**
     * @param array<int,int>|null $serviceIds
     * @param array<string,mixed>|null $metadata
     * @param array<string,mixed>|null $needs
     */
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $email,
        public readonly ?string $phone,
        public readonly ?string $company,
        public readonly ?string $locale,
        public readonly ?string $businessType,
        public readonly ?array $needs,
        public readonly ?string $budgetRange,
        public readonly ?string $notes,
        public readonly ?int $packageId,
        public readonly ?int $priceEstimateMin,
        public readonly ?int $priceEstimateMax,
        public readonly ?string $currency,
        public readonly ?string $stageCode,
        public readonly ?int $stageId,
        public readonly ?string $source,
        public readonly ?array $metadata,
        public readonly ?array $serviceIds,
    ) {}

    /**
     * @param array<string,mixed> $payload
     */
    public static function fromArray(array $payload): self
    {
        return new self(
            name: $payload['name'] ?? null,
            email: $payload['email'] ?? null,
            phone: $payload['phone'] ?? null,
            company: $payload['company'] ?? null,
            locale: $payload['locale'] ?? null,
            businessType: $payload['business_type'] ?? null,
            needs: is_array($payload['needs'] ?? null) ? $payload['needs'] : null,
            budgetRange: $payload['budget_range'] ?? null,
            notes: $payload['notes'] ?? null,
            packageId: isset($payload['package_id']) ? (int) $payload['package_id'] : null,
            priceEstimateMin: isset($payload['price_estimate_min']) ? (int) $payload['price_estimate_min'] : null,
            priceEstimateMax: isset($payload['price_estimate_max']) ? (int) $payload['price_estimate_max'] : null,
            currency: $payload['currency'] ?? null,
            stageCode: $payload['stage_code'] ?? null,
            stageId: isset($payload['stage_id']) ? (int) $payload['stage_id'] : null,
            source: $payload['source'] ?? null,
            metadata: is_array($payload['metadata'] ?? null) ? $payload['metadata'] : null,
            serviceIds: isset($payload['service_ids']) && is_array($payload['service_ids'])
                ? array_map('intval', $payload['service_ids'])
                : null,
        );
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        $attributes = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'locale' => $this->locale,
            'business_type' => $this->businessType,
            'needs' => $this->needs,
            'budget_range' => $this->budgetRange,
            'notes' => $this->notes,
            'package_id' => $this->packageId,
            'price_estimate_min' => $this->priceEstimateMin,
            'price_estimate_max' => $this->priceEstimateMax,
            'currency' => $this->currency,
            'lead_stage_id' => $this->stageId,
            'source' => $this->source,
            'metadata' => $this->metadata,
        ];

        return array_filter($attributes, static fn ($value) => $value !== null);
    }
}
