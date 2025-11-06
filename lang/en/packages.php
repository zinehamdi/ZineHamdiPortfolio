<?php

return [
    'title' => 'Packages',
    'intro' => 'Clear, transparent tiers that scale with your needs.',
    'meta' => [
        'title' => 'Packages — Transparent tiers that scale with you',
        'description' => 'Choose a tier that fits: Starter, Smart, or Pro. Clear features, fair pricing, and quick delivery.',
        'og_image' => '/images/og/packages.jpg',
    ],
    'tiers' => [
        [
            'slug' => 'starter',
            'name' => 'Starter',
            'tagline' => 'Quick launch, small footprint',
            'features' => [
                '1–3 pages brochure site',
                'Responsive Tailwind v4 UI',
                'Contact form + basic analytics',
                '1 month of support',
            ],
        ],
        [
            'slug' => 'smart',
            'name' => 'Smart',
            'tagline' => 'Content and growth ready',
            'features' => [
                'Up to 8 pages',
                'Blog + social content pipeline',
                'Performance + SEO essentials',
                '3 months of support',
            ],
            'featured' => true,
        ],
        [
            'slug' => 'pro',
            'name' => 'Pro',
            'tagline' => 'Custom features and integrations',
            'features' => [
                'Admin area & auth',
                'Payments or API integrations',
                'AI assistants & automations',
                '6 months of support',
            ],
        ],
    ],
    'cta_label' => 'Get a quote',
];
