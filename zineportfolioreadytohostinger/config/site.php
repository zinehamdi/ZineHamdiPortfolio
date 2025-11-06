<?php

return [
    'admin_email' => env('ADMIN_EMAIL', 'Zinehamdi8@gmail.com'),
    'whatsapp_number' => env('WHATSAPP_NUMBER', '+21625777926'),
    'social' => [
        'github' => env('SOCIAL_GITHUB', ''),
        'linkedin' => env('SOCIAL_LINKEDIN', ''),
        'instagram' => env('SOCIAL_INSTAGRAM', ''),
    ],
    // Configurable blog/promo card on hero right panel
    'hero_promo' => [
        'title' => env('HERO_PROMO_TITLE', 'Today on the blog'),
        'text' => env('HERO_PROMO_TEXT', 'I share quick notes on Laravel, AI integrations, and product tips.'),
        'cta' => env('HERO_PROMO_CTA', 'Read more'),
        // Path under public/
        'image' => env('HERO_PROMO_IMAGE', 'images/hero-promo.jpg'),
        // Default to localized blog route
        'link' => env('HERO_PROMO_LINK', null),
    ],
];
