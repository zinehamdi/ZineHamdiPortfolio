<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Package>
 */
class PackageFactory extends Factory
{
    protected $model = Package::class;

    public function definition(): array
    {
        $slug = fake()->unique()->randomElement(['starter','smart','pro','custom-'.fake()->numberBetween(1,1000)]);
        $title = ['ar' => ucfirst($slug), 'en' => ucfirst($slug), 'fr' => ucfirst($slug)];
        $features = [
            ['ar' => 'ميزة 1', 'en' => 'Feature 1', 'fr' => 'Fonction 1'],
            ['ar' => 'ميزة 2', 'en' => 'Feature 2', 'fr' => 'Fonction 2'],
            ['ar' => 'ميزة 3', 'en' => 'Feature 3', 'fr' => 'Fonction 3'],
        ];
        return [
            'slug' => $slug,
            'title' => $title,
            'subtitle' => [
                'ar' => 'وصف للحزمة',
                'en' => 'Package description',
                'fr' => 'Description du forfait',
            ],
            'features' => $features,
            'price_monthly' => fake()->boolean() ? fake()->numberBetween(49, 499) : null,
            'price_once' => fake()->boolean() ? fake()->numberBetween(500, 5000) : null,
            'currency' => 'TND',
            'delivery_days' => fake()->numberBetween(7, 45),
            'is_featured' => fake()->boolean(20),
            'is_active' => true,
        ];
    }
}
