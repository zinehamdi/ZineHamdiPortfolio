<?php

namespace App\Domain\Leads\Observers;

use App\Domain\Leads\Events\LeadStageChanged;
use App\Domain\Leads\Events\LeadUpdated;
use App\Domain\Leads\Lead;
use App\Domain\Leads\LeadStage;

class LeadObserver
{
    public function updated(Lead $lead): void
    {
        if (! $lead->wasChanged()) {
            return;
        }

        $changedAttributes = array_keys($lead->getChanges());

        if ($lead->wasChanged('lead_stage_id')) {
            $previousId = $lead->getOriginal('lead_stage_id');
            $previousStage = $previousId ? LeadStage::find($previousId) : null;
            $lead->loadMissing('stage');
            LeadStageChanged::dispatch(
                $lead,
                $previousStage,
                $lead->stage,
            );
        }

        LeadUpdated::dispatch($lead, $changedAttributes);
    }
}
