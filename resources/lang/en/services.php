<?php

return [
    'page_title' => 'Services',
    'page_desc' => 'From idea to launch: Laravel apps, content, SEO, and AI integrations.',
    'cta_quote' => 'Get a quote',
    'cards' => [
        'site-management' => [
            'title' => 'Site management',
            'summary' => 'Maintenance, updates, backups, and security for peace of mind.',
        ],
        'laravel-development' => [
            'title' => 'Laravel development',
            'summary' => 'Custom features, APIs, dashboards, billing, and more.',
        ],
        'ai-prompting' => [
            'title' => 'AI integrations',
            'summary' => 'Chatbots, content generation, and automation with modern LLMs.',
        ],
        'social-content' => [
            'title' => 'Social content',
            'summary' => 'Plan, write, and publish content that converts.',
        ],
        'seo' => [
            'title' => 'SEO',
            'summary' => 'Technical, on‑page, and performance SEO to grow organic traffic.',
        ],
    ],
    'pricing' => [
        'title' => 'Pricing',
        'subtitle' => 'Flexible options to match your scope and budget.',
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
        'badge_featured' => 'Most Popular',
    ],
    'promo' => [
        'title' => 'Why work with me',
        'subtitle' => 'A reliable full‑stack partner focused on your business outcomes — not just code.',
        'benefits' => [
            ['title' => 'End‑to‑end delivery', 'desc' => 'From strategy and UX to Laravel builds, hosting, and maintenance.'],
            ['title' => 'Agile & transparent', 'desc' => 'Short iterations, clear demos, and frequent check‑ins so you stay in control.'],
            ['title' => 'AI where it matters', 'desc' => 'Practical AI integrations to automate tasks and cut costs — no hype.'],
        ],
        'metrics' => [
            'projects' => 'projects shipped',
            'experience' => 'experience',
            'satisfaction' => 'client satisfaction',
            'response' => 'average response',
        ],
        'cta' => 'Get a quote',
    ],
];
