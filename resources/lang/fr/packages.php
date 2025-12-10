<?php

return [
    'meta' => [
        'title' => 'Offres',
        'description' => 'Paliers de prix transparents pour sites et applis. Choisissez une offre ou demandez un devis.',
        'og_image' => 'images/og/packages.jpg',
    ],
    'title' => 'Des offres simples et évolutives',
    'intro' => 'Choisissez un point de départ. Toute offre peut être adaptée à vos besoins.',
    'cta_label' => 'Obtenir un devis',
    'tiers' => [
        [
            'name' => 'Starter',
            'price' => '699 TND',
            'original_price' => '999 TND',
            'features' => ['1‑3 pages','Design responsive','SEO basique','Formulaire de contact'],
            'slug' => 'starter',
        ],
        [
            'name' => 'Smart',
            'price' => '1 399 TND',
            'original_price' => '1 999 TND',
            'features' => ['Jusqu\'à 8 pages', 'Blog/Portfolio', 'SEO amélioré', 'Analytics'],
            'slug' => 'smart',
        ],
        [
            'name' => 'Pro',
            'price' => '2 449 TND',
            'original_price' => '3 499 TND',
            'features' => ['Pages illimitées','E‑commerce/Paiements','SEO avancé','Intégrations'],
            'slug' => 'pro',
            'featured' => true,
        ],
    ],
];
