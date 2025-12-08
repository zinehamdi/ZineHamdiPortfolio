<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap.xml file';

    public function handle()
    {
        $baseUrl = config('app.url');
        $locales = ['en', 'fr', 'ar']; // Supported locales
        $staticRoutes = [
            'home',
            // Add other named routes here if they exist, e.g., 'projects', 'about'
        ];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">';

        foreach ($staticRoutes as $route) {
            // Default (English/Root)
            $xml .= '<url>';
            $xml .= '<loc>' . $baseUrl . '</loc>';
            $xml .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>1.0</priority>';

            // Localized alternates
            foreach ($locales as $locale) {
                $url = $baseUrl . '/' . $locale;
                $xml .= '<xhtml:link rel="alternate" hreflang="' . $locale . '" href="' . $url . '" />';
            }
            $xml .= '</url>';
            
            // Add entries for the localized versions themselves if you want them explicitly listed as separate <url> blocks
            // But typically, the root with alternates is sufficient for Google. 
            // However, for clarity, let's add the localized pages as their own entries too.
            foreach ($locales as $locale) {
                $xml .= '<url>';
                $xml .= '<loc>' . $baseUrl . '/' . $locale . '</loc>';
                $xml .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
                $xml .= '<changefreq>weekly</changefreq>';
                $xml .= '<priority>0.8</priority>';
                $xml .= '</url>';
            }
        }

        $xml .= '</urlset>';

        File::put(public_path('sitemap.xml'), $xml);

        $this->info('Sitemap generated successfully at public/sitemap.xml');
    }
}
