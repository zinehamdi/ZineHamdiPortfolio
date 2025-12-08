<?php

namespace App\Domain\Leads;

use App\Domain\Services\Service;
use App\Models\Lead as BaseLead;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Domain Lead model to keep a clean namespace boundary while leveraging Eloquent features.
 */
class Lead extends BaseLead
{
	protected static function newFactory()
	{
		return \Database\Factories\LeadFactory::new();
	}

	public function stage(): BelongsTo
	{
		return $this->belongsTo(LeadStage::class, 'lead_stage_id');
	}

	public function services(): BelongsToMany
	{
		return $this->belongsToMany(Service::class, 'lead_service')->withTimestamps();
	}
}
