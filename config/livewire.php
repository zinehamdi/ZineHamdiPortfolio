<?php

return [
    // Prevent Livewire from auto-injecting its UMD <script> tag
    // We boot Livewire via Vite ESM in resources/js/app.js for CSP compatibility
    'inject_assets' => false,

    // Keep other config values at package defaults via mergeConfigFrom
];
