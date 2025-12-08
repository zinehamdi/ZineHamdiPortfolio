<?php

namespace App\Domain\Contacts\Observers;

use App\Domain\Contacts\ContactMessage;
use App\Domain\Contacts\Events\ContactMessageCreated;

class ContactMessageObserver
{
    public function created(ContactMessage $message): void
    {
        ContactMessageCreated::dispatch($message);
    }
}
