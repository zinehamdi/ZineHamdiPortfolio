<?php

namespace App\Domain\Leads\Events;

use App\Domain\Leads\Lead;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LeadUpdated
{
    use Dispatchable;
    use SerializesModels;

    /**
     * @param array<int,string> $changedAttributes
     */
    public function __construct(
        public readonly Lead $lead,
        public readonly array $changedAttributes,
    ) {
    }
}
