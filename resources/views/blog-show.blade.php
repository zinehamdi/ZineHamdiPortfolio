@extends('layouts.portfolio')

@section('title', $post->title . ' | ' . __('common.nav.blog'))
@section('meta_description', $post->excerpt ?? Str::limit(strip_tags($post->body), 160))

@section('content')
	<article class="py-16 lg:py-24 mlp-bg-root" aria-labelledby="post-title">
		<div class="max-w-4xl mx-auto px-4 sm:px-6">

			<!-- Back Link -->
			<div class="mb-8">
				<a href="{{ route('blog', ['locale' => app()->getLocale()]) }}"
					class="mlp-glass-subtle border border-mlp-border-subtle/70 hover:border-mlp-gold/70 px-4 py-2 text-sm font-semibold text-white rounded-mlp-md transition-all hover:shadow-mlp-laser-green inline-flex items-center gap-2">
					<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M10 19l-7-7m0 0l7-7m-7 7h18" />
					</svg>
					<span>{{ __('blog.back_to_blog') }}</span>
				</a>
			</div>

			<!-- Header -->
			<header class="mb-8">
				<div class="flex items-center gap-3 mb-4">
					<span class="bg-brand-accent/20 text-brand-accent px-3 py-1 rounded-full text-sm font-bold">
						{{ $post->category }}
					</span>
					<span class="text-white/50 text-sm">{{ $post->published_at?->format('F d, Y') }}</span>
					<span class="text-white/50 text-sm">•</span>
					<span class="text-white/50 text-sm">{{ $post->reading_time }} {{ __('blog.min_read') }}</span>
				</div>
				<h1 id="post-title" class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">
					{{ $post->title }}
				</h1>
				@if($post->excerpt)
					<p class="text-xl text-white/70">{{ $post->excerpt }}</p>
				@endif
			</header>

			<!-- Featured Image -->
			@if($post->featured_image)
				<div class="mb-10 rounded-2xl overflow-hidden border border-mlp-border-subtle/50">
					<img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-auto">
				</div>
			@endif

			<!-- Content -->
			<div class="prose prose-invert prose-lg max-w-none
					  prose-headings:text-white prose-headings:font-bold
					  prose-p:text-white/80 prose-p:leading-relaxed
					  prose-a:text-brand-accent prose-a:no-underline hover:prose-a:underline
					  prose-strong:text-white
					  prose-code:text-brand-accent prose-code:bg-white/5 prose-code:px-1 prose-code:py-0.5 prose-code:rounded
					  prose-pre:bg-[#12121a] prose-pre:border prose-pre:border-mlp-border-subtle/50
					  prose-blockquote:border-l-brand-accent prose-blockquote:text-white/70
					  prose-li:text-white/80
					  prose-img:rounded-xl">
				{!! Str::markdown($post->body) !!}
			</div>

			<!-- Footer -->
			<footer class="mt-12 pt-8 border-t border-mlp-border-subtle/50">
				<div class="flex flex-col sm:flex-row items-center justify-between gap-4">
					<a href="{{ route('blog', ['locale' => app()->getLocale()]) }}"
						class="mlp-glass-subtle border border-mlp-border-subtle/70 hover:border-mlp-gold/70 px-4 py-2 text-sm font-semibold text-white rounded-mlp-md transition-all hover:shadow-mlp-laser-green inline-flex items-center gap-2">
						<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M10 19l-7-7m0 0l7-7m-7 7h18" />
						</svg>
						{{ __('blog.more_articles') }}
					</a>

					<div class="flex items-center gap-4">
						<span class="text-white/50 text-sm">{{ __('blog.share') }}</span>
						<a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}"
							target="_blank" rel="noopener"
							class="mlp-glass-subtle border border-mlp-border-subtle/70 hover:border-mlp-gold/70 p-2 rounded-mlp-md transition-all hover:shadow-mlp-laser-green text-white/70 hover:text-brand-accent">
							<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
								<path
									d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
							</svg>
						</a>
						<a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
							target="_blank" rel="noopener"
							class="mlp-glass-subtle border border-mlp-border-subtle/70 hover:border-mlp-gold/70 p-2 rounded-mlp-md transition-all hover:shadow-mlp-laser-green text-white/70 hover:text-brand-accent">
							<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
								<path
									d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
							</svg>
						</a>
					</div>
				</div>
			</footer>

		</div>
	</article>
@endsection