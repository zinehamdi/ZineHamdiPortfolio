<?php

return [
    'page_title' => 'Services',
    'page_desc' => 'De l’idée au lancement : applis Laravel, contenu, SEO et intégrations IA.',
    'cta_quote' => 'Obtenir un devis',
    'cards' => [
        'site-management' => [
            'title' => 'Gestion de site',
            'summary' => 'Maintenance, mises à jour, sauvegardes et sécurité.',
        ],
        'laravel-development' => [
            'title' => 'Développement Laravel',
            'summary' => 'Fonctionnalités sur mesure, API, dashboards, facturation…',
        ],
        'ai-prompting' => [
            'title' => 'Intégrations IA',
            'summary' => 'Chatbots, génération de contenu et automatisation avec des LLMs modernes.',
        ],
        'social-content' => [
            'title' => 'Contenu social',
            'summary' => 'Planifier, rédiger et publier du contenu qui convertit.',
        ],
        'seo' => [
            'title' => 'SEO',
            'summary' => 'SEO technique, on‑page et performance pour croître en organique.',
        ],
    ],
    'pricing' => [
        'title' => 'Tarifs',
        'subtitle' => 'Des options flexibles adaptées à votre budget.',
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
        'badge_featured' => 'Le plus populaire',
    ],
    'promo' => [
        'title' => 'Pourquoi travailler avec moi',
        'subtitle' => 'Un partenaire full‑stack fiable, focalisé sur vos résultats — pas seulement le code.',
        'benefits' => [
            ['title' => 'Livraison de bout en bout', 'desc' => 'De la stratégie et l’UX aux apps Laravel, hébergement et maintenance.'],
            ['title' => 'Agile et transparent', 'desc' => 'Courtes itérations, démos claires et points réguliers pour garder le contrôle.'],
            ['title' => 'IA utile et pragmatique', 'desc' => 'Intégrations IA pratiques pour automatiser et réduire les coûts — sans hype.'],
        ],
        'metrics' => [
            'projects' => 'projets livrés',
            'experience' => 'd’expérience',
            'satisfaction' => 'satisfaction client',
            'response' => 'temps de réponse moyen',
        ],
        'cta' => 'Obtenir un devis',
    ],
];
