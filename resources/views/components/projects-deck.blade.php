<section id="projects" class="py-12 relative bg-transparent border-t border-white/10" x-data>
	<div class="container mx-auto px-4 mb-12 flex justify-between items-end">
		<div>
			<h2 class="section-title text-white">Selected Works</h2>
			<p class="text-gray-400 mt-2">Real-world projects delivered for clients in Tunisia and abroad</p>
		</div>
		<div class="hidden sm:flex gap-2">
			<button
				class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center text-gray-400 hover:text-brand-accent hover:border-brand-accent/50 transition-all cursor-pointer"
				@click="document.getElementById('project-scroll').scrollBy({left: -400, behavior: 'smooth'})">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
			<button
				class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center text-gray-400 hover:text-brand-accent hover:border-brand-accent/50 transition-all cursor-pointer"
				@click="document.getElementById('project-scroll').scrollBy({left: 400, behavior: 'smooth'})">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
		</div>
	</div>

	<!-- Horizontal Scroll Container -->
	<div id="project-scroll"
		class="flex gap-8 overflow-x-auto pb-12 px-4 sm:px-12 snap-x snap-mandatory scrollbar-hide perspective-1000">

		<!-- Project Cards -->
		@php
			$projects = [
				['title' => 'Samouha Couture', 'cat' => 'E-Commerce', 'img' => 'samouha/samouhachhome.jpeg'],
				['title' => 'ABIOOC', 'cat' => 'Platform', 'img' => 'abiooc/abioocschome.webp'],
				['title' => 'KairouanHub', 'cat' => 'Community', 'img' => 'kairouanhub/kairouanhubschome.webp'],
				['title' => 'Al Mishkat', 'cat' => 'Design', 'img' => 'almishkat/al_mishkatsc1.webp'],
				['title' => 'SETPA', 'cat' => 'Branding', 'img' => 'setpa/logosetpa.png'],
			];
		@endphp

		@foreach($projects as $p)
			<div
				class="group relative flex-none w-[300px] sm:w-[450px] aspect-[4/3] snap-center transform-style-3d transition-all duration-500 hover:scale-[1.02]">
				<!-- Card Body -->
				<div
					class="absolute inset-0 bg-white/5 backdrop-blur-sm rounded-2xl overflow-hidden border border-brand-accent/20 hover:border-brand-accent/50 hover:shadow-[0_0_30px_rgba(0,255,136,0.15)] shadow-2xl transition-all duration-300">
					<!-- Image -->
					<div class="h-full w-full overflow-hidden">
						<div class="w-full h-full bg-cover bg-center transition-transform duration-700 group-hover:scale-110"
							style="background-image: url('{{ asset('images/' . ltrim($p['img'], '/')) }}');">
							<div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
						</div>
					</div>

					<!-- Overlay Info -->
					<div
						class="absolute bottom-0 left-0 w-full p-6 bg-gradient-to-t from-black via-black/80 to-transparent translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
						<span
							class="text-brand-accent text-xs font-bold tracking-widest uppercase mb-2 block">{{ $p['cat'] }}</span>
						<h3 class="text-white text-2xl font-bold mb-2">{{ $p['title'] }}</h3>
						<div
							class="h-0 group-hover:h-auto overflow-hidden opacity-0 group-hover:opacity-100 transition-all duration-300 delay-100">
							<a href="#contact" class="text-sm text-brand-muted hover:text-brand-accent transition-colors inline-flex items-center gap-1">
                                Discuss Project <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
						</div>
					</div>
				</div>
			</div>
		@endforeach

		<!-- End Spacer -->
		<div class="w-12 flex-none"></div>
	</div>
</section>

<style>
	.scrollbar-hide::-webkit-scrollbar {
		display: none;
	}

	.scrollbar-hide {
		-ms-overflow-style: none;
		scrollbar-width: none;
	}
</style>