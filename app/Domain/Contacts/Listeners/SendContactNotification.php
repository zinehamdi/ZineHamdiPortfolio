<?php

namespace App\Domain\Contacts\Listeners;

use App\Domain\Contacts\Events\ContactMessageCreated;
use App\Mail\ContactMessage as ContactMessageMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendContactNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ContactMessageCreated $event): void
    {
        $recipients = $this->recipients();

        if (empty($recipients)) {
            return;
        }

        Mail::to($recipients)->queue(new ContactMessageMail($event->message->toArray()));
    }

    /**
     * @return array<int,string>
     */
    private function recipients(): array
    {
        $configured = config('notifications.contacts.recipients', []);

        $recipients = array_values(array_filter($configured, static fn ($value) => filled($value)));

        if (empty($recipients)) {
            $fallback = config('mail.from.address');
            if (filled($fallback)) {
                $recipients[] = $fallback;
            }
        }

        return $recipients;
    }
}
