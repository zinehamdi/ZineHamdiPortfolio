<?php

namespace App\Mail;

use App\Domain\Contacts\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionWelcomeMail extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public function __construct(public Subscription $subscription)
    {
    }

    public function build(): self
    {
        return $this->subject(__('Thanks for subscribing'))
            ->markdown('mail.subscription-welcome', [
                'subscription' => $this->subscription,
            ]);
    }
}
