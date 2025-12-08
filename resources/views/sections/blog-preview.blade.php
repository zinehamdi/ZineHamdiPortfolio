<section id="blog" class="py-12 relative mlp-bg-root border-t border-mlp-border-subtle/50">
    @php
        $blogComics = [
            'comicbackground/laravelcomic1.jpg',
            'comicbackground/automationcomic.jpg',
            'comicbackground/ecomercecomic1.jpg',
        ];
    @endphp
    <div class="container mx-auto px-4 sm:px-6">
        <div class="flex items-end justify-between mb-12" data-animate="blog-header">
            <div>
                <h2 class="section-title mb-2 text-white">Technical Insights</h2>
                <p class="text-white/70">Practical guides on Laravel, AI integration, and web development strategies.</p>
            </div>
            <a href="{{ route('blog', ['locale' => app()->getLocale()]) }}"
                class="hidden md:inline-flex items-center gap-2 text-brand-accent font-bold hover:text-brand-accent/80 transition-colors">
                View All Articles
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8" data-animate="blog-grid">
            <!-- Article 1 -->
            <article
                class="mlp-card mlp-metal-sheen overflow-hidden border border-mlp-border-subtle/70 hover:border-mlp-gold/70 hover:shadow-mlp-laser-green transition-all duration-300 group">
                <div class="h-48 relative overflow-hidden">
                    <!-- Comic Background -->
                    <img src="{{ asset('images/' . $blogComics[0]) }}" 
                         alt="Laravel Development" 
                         class="absolute inset-0 w-full h-full object-cover opacity-40 group-hover:opacity-50 group-hover:scale-110 transition-all duration-700">
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-br from-black/60 via-black/40 to-transparent"></div>
                    <div
                        class="absolute top-4 left-4 bg-black/70 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-brand-accent border border-brand-accent/30 shadow-[0_0_15px_rgba(0,255,136,0.4)]">
                        Development
                    </div>
                </div>
                <div class="p-6">
                    <div class="text-sm text-gray-500 mb-2">Nov 15, 2025</div>
                    <h3 class="text-xl font-bold text-white mb-3 group-hover:text-brand-accent transition-colors">
                        Building Multi-Vendor Marketplaces with Laravel
                    </h3>
                    <p class="text-white/60 text-sm mb-4 line-clamp-2">
                        From booking systems to service platforms, learn the architecture patterns I use for scalable multi-vendor solutions.
                    </p>
                    <a href="{{ route('blog', ['locale' => app()->getLocale()]) }}"
                        class="inline-flex items-center text-brand-accent font-bold text-sm hover:underline">
                        Read Article
                    </a>
                </div>
            </article>

            <!-- Article 2 -->
            <article
                class="mlp-card mlp-metal-sheen overflow-hidden border border-mlp-border-subtle/70 hover:border-mlp-gold/70 hover:shadow-mlp-laser-green transition-all duration-300 group">
                <div class="h-48 relative overflow-hidden">
                    <!-- Comic Background -->
                    <img src="{{ asset('images/' . $blogComics[1]) }}" 
                         alt="AI Automation" 
                         class="absolute inset-0 w-full h-full object-cover opacity-40 group-hover:opacity-50 group-hover:scale-110 transition-all duration-700">
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-br from-black/60 via-black/40 to-transparent"></div>
                    <div
                        class="absolute top-4 left-4 bg-black/70 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-brand-accent border border-brand-accent/30 shadow-[0_0_15px_rgba(0,255,136,0.4)]">
                        AI &amp; Tech
                    </div>
                </div>
                <div class="p-6">
                    <div class="text-sm text-gray-500 mb-2">Oct 28, 2025</div>
                    <h3 class="text-xl font-bold text-white mb-3 group-hover:text-brand-accent transition-colors">
                        Automating Business Workflows with AI APIs
                    </h3>
                    <p class="text-white/60 text-sm mb-4 line-clamp-2">
                        Real-world examples of integrating AI automation into PHP applications for document processing and customer service.
                    </p>
                    <a href="{{ route('blog', ['locale' => app()->getLocale()]) }}"
                        class="inline-flex items-center text-brand-accent font-bold text-sm hover:underline">
                        Read Article
                    </a>
                </div>
            </article>

            <!-- Article 3 -->
            <article
                class="mlp-card mlp-metal-sheen overflow-hidden border border-mlp-border-subtle/70 hover:border-mlp-gold/70 hover:shadow-mlp-laser-green transition-all duration-300 group">
                <div class="h-48 relative overflow-hidden">
                    <!-- Comic Background -->
                    <img src="{{ asset('images/' . $blogComics[2]) }}" 
                         alt="E-commerce" 
                         class="absolute inset-0 w-full h-full object-cover opacity-40 group-hover:opacity-50 group-hover:scale-110 transition-all duration-700">
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-br from-black/60 via-black/40 to-transparent"></div>
                    <div
                        class="absolute top-4 left-4 bg-black/70 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-brand-accent border border-brand-accent/30 shadow-[0_0_15px_rgba(0,255,136,0.4)]">
                        Design
                    </div>
                </div>
                <div class="p-6">
                    <div class="text-sm text-gray-500 mb-2">Oct 12, 2025</div>
                    <h3 class="text-xl font-bold text-white mb-3 group-hover:text-brand-accent transition-colors">
                        E-commerce Optimization for Gulf Markets
                    </h3>
                    <p class="text-white/60 text-sm mb-4 line-clamp-2">
                        Payment integration, multilingual support, and cultural considerations when building online stores for Saudi and UAE customers.
                    </p>
                    <a href="{{ route('blog', ['locale' => app()->getLocale()]) }}"
                        class="inline-flex items-center text-brand-accent font-bold text-sm hover:underline">
                        Read Article
                    </a>
                </div>
            </article>
        </div>

        <div class="mt-8 text-center md:hidden">
            <a href="{{ route('blog', ['locale' => app()->getLocale()]) }}"
                class="inline-flex items-center gap-2 text-brand-accent font-bold">
                View All Articles
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>
</section>