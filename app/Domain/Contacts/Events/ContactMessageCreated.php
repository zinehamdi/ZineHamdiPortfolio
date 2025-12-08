<?php

namespace App\Domain\Contacts\Events;

use App\Domain\Contacts\ContactMessage;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContactMessageCreated
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public readonly ContactMessage $message)
    {
    }
}
