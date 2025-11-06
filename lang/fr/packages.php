<?php

return [
    'title' => 'Formules',
    'intro' => 'Des niveaux clairs et transparents qui évoluent avec vos besoins.',
    'meta' => [
        'title' => 'Formules — Des niveaux transparents qui évoluent avec vous',
        'description' => 'Choisissez la bonne formule : Starter, Smart ou Pro. Fonctionnalités claires et livraison rapide.',
        'og_image' => '/images/og/packages.jpg',
    ],
    'tiers' => [
        [
            'slug' => 'starter',
            'name' => 'Starter',
            'tagline' => 'Lancement rapide, empreinte légère',
            'features' => [
                'Site vitrine 1–3 pages',
                'UI responsive Tailwind v4',
                'Formulaire de contact + analytique de base',
                '1 mois de support',
            ],
        ],
        [
            'slug' => 'smart',
            'name' => 'Smart',
            'tagline' => 'Prêt pour le contenu et la croissance',
            'features' => [
                'Jusqu’à 8 pages',
                'Blog + pipeline de contenu social',
                'Performance + SEO essentiels',
                '3 mois de support',
            ],
            'featured' => true,
        ],
        [
            'slug' => 'pro',
            'name' => 'Pro',
            'tagline' => 'Fonctionnalités & intégrations sur mesure',
            'features' => [
                'Espace admin & auth',
                'Paiements ou intégrations API',
                'Assistants IA & automatisations',
                '6 mois de support',
            ],
        ],
    ],
    'cta_label' => 'Demander un devis',
];
