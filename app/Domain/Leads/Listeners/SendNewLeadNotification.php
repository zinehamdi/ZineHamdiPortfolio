<?php

namespace App\Domain\Leads\Listeners;

use App\Domain\Leads\Events\LeadCreated;
use App\Mail\NewLeadNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewLeadNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(LeadCreated $event): void
    {
        $recipients = $this->recipients();

        if (empty($recipients)) {
            return;
        }

        Mail::to($recipients)->queue(new NewLeadNotification($event->lead));
    }

    /**
     * @return array<int,string>
     */
    private function recipients(): array
    {
        $configured = config('notifications.leads.recipients', []);
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
