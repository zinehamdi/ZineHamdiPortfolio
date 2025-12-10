<section id="quote" class="py-12 relative mlp-bg-root border-t border-mlp-border-subtle/50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="text-center mb-12" data-animate="quote-header">
            <div class="inline-flex items-center gap-2 mb-4 px-4 py-2 rounded-mlp-pill mlp-glass-subtle border border-mlp-border-subtle/60">
                <span class="w-2 h-2 bg-brand-accent rounded-full"></span>
                <span class="text-brand-accent text-sm font-mono font-bold">{{ __('quote.section_label') }}</span>
            </div>
            <h2 class="section-title mb-4 text-white">{{ __('quote.title') }}</h2>
            <p class="text-white/70 max-w-2xl mx-auto text-lg">
                {{ __('quote.subtitle') }}
            </p>
        </div>

        <div class="max-w-3xl mx-auto mlp-card-strong mlp-metal-sheen border border-mlp-border-subtle/70 overflow-hidden" data-animate="quote-wizard">
            <livewire:quote-wizard />
        </div>
    </div>
</section>
