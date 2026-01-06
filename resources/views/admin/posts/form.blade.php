@extends('layouts.admin')
@section('content')
	<div class="max-w-4xl mx-auto py-8 px-4">
		{{-- Back Navigation --}}
		<div class="mb-6">
			<a href="{{ route('admin.posts') }}"
				class="text-[#A0A0A0] hover:text-[#00FF88] inline-flex items-center gap-2 transition-colors">
				<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
				</svg>
				<span class="font-medium">Back to Posts</span>
			</a>
		</div>

		{{-- Main Form Card --}}
		<div class="bg-[#12121a] rounded-2xl border border-white/10 shadow-2xl shadow-black/50 p-8">
			<h1 class="text-2xl font-bold text-[#E8E8E8] mb-6">{{ $post ? 'Edit Post' : 'Create New Post' }}</h1>

			@if($errors->any())
				<div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 text-red-400 rounded-xl">
					<ul class="list-disc list-inside space-y-1">
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			<form action="{{ $post ? route('admin.posts.update', $post->id) : route('admin.posts.store') }}" method="POST"
				enctype="multipart/form-data" class="space-y-6">
				@csrf
				@if($post)
					@method('PUT')
				@endif

				{{-- Title Field --}}
				<div>
					<label for="title" class="block text-sm font-medium text-[#A0A0A0] mb-2">Title *</label>
					<input type="text" name="title" id="title" required value="{{ old('title', $post?->title) }}"
						class="w-full bg-[#0a0a0f] border border-white/10 rounded-xl px-4 py-3 text-[#E8E8E8] placeholder-[#555] focus:outline-none focus:ring-2 focus:ring-[#00FF88]/50 focus:border-[#00FF88]/50 transition-all"
						placeholder="Enter post title">
				</div>

				{{-- Category, Status, Locale Grid --}}
				<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
					<div>
						<label for="category" class="block text-sm font-medium text-[#A0A0A0] mb-2">Category</label>
						<input type="text" name="category" id="category"
							value="{{ old('category', $post?->category ?? 'General') }}"
							class="w-full bg-[#0a0a0f] border border-white/10 rounded-xl px-4 py-3 text-[#E8E8E8] placeholder-[#555] focus:outline-none focus:ring-2 focus:ring-[#00FF88]/50 focus:border-[#00FF88]/50 transition-all"
							placeholder="e.g. Development">
					</div>
					<div>
						<label for="status" class="block text-sm font-medium text-[#A0A0A0] mb-2">Status *</label>
						<select name="status" id="status" required
							class="w-full bg-[#0a0a0f] border border-white/10 rounded-xl px-4 py-3 text-[#E8E8E8] focus:outline-none focus:ring-2 focus:ring-[#00FF88]/50 focus:border-[#00FF88]/50 transition-all">
							<option value="draft" @selected(old('status', $post?->status) === 'draft')>Draft</option>
							<option value="published" @selected(old('status', $post?->status) === 'published')>Published
							</option>
						</select>
					</div>
					<div>
						<label for="locale" class="block text-sm font-medium text-[#A0A0A0] mb-2">Language *</label>
						<select name="locale" id="locale" required
							class="w-full bg-[#0a0a0f] border border-white/10 rounded-xl px-4 py-3 text-[#E8E8E8] focus:outline-none focus:ring-2 focus:ring-[#00FF88]/50 focus:border-[#00FF88]/50 transition-all">
							<option value="en" @selected(old('locale', $post?->locale) === 'en')>English</option>
							<option value="fr" @selected(old('locale', $post?->locale) === 'fr')>French</option>
							<option value="ar" @selected(old('locale', $post?->locale) === 'ar')>Arabic</option>
						</select>
					</div>
				</div>

				{{-- Excerpt Field --}}
				<div>
					<label for="excerpt" class="block text-sm font-medium text-[#A0A0A0] mb-2">Excerpt</label>
					<textarea name="excerpt" id="excerpt" rows="2"
						class="w-full bg-[#0a0a0f] border border-white/10 rounded-xl px-4 py-3 text-[#E8E8E8] placeholder-[#555] focus:outline-none focus:ring-2 focus:ring-[#00FF88]/50 focus:border-[#00FF88]/50 transition-all resize-none"
						placeholder="Brief summary of the post (optional)">{{ old('excerpt', $post?->excerpt) }}</textarea>
				</div>

				{{-- Content Field --}}
				<div>
					<label for="body" class="block text-sm font-medium text-[#A0A0A0] mb-2">Content * <span
							class="text-[#555] font-normal">(Markdown supported)</span></label>
					<textarea name="body" id="body" rows="15" required
						class="w-full bg-[#0a0a0f] border border-white/10 rounded-xl px-4 py-3 font-mono text-sm text-[#E8E8E8] placeholder-[#555] focus:outline-none focus:ring-2 focus:ring-[#00FF88]/50 focus:border-[#00FF88]/50 transition-all"
						placeholder="Write your post content here...">{{ old('body', $post?->body) }}</textarea>
				</div>

				{{-- Featured Image --}}
				<div>
					<label for="featured_image" class="block text-sm font-medium text-[#A0A0A0] mb-2">Featured Image</label>
					@if($post?->featured_image)
						<div class="mb-3 p-4 bg-[#0a0a0f] rounded-xl border border-white/10">
							<img src="{{ asset($post->featured_image) }}" alt="Current image"
								class="h-32 rounded-lg object-cover">
							<p class="text-sm text-[#555] mt-2">Current image</p>
						</div>
					@endif
					<input type="file" name="featured_image" id="featured_image" accept="image/*"
						class="w-full bg-[#0a0a0f] border border-white/10 rounded-xl px-4 py-3 text-[#A0A0A0] file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#00FF88]/10 file:text-[#00FF88] hover:file:bg-[#00FF88]/20 focus:outline-none focus:ring-2 focus:ring-[#00FF88]/50 transition-all cursor-pointer">
				</div>

				{{-- Action Buttons --}}
				<div class="flex items-center gap-4 pt-6 border-t border-mlp-border-subtle/50">
					<button type="submit" class="mlp-btn-laser px-8 py-3 text-sm font-bold">
						{{ $post ? 'Update Post' : 'Create Post' }}
					</button>
					<a href="{{ route('admin.posts') }}"
						class="mlp-glass-subtle border border-mlp-border-subtle/70 hover:border-mlp-gold/70 px-8 py-3 text-sm font-semibold text-white rounded-mlp-md transition-all hover:shadow-mlp-laser-green">
						Cancel
					</a>
				</div>
			</form>
		</div>
	</div>
@endsection