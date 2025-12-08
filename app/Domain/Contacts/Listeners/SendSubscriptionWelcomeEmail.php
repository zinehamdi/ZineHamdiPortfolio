<?php

namespace App\Domain\Contacts\Listeners;

use App\Domain\Contacts\Events\SubscriptionActivated;
use App\Mail\SubscriptionWelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendSubscriptionWelcomeEmail implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(SubscriptionActivated $event): void
    {
        Mail::to($event->subscription->email)
            ->queue(new SubscriptionWelcomeMail($event->subscription));
    }
}
