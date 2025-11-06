<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash as HashFacade;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed base data
        $this->call([
            ServiceSeeder::class,
            PackageSeeder::class,
        ]);

        // Demo user (idempotent)
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => HashFacade::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Demo business data (only in local/testing)
        if (app()->environment(['local', 'testing'])) {
            $this->call([
                AdminSeeder::class,
                OrderSeeder::class,
                SubscriptionSeeder::class,
            ]);
        }
    }
}
