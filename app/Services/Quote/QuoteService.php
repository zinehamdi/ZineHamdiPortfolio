<?php

namespace App\Services\Quote;

use App\Domain\Shared\Data\PriceEstimate;
use App\Domain\Leads\Data\LeadData;
use App\Domain\Leads\Data\QuoteRequestData;
use App\Repositories\Contracts\PackageRepository;
use App\Repositories\Contracts\ServiceRepository;
use App\Services\Leads\LeadService;

class QuoteService
{
    public function __construct(
        private readonly PackageRepository $packages,
        private readonly LeadService $leads,
        private readonly QuoteEstimator $estimator,
        private readonly ServiceRepository $services,
    ) {}

    public function handle(QuoteRequestData $dto): PriceEstimate
    {
        $package = $dto->packageSlug
            ? $this->packages->findBySlug($dto->packageSlug)
            : null;

        $estimate = $this->estimator->compute($dto, $package);

        $serviceIds = $this->resolveServiceSelections($dto->needs);

        $leadData = LeadData::fromQuote($dto, $estimate, [
            'package_id' => $package?->id,
            'metadata' => [
                'ip' => request()?->ip(),
            ],
            'source' => 'quote_wizard',
            'service_ids' => $serviceIds,
        ]);

        $this->leads->create($leadData);

        return $estimate;
    }

    /**
     * @param array<mixed> $needs
     * @return array<int>
     */
    private function resolveServiceSelections(array $needs): array
    {
        $weights = config('quote.needs', []);
        $selected = [];

        foreach ($needs as $key => $value) {
            $needKey = is_string($key) ? $key : (is_string($value) ? $value : null);
            $isSelected = is_bool($value) ? $value : $needKey !== null;

            if (! $isSelected || ! $needKey) {
                continue;
            }

            $selected[] = $needKey;
        }

        $serviceIds = [];

        foreach (array_unique($selected) as $needKey) {
            $config = $weights[$needKey] ?? null;
            $slug = $config['service_slug'] ?? null;

            if (! $slug) {
                continue;
            }

            $service = $this->services->findBySlug($slug);

            if ($service) {
                $serviceIds[] = $service->id;
            }
        }

        return $serviceIds;
    }
}
