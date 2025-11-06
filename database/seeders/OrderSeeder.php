<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['customer_name' => 'Acme Corp', 'email' => 'ops@acme.test', 'total_cents' => 125000, 'currency' => 'TND', 'status' => 'paid', 'metadata' => ['source' => 'site', 'note' => 'Starter site']],
            ['customer_name' => 'Globex', 'email' => 'cto@globex.test', 'total_cents' => 299000, 'currency' => 'TND', 'status' => 'pending', 'metadata' => ['source' => 'referral']],
            ['customer_name' => 'Initech', 'email' => 'it@initech.test', 'total_cents' => 450000, 'currency' => 'TND', 'status' => 'paid', 'metadata' => ['source' => 'services', 'package' => 'pro']],
            ['customer_name' => 'Umbrella', 'email' => 'contact@umbrella.test', 'total_cents' => 189000, 'currency' => 'TND', 'status' => 'cancelled', 'metadata' => ['reason' => 'budget']],
            ['customer_name' => 'Soylent', 'email' => 'coo@soylent.test', 'total_cents' => 99000, 'currency' => 'TND', 'status' => 'paid', 'metadata' => ['source' => 'promo']],
        ];

        foreach ($rows as $r) {
            Order::create($r);
        }
    }
}
