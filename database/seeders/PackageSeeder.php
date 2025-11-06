<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'slug' => 'starter',
                'title' => ['ar' => 'بداية', 'en' => 'Starter', 'fr' => 'Starter'],
                'subtitle' => ['ar' => 'موقع تعريفي بسيط', 'en' => 'Simple brochure website', 'fr' => 'Site vitrine simple'],
                'features' => [
                    ['ar' => 'صفحة رئيسية', 'en' => 'Home page', 'fr' => 'Page d\'accueil'],
                    ['ar' => 'صفحة تواصل', 'en' => 'Contact page', 'fr' => 'Page contact'],
                    ['ar' => 'استضافة لمدة سنة', 'en' => '1-year hosting', 'fr' => 'Hébergement 1 an'],
                ],
                'price_monthly' => null,
                'price_once' => 1200,
                'currency' => 'TND',
                'delivery_days' => 10,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'slug' => 'smart',
                'title' => ['ar' => 'ذكي', 'en' => 'Smart', 'fr' => 'Smart'],
                'subtitle' => ['ar' => 'إضافات محتوى وسيو', 'en' => 'Content + SEO add-ons', 'fr' => 'Contenu + SEO'],
                'features' => [
                    ['ar' => '5 صفحات', 'en' => '5 pages', 'fr' => '5 pages'],
                    ['ar' => 'تحسين السرعة', 'en' => 'Speed optimization', 'fr' => 'Optimisation vitesse'],
                    ['ar' => 'أساسيات السيو', 'en' => 'SEO basics', 'fr' => 'SEO de base'],
                ],
                'price_monthly' => 99,
                'price_once' => 2500,
                'currency' => 'TND',
                'delivery_days' => 20,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'slug' => 'pro',
                'title' => ['ar' => 'محترف', 'en' => 'Pro', 'fr' => 'Pro'],
                'subtitle' => ['ar' => 'حلول متقدمة وذكاء اصطناعي', 'en' => 'Advanced + AI integrations', 'fr' => 'Avancé + IA'],
                'features' => [
                    ['ar' => 'واجهة إدارة', 'en' => 'Admin area', 'fr' => 'Zone admin'],
                    ['ar' => 'تكامل ذكاء اصطناعي', 'en' => 'AI integration', 'fr' => 'Intégration IA'],
                    ['ar' => 'تحليلات', 'en' => 'Analytics', 'fr' => 'Analytique'],
                ],
                'price_monthly' => 149,
                'price_once' => 4500,
                'currency' => 'TND',
                'delivery_days' => 30,
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            Package::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
