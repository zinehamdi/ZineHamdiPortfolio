<?php

return [
    'meta' => [
        'title' => 'الباقات',
        'description' => 'أسعار واضحة للمواقع والتطبيقات. اختر باقة أو اطلب عرضًا مخصصًا.',
        'og_image' => 'images/og/packages.jpg',
    ],
    'title' => 'باقات بسيطة وقابلة للتوسع',
    'intro' => 'اختر نقطة بداية. يمكن تخصيص أي باقة حسب احتياجاتك.',
    'cta_label' => 'احصل على عرض سعر',
    'tiers' => [
        [
            'name' => 'Starter',
            'price' => '699 TND',
            'original_price' => '999 TND',
            'features' => ['1‑3 صفحات','تصميم متجاوب','تحسين أساسي لمحركات البحث','نموذج اتصال'],
            'slug' => 'starter',
        ],
        [
            'name' => 'Smart',
            'price' => '1,399 TND',
            'original_price' => '1,999 TND',
            'features' => ['حتى 8 صفحات','مدونة/معرض الأعمال','تحسين SEO مُعزّز','تحليلات'],
            'slug' => 'smart',
        ],
        [
            'name' => 'Pro',
            'price' => '2,449 TND',
            'original_price' => '3,499 TND',
            'features' => ['صفحات غير محدودة','تجارة إلكترونية/مدفوعات','SEO متقدم','تكاملات'],
            'slug' => 'pro',
            'featured' => true,
        ],
    ],
];
