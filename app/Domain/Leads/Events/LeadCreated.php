<?php

namespace App\Domain\Leads\Events;

use App\Domain\Leads\Lead;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LeadCreated
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public readonly Lead $lead)
    {
    }
}
