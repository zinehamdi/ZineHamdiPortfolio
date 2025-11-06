<?php

namespace Database\Factories;

use App\Models\Lead;
use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lead>
 */
class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->optional()->phoneNumber(),
            'company' => fake()->optional()->company(),
            'locale' => fake()->randomElement(['ar','en','fr']),
            'business_type' => fake()->optional()->randomElement(['food','olive_oil','services','retail','other']),
            'need_website' => fake()->boolean(70),
            'need_content' => fake()->boolean(50),
            'need_ai' => fake()->boolean(30),
            'need_seo' => fake()->boolean(40),
            'budget_range' => fake()->optional()->randomElement(['<=1000','1000-2500','>=2500']),
            'notes' => fake()->optional()->sentence(),
            'package_id' => Package::factory(),
            'price_estimate_min' => fake()->optional()->numberBetween(500, 2000),
            'price_estimate_max' => fake()->optional()->numberBetween(2000, 8000),
            'currency' => 'TND',
            'stage' => fake()->randomElement(['new','qualified','proposal','won','lost']),
            'source' => fake()->optional()->randomElement(['site','whatsapp']),
        ];
    }
}
