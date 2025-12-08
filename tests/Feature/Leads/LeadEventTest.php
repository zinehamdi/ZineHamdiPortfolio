<?php

namespace Tests\Feature\Leads;

use App\Domain\Leads\Data\LeadData;
use App\Domain\Leads\Data\LeadUpdateData;
use App\Domain\Leads\Events\LeadCreated;
use App\Domain\Leads\Events\LeadStageChanged;
use App\Domain\Leads\LeadStage;
use App\Domain\Shared\Data\PriceEstimate;
use App\Domain\Leads\Data\QuoteRequestData;
use App\Mail\NewLeadNotification;
use App\Services\Leads\LeadService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class LeadEventTest extends TestCase
{
    use RefreshDatabase;

    public function test_lead_created_queues_notification(): void
    {
        config([
            'queue.default' => 'sync',
            'notifications.leads.recipients' => ['alerts@example.com'],
        ]);
        Mail::fake();

        $stage = LeadStage::query()->create([
            'code' => 'new',
            'label' => 'New',
            'rank' => 1,
        ]);

        $leadService = app(LeadService::class);

        $result = Event::fakeFor(function () use ($leadService, $stage) {
            $lead = $leadService->create($this->testLeadData(['stage_id' => $stage->id]));

            Event::assertDispatched(LeadCreated::class, function (LeadCreated $event) use ($lead) {
                return $event->lead->is($lead);
            });

            return [
                'lead' => $lead,
                'events' => Event::dispatched(LeadCreated::class),
            ];
        });

        $lead = $result['lead'];

        $this->dispatchRecordedEvents($result['events']);

        Mail::assertQueued(NewLeadNotification::class, function (NewLeadNotification $mail) use ($lead) {
            return $mail->lead->is($lead);
        });
    }

    public function test_stage_change_invalidates_dashboard_cache(): void
    {
        config([
            'queue.default' => 'sync',
            'notifications.leads.recipients' => ['alerts@example.com'],
        ]);
        Mail::fake();

        $leadService = app(LeadService::class);

        $stages = [
            LeadStage::query()->create(['code' => 'new', 'label' => 'New', 'rank' => 1]),
            LeadStage::query()->create(['code' => 'qualified', 'label' => 'Qualified', 'rank' => 2]),
        ];

        $createResult = Event::fakeFor(function () use ($leadService, $stages) {
            $lead = $leadService->create($this->testLeadData(['stage_id' => $stages[0]->id]));

            return [
                'lead' => $lead,
                'events' => Event::dispatched(LeadCreated::class),
            ];
        });

        $lead = $createResult['lead'];

        $this->dispatchRecordedEvents($createResult['events']);

        Cache::put('admin.dashboard.metrics', 'value');
        Cache::put('admin.dashboard.leads_by_stage', 'value');

        $events = Event::fakeFor(function () use ($leadService, $lead, $stages) {
            $leadService->update($lead, LeadUpdateData::fromArray([
                'stage_id' => $stages[1]->id,
            ]));

            Event::assertDispatched(LeadStageChanged::class, function (LeadStageChanged $event) use ($lead, $stages) {
                return $event->lead->is($lead)
                    && optional($event->previousStage)->is($stages[0])
                    && optional($event->currentStage)->is($stages[1]);
            });

            return Event::dispatched(LeadStageChanged::class);
        });

        $this->dispatchRecordedEvents($events);

        $this->assertNull(Cache::get('admin.dashboard.metrics'));
        $this->assertNull(Cache::get('admin.dashboard.leads_by_stage'));
    }

    private function testLeadData(array $context = []): LeadData
    {
        $quote = QuoteRequestData::fromArray([
            'name' => 'Test Lead',
            'email' => 'lead@example.com',
            'needs' => ['website' => true],
            'locale' => 'en',
            'phone' => '+1111111',
        ]);

        $estimate = PriceEstimate::fromValues(1000, 2000, 'USD');

        return LeadData::fromQuote($quote, $estimate, array_merge([
            'service_ids' => [],
            'source' => 'tests',
        ], $context));
    }

    /**
     * @param  iterable<int,array<int,mixed>>  $events
     */
    private function dispatchRecordedEvents(iterable $events): void
    {
        collect($events)->each(static function (array $arguments): void {
            event($arguments[0]);
        });
    }
}
