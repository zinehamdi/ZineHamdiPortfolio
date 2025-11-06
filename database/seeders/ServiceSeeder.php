<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['slug' => 'site-management', 'title' => ['ar' => 'إدارة المواقع', 'en' => 'Site Management', 'fr' => 'Gestion de site'], 'summary' => ['ar' => 'صيانة وتحديث موقعك', 'en' => 'Maintain and update your site', 'fr' => 'Maintenir et mettre à jour votre site'], 'body' => ['ar' => 'تفاصيل إدارة المواقع', 'en' => 'Details about site management', 'fr' => 'Détails de la gestion de site'], 'icon' => 'heroicons:wrench'],
            ['slug' => 'laravel-development', 'title' => ['ar' => 'تطوير لارافيل', 'en' => 'Laravel Development', 'fr' => 'Développement Laravel'], 'summary' => ['ar' => 'بناء تطبيقات قوية', 'en' => 'Build robust apps', 'fr' => 'Construire des apps robustes'], 'body' => ['ar' => 'تفاصيل تطوير لارافيل', 'en' => 'Details about Laravel dev', 'fr' => 'Détails du dev Laravel'], 'icon' => 'logos:laravel'],
            ['slug' => 'ai-prompting', 'title' => ['ar' => 'ذكاء اصطناعي والسؤال', 'en' => 'AI & Prompting', 'fr' => 'IA & Prompting'], 'summary' => ['ar' => 'تجارب ذكية', 'en' => 'Smart experiences', 'fr' => 'Expériences intelligentes'], 'body' => ['ar' => 'تفاصيل الذكاء الاصطناعي', 'en' => 'AI details', 'fr' => "Détails de l'IA"], 'icon' => 'mdi:robot'],
            ['slug' => 'social-content', 'title' => ['ar' => 'محتوى اجتماعي', 'en' => 'Social Content', 'fr' => 'Contenu social'], 'summary' => ['ar' => 'إنشاء محتوى فعال', 'en' => 'Create effective content', 'fr' => 'Créer du contenu efficace'], 'body' => ['ar' => 'تفاصيل المحتوى الاجتماعي', 'en' => 'Social content details', 'fr' => 'Détails du contenu social'], 'icon' => 'mdi:instagram'],
            ['slug' => 'seo', 'title' => ['ar' => 'تحسين محركات البحث', 'en' => 'SEO', 'fr' => 'SEO'], 'summary' => ['ar' => 'تحسين الظهور', 'en' => 'Improve visibility', 'fr' => 'Améliorer la visibilité'], 'body' => ['ar' => 'تفاصيل السيو', 'en' => 'SEO details', 'fr' => 'Détails SEO'], 'icon' => 'mdi:google'],
        ];

        foreach ($items as $item) {
            Service::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
