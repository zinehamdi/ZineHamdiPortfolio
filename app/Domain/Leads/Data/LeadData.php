<?php

namespace App\Domain\Leads\Data;

use App\Domain\Shared\Data\BaseData;
use App\Domain\Shared\Data\PriceEstimate;

final class LeadData extends BaseData
{
    public readonly QuoteRequestData $quote;
    public readonly PriceEstimate $estimate;
    /** @var array<string,mixed> */
    public readonly array $metadata;
    public readonly ?int $packageId;
    public readonly ?string $source;
    /** @var array<int,int>|null */
    public readonly ?array $serviceIds;
    public readonly ?string $stageCode;
    public readonly ?int $stageId;

    /**
     * @param array<string,mixed> $context
     */
    public static function fromQuote(QuoteRequestData $quote, PriceEstimate $estimate, array $context = []): static
    {
        return new static([
            'quote' => $quote,
            'estimate' => $estimate,
            'metadata' => array_merge(
                $quote->metadata,
                isset($context['metadata']) && is_array($context['metadata']) ? $context['metadata'] : []
            ),
            'packageId' => $context['package_id'] ?? null,
            'source' => $context['source'] ?? null,
            'serviceIds' => isset($context['service_ids']) && is_array($context['service_ids'])
                ? array_map('intval', $context['service_ids'])
                : null,
            'stageCode' => $context['stage_code'] ?? null,
            'stageId' => $context['stage_id'] ?? null,
        ]);
    }

    /**
     * @return array<string,mixed>
     */
    public function toLeadAttributes(): array
    {
        $attributes = [
            'name' => $this->quote->name,
            'email' => $this->quote->email,
            'phone' => $this->quote->phone,
            'company' => $this->quote->company,
            'locale' => $this->quote->locale,
            'business_type' => $this->quote->businessType,
            'needs' => $this->quote->needs,
            'budget_range' => $this->quote->budgetRange,
            'notes' => $this->quote->notes,
            'package_id' => $this->packageId,
            'price_estimate_min' => $this->estimate->min,
            'price_estimate_max' => $this->estimate->max,
            'currency' => $this->estimate->currency,
            'metadata' => $this->metadata,
            'source' => $this->source,
        ];

        if ($this->stageId !== null) {
            $attributes['lead_stage_id'] = $this->stageId;
        }

        return array_filter($attributes, static fn ($value) => $value !== null);
    }
}
