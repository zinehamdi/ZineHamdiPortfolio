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
            'price' => '999',
            'features' => ['1‑3 pages','Design responsive','SEO basique','Formulaire de contact'],
            'slug' => 'starter',
        ],
        [
            'name' => 'Smart',
            'price' => '1 999',
            'features' => ['Jusqu’à 8 pages','Blog/Portfolio','SEO amélioré','Analytics'],
            'slug' => 'smart',
        ],
        [
            'name' => 'Pro',
            'price' => '3 499',
            'features' => ['Pages illimitées','E‑commerce/Paiements','SEO avancé','Intégrations'],
            'slug' => 'pro',
            'featured' => true,
        ],
    ],
];
