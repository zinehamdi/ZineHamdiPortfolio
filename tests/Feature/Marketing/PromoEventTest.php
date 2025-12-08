<?php

namespace Tests\Feature\Marketing;

use App\Domain\Marketing\Data\PromoData;
use App\Domain\Marketing\Events\PromoSaved;
use App\Services\Marketing\PromoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class PromoEventTest extends TestCase
{
    use RefreshDatabase;

    public function test_promo_save_flushes_cache(): void
    {
        Cache::put('promos.active', 'value');

        $service = app(PromoService::class);

        $events = Event::fakeFor(function () use ($service) {
            $service->save(PromoData::fromArray([
                'title' => 'Promo',
                'text' => 'Text',
            ]));

            Event::assertDispatched(PromoSaved::class);

            return Event::dispatched(PromoSaved::class);
        });

        collect($events)->each(static function (array $arguments): void {
            event($arguments[0]);
        });

        $this->assertNull(Cache::get('promos.active'));
    }
}
