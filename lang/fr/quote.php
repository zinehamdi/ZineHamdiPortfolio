<?php
return [
    'business' => [
        'title' => 'Entreprise',
        'fields' => [
            'business_type' => "Type d'entreprise",
            'company' => 'Société (optionnel)',
        ],
    ],
    'needs' => [
        'title' => 'Besoins',
        'need_website' => 'J’ai besoin d’un site web',
        'need_content' => 'J’ai besoin de contenu',
        'need_ai' => 'J’ai besoin de fonctions IA',
        'need_seo' => 'J’ai besoin de SEO',
    ],
    'budget' => [
        'title' => 'Budget',
        'budget_range' => 'Plage de budget',
        'ranges' => [
            '<=1000' => '<= 1000',
            '1000-2500' => '1000 - 2500',
            '>=2500' => '>= 2500',
        ],
    ],
    'contact' => [
        'title' => 'Contact',
        'name' => 'Votre nom',
        'email' => 'Adresse e-mail',
        'phone' => 'Téléphone (optionnel)',
        'notes' => 'Notes (optionnel)',
        'agree_terms' => "J’accepte les conditions",
    ],
    'result' => [
        'title' => 'Votre devis',
        'message' => "Vous recevrez bientôt un e-mail avec les détails.",
        'whatsapp' => 'WhatsApp',
    ],
    'cta' => ['start' => 'Commencer le devis'],
    'errors' => [
        'rate_limit' => 'Trop de demandes. Veuillez réessayer plus tard.',
        'honeypot' => 'Spam détecté.',
    ],
    'validations' => [
        'agree_required' => 'Vous devez accepter les conditions.',
    ],
    'actions' => [
        'next' => 'Suivant',
        'prev' => 'Précédent',
        'submit' => 'Obtenir une estimation',
        'download_pdf' => 'Télécharger le devis PDF (bientôt)',
    ],
];