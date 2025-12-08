@php
	$rtl = app()->getLocale() === 'ar';
	$tr = function (string $key, string $def) {
		$v = __($key);
		return $v === $key ? $def : $v;
	};

	// Case study projects with SEO-rich content
	$caseStudies = [
		[
			'slug' => 'kairouanhub',
			'title' => $tr('portfolio.cases.kairouanhub.title', 'KairouanHub'),
			'subtitle' => $tr('portfolio.cases.kairouanhub.subtitle', 'Multi-vendor Service Platform'),
			'desc' => $tr('portfolio.cases.kairouanhub.desc', 'A comprehensive local services marketplace built with Laravel + Flutter. Features multi-vendor management, booking system, and provider profiles for Kairouan businesses.'),
			'tags' => ['Laravel', 'Flutter', 'Multi-vendor', 'API'],
			'color' => '#00FF88',
			'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
		],
		[
			'slug' => 'abiooc',
			'title' => $tr('portfolio.cases.abiooc.title', 'ABIOOC Olive Oil'),
			'subtitle' => $tr('portfolio.cases.abiooc.subtitle', 'Premium E-commerce Platform'),
			'desc' => $tr('portfolio.cases.abiooc.desc', 'E-commerce solution for premium Tunisian olive oil exports. Bilingual Arabic/English store with wholesale/retail pricing, designed for Gulf market buyers.'),
			'tags' => ['Laravel', 'E-commerce', 'Olive Oil', 'Gulf Market'],
			'color' => '#7B61FF',
			'icon' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z',
		],
		[
			'slug' => 'samouha',
			'title' => $tr('portfolio.cases.samouha.title', 'Samouha Couture'),
			'subtitle' => $tr('portfolio.cases.samouha.subtitle', 'Fashion Brand Website'),
			'desc' => $tr('portfolio.cases.samouha.desc', 'Elegant showcase website for a local Tunisian fashion brand. Features portfolio gallery, appointment booking, and social media integration.'),
			'tags' => ['Web Design', 'Fashion', 'Branding'],
			'color' => '#FF6B35',
			'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
		],
		[
			'slug' => 'olive-export',
			'title' => $tr('portfolio.cases.olive.title', 'Olive Oil Export Projects'),
			'subtitle' => $tr('portfolio.cases.olive.subtitle', 'Al-Mishkat, Azayateen, TOOP'),
			'desc' => $tr('portfolio.cases.olive.desc', 'Premium label design and branding for olive oil producers targeting Saudi Arabia and Gulf markets. Includes packaging compliance, Arabic typography, and luxury positioning.'),
			'tags' => ['Branding', 'Label Design', 'Gulf Market', 'Canva'],
			'color' => '#FFD700',
			'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
		],
	];

	$sectionId = isset($sectionId) && $sectionId ? $sectionId : 'case-studies';
	$headingId = isset($headingId) && $headingId ? $headingId : $sectionId . '-heading';
@endphp

<section id="{{ $sectionId }}" class="py-16 lg:py-24" @if($rtl) dir="rtl" @endif aria-labelledby="{{ $headingId }}">
	<div class="max-w-7xl mx-auto px-4 sm:px-6">

		<!-- Section Header -->
		<header class="mb-12 text-center">
			<div
				class="inline-flex items-center gap-2 mb-4 px-4 py-2 rounded-full bg-[#12121a] border border-[#FFD700]/20">
				<span class="w-2 h-2 bg-[#FFD700] rounded-full"></span>
				<span class="text-[#A0A0A0] text-sm font-mono">projects.featured</span>
			</div>
			<h2 id="{{ $headingId }}" class="section-title mb-4">
				{{ $tr('portfolio.cases.title', 'Client Success Stories') }}</h2>
			<p class="section-subtitle mx-auto">
				{{ $tr('portfolio.cases.subtitle', 'Proven results from web platforms and branding projects delivered across Tunisia and Gulf markets') }}
			</p>
		</header>

		<!-- Case Studies Grid -->
		<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
			@foreach($caseStudies as $i => $case)
				<article class="glass-card glass-card-hover p-6 group animate-fade-in-up"
					style="animation-delay: {{ $i * 0.1 }}s;">
					<div class="flex items-start gap-4 mb-4">
						<div class="w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0 transition-transform group-hover:scale-110"
							style="background: {{ $case['color'] }}20;">
							<svg class="w-7 h-7" style="color: {{ $case['color'] }};" fill="none" stroke="currentColor"
								viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="{{ $case['icon'] }}" />
							</svg>
						</div>
						<div>
							<h3 class="text-xl font-bold text-[#E8E8E8] mb-1">{{ $case['title'] }}</h3>
							<p class="text-sm font-medium" style="color: {{ $case['color'] }};">{{ $case['subtitle'] }}</p>
						</div>
					</div>

					<p class="text-[#A0A0A0] mb-4 leading-relaxed">{{ $case['desc'] }}</p>

					<!-- Tags -->
					<div class="flex flex-wrap gap-2">
						@foreach($case['tags'] as $tag)
							<span
								class="px-3 py-1 text-xs font-medium rounded-full bg-[#12121a] border border-white/10 text-[#A0A0A0]">{{ $tag }}</span>
						@endforeach
					</div>
				</article>
			@endforeach
		</div>

		<!-- CTA -->
		<div class="mt-12 text-center">
			<a href="{{ route('contact', ['locale' => app()->getLocale()]) }}"
				class="btn-primary inline-flex items-center gap-2 group">
				{{ $tr('portfolio.cases.cta', 'Discuss Your Project') }}
				<svg class="w-4 h-4 transition-transform group-hover:translate-x-1" viewBox="0 0 20 20"
					fill="currentColor">
					<path
						d="M10.293 3.293a1 1 0 011.414 0l5 5a1 1 0 010 1.414l-5 5a1 1 0 11-1.414-1.414L13.586 11H4a1 1 0 110-2h9.586l-3.293-3.293a1 1 0 010-1.414z" />
				</svg>
			</a>
		</div>
	</div>
</section>