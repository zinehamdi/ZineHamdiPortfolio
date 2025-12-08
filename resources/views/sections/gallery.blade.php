@php
	$rtl = app()->getLocale() === 'ar';
	$tr = function (string $key, string $def) {
		$v = __($key);
		return $v === $key ? $def : $v;
	};

	// Helper to scan folder for images
	$scanImages = function ($folder) {
		$path = public_path('images/' . $folder);
		$images = [];
		if (is_dir($path)) {
			foreach (scandir($path) as $f) {
				if ($f === '.' || $f === '..' || str_starts_with($f, '.'))
					continue;
				$ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
				if (!in_array($ext, ['png', 'jpg', 'jpeg', 'webp', 'gif']))
					continue;

				$title = pathinfo($f, PATHINFO_FILENAME);
				$title = preg_replace('/^Screenshot \d{4}-\d{2}-\d{2} at [\d.]+\s*(AM|PM)?$/i', 'Project', $title);
				$title = preg_replace('/[-_]/', ' ', $title);
				$title = ucwords(trim($title));

				$images[] = [
					'file' => $f,
					'path' => asset('images/' . $folder . '/' . $f),
					'title' => $title,
				];
			}
		}
		return $images;
	};

	// Define albums with their folders
	$albums = [
		[
			'id' => 'samouha',
			'title' => $tr('portfolio.albums.samouha.title', 'Samouha Couture'),
			'subtitle' => $tr('portfolio.albums.samouha.subtitle', 'Fashion commerce experience'),
			'folder' => 'samouha',
			'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4',
			'color' => '#00FF88',
			'gradient' => 'from-emerald-500/20 to-cyan-500/20',
		],
		[
			'id' => 'abiooc',
			'title' => $tr('portfolio.albums.abiooc.title', 'ABIOOC Platform'),
			'subtitle' => $tr('portfolio.albums.abiooc.subtitle', 'B2B logistics & marketplace hub'),
			'folder' => 'abiooc',
			'icon' => 'M14 3l7 7-7 7M3 10h12',
			'color' => '#7B61FF',
			'gradient' => 'from-indigo-500/20 to-purple-500/20',
		],
		[
			'id' => 'kairouanhub',
			'title' => $tr('portfolio.albums.kairouanhub.title', 'KairouanHub'),
			'subtitle' => $tr('portfolio.albums.kairouanhub.subtitle', 'Community ecosystem visuals'),
			'folder' => 'kairouanhub',
			'icon' => 'M12 6v12m6-6H6',
			'color' => '#00C6FF',
			'gradient' => 'from-sky-500/20 to-cyan-500/20',
		],
		[
			'id' => 'almishkat',
			'title' => $tr('portfolio.albums.almishkat.title', 'Al Mishkat'),
			'subtitle' => $tr('portfolio.albums.almishkat.subtitle', 'Branding & product imagery'),
			'folder' => 'almishkat',
			'icon' => 'M12 3l8 4v6c0 5-3.5 9.5-8 10-4.5-.5-8-5-8-10V7l8-4z',
			'color' => '#FF8A65',
			'gradient' => 'from-orange-500/20 to-rose-500/20',
		],
		[
			'id' => 'setpa',
			'title' => $tr('portfolio.albums.setpa.title', 'SETPA Branding'),
			'subtitle' => $tr('portfolio.albums.setpa.subtitle', 'Identity, packaging & assets'),
			'folder' => 'setpa',
			'icon' => 'M4 6h16M4 12h16M4 18h16',
			'color' => '#FFC300',
			'gradient' => 'from-amber-400/20 to-lime-400/20',
		],
		[
			'id' => 'design',
			'title' => $tr('portfolio.albums.design.title', 'Design Lab'),
			'subtitle' => $tr('portfolio.albums.design.subtitle', 'Packaging, mockups & creative assets'),
			'folder' => 'design',
			'icon' => 'M12 6v12m6-6H6',
			'color' => '#FF6FB7',
			'gradient' => 'from-rose-500/20 to-fuchsia-500/20',
		],
		[
			'id' => 'personal',
			'title' => $tr('portfolio.albums.personal.title', 'About Me'),
			'subtitle' => $tr('portfolio.albums.personal.subtitle', 'Personal Photos'),
			'folder' => 'portfoliopicture',
			'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
			'color' => '#00FF88',
			'gradient' => 'from-emerald-500/20 to-teal-500/20',
		],
	];

	// Load images for each album
	foreach ($albums as &$album) {
		$album['images'] = $scanImages($album['folder']);
	}
	unset($album);
@endphp

<section id="gallery" class="py-20 lg:py-32" @if($rtl) dir="rtl" @endif aria-labelledby="gallery-heading">
	<div class="max-w-7xl mx-auto px-4 sm:px-6">

		<!-- Section Header -->
		<header class="mb-16 text-center">
			<div
				class="inline-flex items-center gap-2 mb-4 px-4 py-2 rounded-full bg-[#12121a] border border-[#7B61FF]/20">
				<span class="w-2 h-2 bg-[#7B61FF] rounded-full animate-pulse"></span>
				<span class="text-[#A0A0A0] text-sm font-mono">gallery.albums</span>
			</div>
			<h2 id="gallery-heading" class="text-4xl md:text-5xl font-black text-white mb-4">
				{{ $tr('portfolio.gallery.title', 'Work Gallery') }}
			</h2>
			<p class="text-[#A0A0A0] text-lg max-w-2xl mx-auto">
				{{ $tr('portfolio.gallery.subtitle', 'Explore my work through curated collections') }}
			</p>
		</header>

		<!-- Album Cards Grid -->
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
			@foreach($albums as $album)
				@if(count($album['images']) > 0)
					<div x-data="{ 
												currentSlide: 0,
												images: {{ Js::from($album['images']) }},
												lightbox: false,
												autoplay: null,
												init() {
												  this.autoplay = setInterval(() => this.next(), 4000);
												},
												next() {
												  this.currentSlide = (this.currentSlide + 1) % this.images.length;
												},
												prev() {
												  this.currentSlide = (this.currentSlide - 1 + this.images.length) % this.images.length;
												},
												openLightbox() {
												  this.lightbox = true;
												  clearInterval(this.autoplay);
												  document.body.classList.add('overflow-hidden');
												},
												closeLightbox() {
												  this.lightbox = false;
												  this.autoplay = setInterval(() => this.next(), 4000);
												  document.body.classList.remove('overflow-hidden');
												}
											  }" @keydown.escape.window="closeLightbox()" class="group relative">
						<!-- Album Card -->
						<div
							class="relative rounded-3xl overflow-hidden bg-gradient-to-br {{ $album['gradient'] }} p-1 hover:scale-[1.02] transition-transform duration-500 shadow-[0_0_30px_rgba(0,255,136,0.3)] hover:shadow-[0_0_50px_rgba(0,255,136,0.6)] border border-[#00FF88]/30">
							<div class="bg-[#0a0a0f] rounded-[22px] overflow-hidden">

								<!-- Carousel Container -->
								<div class="relative aspect-[16/10] overflow-hidden cursor-pointer" @click="openLightbox()">
									<!-- Slides -->
									@foreach($album['images'] as $i => $img)
										<div class="absolute inset-0 transition-opacity duration-500 {{ $i === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}"
											:class="currentSlide === {{ $i }} ? 'opacity-100 z-10' : 'opacity-0 z-0'">
											<img src="{{ $img['path'] }}" alt="{{ $img['title'] }}"
												class="w-full h-full object-cover" loading="{{ $i === 0 ? 'eager' : 'lazy' }}">
										</div>
									@endforeach

									<!-- Gradient Overlay -->
									<div
										class="absolute inset-0 bg-gradient-to-t from-[#0a0a0f] via-transparent to-transparent">
									</div>

									<!-- Navigation Arrows -->
									<button @click.stop="prev()"
										class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/50 backdrop-blur-sm flex items-center justify-center text-white opacity-70 hover:opacity-100 transition-opacity hover:bg-black/70 z-30">
										<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
												d="M15 19l-7-7 7-7" />
										</svg>
									</button>
									<button @click.stop="next()"
										class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/50 backdrop-blur-sm flex items-center justify-center text-white opacity-70 hover:opacity-100 transition-opacity hover:bg-black/70 z-30">
										<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
												d="M9 5l7 7-7 7" />
										</svg>
									</button>

									<!-- Slide Indicators -->
									<div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-30">
										@foreach($album['images'] as $i => $img)
											<button @click.stop="currentSlide = {{ $i }}"
												:class="currentSlide === {{ $i }} ? 'w-6 bg-white' : 'w-2 bg-white/40'"
												class="h-2 rounded-full transition-all duration-300"></button>
										@endforeach
									</div>

									<!-- View All Badge -->
									<div
										class="absolute top-4 right-4 px-3 py-1.5 rounded-full bg-black/50 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity z-30">
										<span class="text-white text-xs font-medium">{{ count($album['images']) }} photos</span>
									</div>
								</div>

								<!-- Album Info -->
								<div class="p-6">
									<div class="flex items-start gap-4">
										<div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
											style="background: {{ $album['color'] }}20;">
											<svg class="w-6 h-6" style="color: {{ $album['color'] }};" fill="none"
												stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													d="{{ $album['icon'] }}" />
											</svg>
										</div>
										<div>
											<h3 class="text-xl font-bold text-white mb-1">{{ $album['title'] }}</h3>
											<p class="text-[#A0A0A0] text-sm">{{ $album['subtitle'] }}</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Lightbox Modal -->
						<div x-show="lightbox" x-cloak x-transition:enter="transition ease-out duration-300"
							x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
							class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/95 backdrop-blur-xl"
							@click.self="closeLightbox()">
							<!-- Close -->
							<button @click="closeLightbox()"
								class="absolute top-6 right-6 w-12 h-12 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 z-10">
								<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M6 18L18 6M6 6l12 12" />
								</svg>
							</button>

							<!-- Nav -->
							<button @click="prev()"
								class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 w-14 h-14 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 z-50">
								<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
								</svg>
							</button>
							<button @click="next()"
								class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 w-14 h-14 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 z-50">
								<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
								</svg>
							</button>

							<!-- Image -->
							<div class="max-w-6xl max-h-[85vh] w-full">
								<img :src="images[currentSlide]?.path" :alt="images[currentSlide]?.title"
									class="w-full h-full object-contain rounded-lg">
								<div class="text-center mt-4">
									<p class="text-white font-medium text-lg" x-text="images[currentSlide]?.title"></p>
									<p class="text-[#A0A0A0] text-sm mt-1"><span x-text="currentSlide + 1"></span> / <span
											x-text="images.length"></span></p>
								</div>
							</div>
						</div>
					</div>
				@endif
			@endforeach
		</div>

		<!-- Empty State -->
		@if(collect($albums)->sum(fn($a) => count($a['images'])) === 0)
			<div class="text-center py-16">
				<div class="w-20 h-20 mx-auto mb-6 rounded-full bg-[#12121a] flex items-center justify-center">
					<svg class="w-10 h-10 text-[#A0A0A0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
					</svg>
				</div>
				<p class="text-[#A0A0A0]">{{ $tr('portfolio.gallery.empty', 'Gallery coming soon...') }}</p>
			</div>
		@endif
	</div>
</section>