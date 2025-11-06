<?php

return [
    'meta' => [
        'title' => 'À propos',
        'description' => 'Mon parcours, mes valeurs et ma façon de travailler.',
        'og_image' => 'images/og/about.jpg',
    ],
    // Keys used by sections/about.blade.php
    'title' => 'À propos de moi',
    'subtitle' => "Je suis Hamdi Zine — développeur full-stack, chef de projet et bâtisseur digital",
    'bio' => "Basé en Tunisie, j’apporte plus de 5 ans d’expérience en développement web, en gestion de projet agile et en intégration d’outils IA. Ma mission : offrir aux entrepreneurs des solutions complètes et abordables, sans les coûts d’une grande équipe.",
    'what_i_do' => 'Ce que je fais',
    'metrics' => [
        'years' => 'ANNÉES D’EXPÉRIENCE',
        'projects' => 'PROJETS LIVRÉS',
        'partners' => 'PARTENAIRES SATISFAITS',
        'certs' => 'CERTIFICATIONS',
    ],
    'do' => [
        'webdev' => 'DÉVELOPPEMENT WEB',
        'webdev_desc' => 'Solutions Laravel, Vue et Angular rapides et sécurisées.',
        'pm' => 'GESTION DE PROJET',
        'pm_desc' => 'Méthodes agiles, backlog clair, sprints organisés et résultats.',
        'ai' => 'INTÉGRATION IA',
        'ai_desc' => 'Chatbots personnalisés et automatisations pour booster votre business.',
        'strategy' => 'STRATÉGIE D’AFFAIRES',
        'strategy_desc' => 'Transformer vos idées en projets concrets, de l’idée au lancement.',
    ],
    // Legacy keys kept for other pages, not used by this section anymore
    'intro' => 'Je conçois des applis Laravel et des expériences propulsées par l’IA, centrées performance et UX.',
    'sections' => [
        'mission' => [
            'title' => 'Mission',
            'body' => 'Aider les entreprises à livrer vite des produits accessibles et efficaces.',
        ],
        'bio' => [
            'title' => 'Bio',
            'body' => 'Développeur full‑stack avec expérience web, contenu et intégrations IA.',
        ],
        'cta' => [
            'title' => 'Travaillons ensemble',
            'body' => 'Parlez‑moi de votre projet pour une estimation rapide.',
        ],
    ],
    'skills' => [
        'Laravel','Livewire','Tailwind','Vue','Pest','MySQL','Stripe','OpenAI'
    ],
    'timeline' => [
        [ 'year' => '2018', 'title' => 'Débuts sur des applis Laravel' ],
        [ 'year' => '2021', 'title' => 'Première intégration IA livrée' ],
        [ 'year' => '2024', 'title' => 'Consultant indépendant' ],
    ],
];
