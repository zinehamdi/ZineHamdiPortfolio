<?php
return [
    'business' => [
        'title' => 'Business',
        'fields' => [
            'business_type' => 'Business type',
            'company' => 'Company (optional)',
        ],
    ],
    'needs' => [
        'title' => 'Needs',
        'need_website' => 'I need a website',
        'need_content' => 'I need content',
        'need_ai' => 'I need AI features',
        'need_seo' => 'I need SEO',
    ],
    'budget' => [
        'title' => 'Budget',
        'budget_range' => 'Budget range',
        'ranges' => [
            '<=1000' => '<= 1000',
            '1000-2500' => '1000 - 2500',
            '>=2500' => '>= 2500',
        ],
    ],
    'contact' => [
        'title' => 'Contact',
        'name' => 'Your Name',
        'email' => 'Email Address',
        'phone' => 'Phone (optional)',
        'notes' => 'Notes (optional)',
        'agree_terms' => 'I agree to the terms',
    ],
    'result' => [
        'title' => 'Your Quote',
        'message' => "You'll receive an email shortly with details.",
        'whatsapp' => 'WhatsApp Me',
    ],
    'cta' => ['start' => 'Start quote'],
    'errors' => [
        'rate_limit' => 'Too many requests. Please try again later.',
        'honeypot' => 'Spam detected.',
    ],
    'validations' => [
        'agree_required' => 'You must accept the terms.',
    ],
    'actions' => [
        'next' => 'Next',
        'prev' => 'Previous',
        'submit' => 'Get Estimate',
        'download_pdf' => 'Download PDF Quote (coming soon)',
    ],
];