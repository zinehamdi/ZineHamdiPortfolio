<section id="skills" class="py-24 relative overflow-hidden">
	<!-- Section Header -->
	<div class="container mx-auto px-4 text-center mb-16 relative z-10">
		<h2 class="section-title mb-4 inline-block">Technical Arsenal</h2>
		<p class="text-brand-muted max-w-2xl mx-auto">
			My floating ecosystem of tools and technologies.
		</p>
	</div>

	<!-- Floating Orbs Interface -->
	<div
		class="relative w-full h-[500px] md:h-[600px] overflow-visible perspective-1000 flex items-center justify-center">
		<!-- Spotlight / Center Core -->
		<div class="absolute w-[300px] h-[300px] bg-brand-accent/10 rounded-full blur-[80px] animate-pulse-glow"></div>

		<!-- Constellation Lines (Optional decoration) -->
		<div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(163,177,138,0.1)_0%,transparent_70%)]">
		</div>

		<!-- Orbs Container using Alpine for interactivity -->
		<div class="relative w-full max-w-2xl md:max-w-4xl h-full mx-auto" x-data="{ hovered: null }">
			@php
				$orbs = [
					// Clustered closer to center for better density
					['name' => 'Laravel', 'icon' => 'L', 'x' => 45, 'y' => 40, 'size' => 24, 'delay' => '0s'],
					['name' => 'Vue.js', 'icon' => 'V', 'x' => 65, 'y' => 30, 'size' => 18, 'delay' => '1s'],
					['name' => 'Tailwind', 'icon' => 'T', 'x' => 25, 'y' => 35, 'size' => 20, 'delay' => '2s'],
					['name' => 'Livewire', 'icon' => 'LW', 'x' => 75, 'y' => 55, 'size' => 16, 'delay' => '3s'],
					['name' => 'Alpine', 'icon' => 'A', 'x' => 15, 'y' => 50, 'size' => 16, 'delay' => '1.5s'],
					['name' => 'Flutter', 'icon' => 'F', 'x' => 35, 'y' => 65, 'size' => 22, 'delay' => '2.5s'],
					['name' => 'MySQL', 'icon' => 'DB', 'x' => 55, 'y' => 20, 'size' => 16, 'delay' => '0.5s'],
					['name' => 'Figma', 'icon' => 'Fi', 'x' => 80, 'y' => 40, 'size' => 15, 'delay' => '3.5s'],
					['name' => 'AI', 'icon' => 'AI', 'x' => 50, 'y' => 80, 'size' => 20, 'delay' => '4s'],
				];
			@endphp

			@foreach($orbs as $orb)
				<div class="absolute transform transition-all duration-500 z-10 hover:z-50"
					style="left: {{ $orb['x'] }}%; top: {{ $orb['y'] }}%; width: {{ $orb['size'] * 3.5 }}px; height: {{ $orb['size'] * 3.5 }}px; animation-delay: {{ $orb['delay'] }};">

					<!-- Floating Wrapper -->
					<div class="w-full h-full animate-float" style="animation-delay: {{ $orb['delay'] }};">
						<!-- Glass Orb -->
						<div class="w-full h-full rounded-full bg-brand-secondary/40 border border-brand-accent/40 backdrop-blur-md shadow-[0_0_15px_rgba(163,177,138,0.1)] flex items-center justify-center cursor-pointer transition-all duration-300 group hover:scale-125 hover:bg-brand-accent/20 hover:border-brand-accent hover:shadow-[0_0_30px_rgba(163,177,138,0.4)]"
							@mouseenter="hovered = '{{ $orb['name'] }}'" @mouseleave="hovered = null">

							<!-- Icon/Text -->
							<span
								class="font-bold text-sm md:text-lg text-brand-text group-hover:text-white transition-colors select-none font-mono">
								{{ $orb['icon'] }}
							</span>

							<!-- Tooltip -->
							<div
								class="absolute -bottom-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap px-3 py-1 bg-brand-secondary rounded-lg border border-brand-gold/30 text-brand-gold text-xs font-bold pointer-events-none z-50">
								{{ $orb['name'] }}
							</div>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</section>