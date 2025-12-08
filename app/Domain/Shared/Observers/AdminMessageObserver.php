<?php

namespace App\Domain\Shared\Observers;

use App\Domain\Shared\AdminMessage;
use App\Domain\Shared\Events\AdminMessageCreated;

class AdminMessageObserver
{
    public function created(AdminMessage $message): void
    {
        AdminMessageCreated::dispatch($message);
    }
}
