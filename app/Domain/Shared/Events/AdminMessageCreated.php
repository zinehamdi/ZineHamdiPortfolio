<?php

namespace App\Domain\Shared\Events;

use App\Domain\Shared\AdminMessage;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdminMessageCreated
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public readonly AdminMessage $message)
    {
    }
}
