<?php

return [
    'currency' => env('QUOTE_DEFAULT_CURRENCY', 'TND'),
    'needs' => [
        'website' => ['weight' => 1200, 'service_slug' => 'site-management'],
        'content' => ['weight' => 400, 'service_slug' => 'social-content'],
        'ai' => ['weight' => 300, 'service_slug' => 'ai-prompting'],
        'seo' => ['weight' => 350, 'service_slug' => 'seo'],
    ],
];
