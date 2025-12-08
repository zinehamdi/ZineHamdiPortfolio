<?php

namespace App\Domain\Leads\Events;

use App\Domain\Leads\Lead;
use App\Domain\Leads\LeadStage;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LeadStageChanged
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
        public readonly Lead $lead,
        public readonly ?LeadStage $previousStage,
        public readonly ?LeadStage $currentStage,
    ) {
    }
}
