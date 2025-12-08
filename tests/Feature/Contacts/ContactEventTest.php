<?php

namespace Tests\Feature\Contacts;

use App\Domain\Contacts\Events\ContactMessageCreated;
use App\Domain\Contacts\Data\ContactMessageData;
use App\Mail\ContactMessage as ContactMessageMail;
use App\Services\Contacts\ContactService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactEventTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_message_queues_notification(): void
    {
        config([
            'queue.default' => 'sync',
            'notifications.contacts.recipients' => ['support@example.com'],
        ]);

        Mail::fake();

        $service = app(ContactService::class);
        $dto = ContactMessageData::fromArray([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'message' => 'Please contact me',
        ]);

        $result = Event::fakeFor(function () use ($service, $dto) {
            $message = $service->submit($dto);

            Event::assertDispatched(ContactMessageCreated::class, function (ContactMessageCreated $event) use ($message) {
                return $event->message->is($message);
            });

            return [
                'message' => $message,
                'events' => Event::dispatched(ContactMessageCreated::class),
            ];
        });

        collect($result['events'])->each(static function (array $arguments): void {
            event($arguments[0]);
        });

        Mail::assertQueued(ContactMessageMail::class, function (ContactMessageMail $mail) {
            return $mail->data['email'] === 'jane@example.com';
        });
    }
}
