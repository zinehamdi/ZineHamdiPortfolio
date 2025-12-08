<section id="pricing" class="py-12 relative mlp-bg-root border-t border-mlp-border-subtle/50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="text-center mb-16 mlp-glass-subtle rounded-mlp-md p-6 border border-mlp-border-subtle/60" data-animate="pricing-header">
            <h2 class="section-title mb-4 text-white">{{ __('packages.title') ?? 'Investment Packages' }}</h2>
            <p class="text-brand-muted max-w-2xl mx-auto text-lg">
                {{ __('packages.intro') ?? 'Clear pricing for web development projects. Choose a package or request a custom quote tailored to your needs.' }}
            </p>
        </div>

        @php
            $models = collect();
            if (\Illuminate\Support\Facades\Schema::hasTable('packages')) {
                $models = \App\Models\Package::query()->orderByDesc('is_featured')->get();
            }

            $useModels = $models->isNotEmpty();
            $tiers = $useModels ? null : __('packages.tiers');

            // Fallback if no models and no lang keys
            if (!$useModels && empty($tiers)) {
                $tiers = [
                    [
                        'title' => 'Starter',
                        'subtitle' => 'Perfect for small businesses',
                        'price' => '699',
                        'original_price' => '999',
                        'features' => ['Responsive Design', '5 Pages', 'Contact Form', 'Basic SEO'],
                        'cta' => 'Select',
                        'slug' => 'starter'
                    ],
                    [
                        'title' => 'Professional',
                        'subtitle' => 'For growing companies',
                        'price' => '1,399',
                        'original_price' => '1,999',
                        'features' => ['CMS Integration', '10 Pages', 'Advanced SEO', 'Analytics', 'Newsletter'],
                        'featured' => true,
                        'cta' => 'Select',
                        'slug' => 'pro'
                    ],
                    [
                        'title' => 'Enterprise',
                        'subtitle' => 'Custom solutions',
                        'price' => 'Custom',
                        'features' => ['Custom Development', 'API Integration', 'Priority Support', 'Cloud Hosting'],
                        'cta' => 'Select',
                        'slug' => 'enterprise'
                    ]
                ];
            }
        @endphp
        <div class="mlp-card-strong mlp-metal-sheen border border-mlp-border-subtle/70 p-4 sm:p-6" data-animate="pricing-table">
            <x-pricing-table :packages="$useModels ? $models : null" :tiers="$tiers" />
        </div>
    </div>
</section>