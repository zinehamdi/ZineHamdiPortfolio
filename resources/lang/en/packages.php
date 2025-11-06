<?php

return [
    'meta' => [
        'title' => 'Project Packages',
        'description' => 'Transparent pricing tiers for websites and apps. Pick a package or get a custom quote.',
        'og_image' => 'images/og/packages.jpg',
    ],
    'title' => 'Simple packages that scale',
    'intro' => 'Choose a starting point. We can tailor any package to your needs.',
    'cta_label' => 'Get a quote',
    'tiers' => [
        [
            'name' => 'Starter',
            'price' => '999',
            'features' => ['1‑3 pages','Responsive design','Basic SEO','Contact form'],
            'slug' => 'starter',
        ],
        [
            'name' => 'Smart',
            'price' => '1,999',
            'features' => ['Up to 8 pages','Blog/Portfolio','Enhanced SEO','Analytics'],
            'slug' => 'smart',
        ],
        [
            'name' => 'Pro',
            'price' => '3,499',
            'features' => ['Unlimited pages','E‑commerce/Payments','Advanced SEO','Integrations'],
            'slug' => 'pro',
            'featured' => true,
        ],
    ],
];
