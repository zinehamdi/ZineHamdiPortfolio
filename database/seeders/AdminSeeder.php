<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['username' => 'zinehamdi'],
            [
                'name' => 'Hamdi Zine',
                'email' => 'admin@example.com',
                'password' => Hash::make('Admin2025$'),
            ]
        );
    }
}
