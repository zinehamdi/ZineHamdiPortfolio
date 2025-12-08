<?php

return [
    'leads' => [
        'recipients' => array_filter(array_map('trim', explode(',', (string) env('LEAD_ALERT_RECIPIENTS', '')))),
    ],
    'contacts' => [
        'recipients' => array_filter(array_map('trim', explode(',', (string) env('CONTACT_ALERT_RECIPIENTS', '')))),
    ],
];
