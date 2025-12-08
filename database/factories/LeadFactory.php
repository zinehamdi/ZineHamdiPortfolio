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
        $needs = fake()->randomElements(['website', 'content', 'ai', 'seo'], fake()->numberBetween(1, 4));

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->optional()->phoneNumber(),
            'company' => fake()->optional()->company(),
            'locale' => fake()->randomElement(['ar', 'en', 'fr']),
            'business_type' => fake()->optional()->randomElement(['food', 'tech', 'services', 'retail', 'other']),
            'needs' => $needs,
            'budget_range' => fake()->optional()->randomElement(['<=1000', '1000-2500', '>=2500']),
            'notes' => fake()->optional()->sentence(),
            'package_id' => Package::factory(),
            'price_estimate_min' => fake()->optional()->numberBetween(500, 2000),
            'price_estimate_max' => fake()->optional()->numberBetween(2000, 8000),
            'currency' => fake()->randomElement(['USD', 'EUR', 'TND']),
            'lead_stage_id' => null,
            'source' => fake()->optional()->randomElement(['site', 'whatsapp', 'referral']),
            'metadata' => ['utm' => fake()->slug()],
        ];
    }
}
