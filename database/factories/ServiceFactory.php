<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        $slug = fake()->unique()->slug();
        $title = ['ar' => ucfirst($slug), 'en' => ucfirst($slug), 'fr' => ucfirst($slug)];
        return [
            'slug' => $slug,
            'title' => $title,
            'summary' => [
                'ar' => 'ملخص ' . $slug,
                'en' => 'Summary ' . $slug,
                'fr' => 'Résumé ' . $slug,
            ],
            'body' => [
                'ar' => 'تفاصيل الخدمة ' . $slug,
                'en' => 'Service details ' . $slug,
                'fr' => 'Détails du service ' . $slug,
            ],
            'icon' => null,
            'is_active' => true,
        ];
    }
}
