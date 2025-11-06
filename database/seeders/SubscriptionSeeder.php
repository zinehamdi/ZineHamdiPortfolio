<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class SubscriptionSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['email' => 'alice@example.test', 'plan' => 'smart', 'status' => 'active', 'renews_at' => now()->addMonth()],
            ['email' => 'bob@example.test', 'plan' => 'starter', 'status' => 'trialing', 'renews_at' => now()->addDays(14)],
            ['email' => 'carol@example.test', 'plan' => 'pro', 'status' => 'active', 'renews_at' => now()->addMonths(3)],
            ['email' => 'dave@example.test', 'plan' => 'smart', 'status' => 'canceled', 'renews_at' => now()->subDay()],
            ['email' => 'eve@example.test', 'plan' => 'starter', 'status' => 'active', 'renews_at' => now()->addMonth()],
        ];

        foreach ($rows as $r) {
            Subscription::create($r);
        }
    }
}
