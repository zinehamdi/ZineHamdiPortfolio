@extends('layouts.admin')
@section('content')
	<div class="max-w-7xl mx-auto py-8 px-4">
		<div class="flex justify-between items-center mb-6">
			<h1 class="text-2xl font-bold text-mlp-text-main">Blog Posts</h1>
			<a href="{{ route('admin.posts.create') }}"
				class="mlp-btn-laser inline-flex items-center gap-2 px-5 py-2.5 text-sm font-bold">
				<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
				</svg>
				New Post
			</a>
		</div>

		@if(session('status'))
			<div class="mb-4 p-4 bg-[#00FF88]/10 border border-[#00FF88]/30 text-[#00FF88] rounded-xl">
				{{ session('status') }}
			</div>
		@endif

		<div class="overflow-x-auto bg-[#12121a] rounded-2xl border border-white/10 shadow-2xl shadow-black/50">
			<table class="min-w-full">
				<thead>
					<tr class="text-left bg-white/5 border-b border-white/10">
						<th class="p-4 font-semibold text-[#A0A0A0]">Title</th>
						<th class="p-4 font-semibold text-[#A0A0A0]">Category</th>
						<th class="p-4 font-semibold text-[#A0A0A0]">Status</th>
						<th class="p-4 font-semibold text-[#A0A0A0]">Locale</th>
						<th class="p-4 font-semibold text-[#A0A0A0]">Created</th>
						<th class="p-4 font-semibold text-[#A0A0A0] text-right">Actions</th>
					</tr>
				</thead>
				<tbody>
					@forelse($posts as $post)
						<tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
							<td class="p-4">
								<div class="font-medium text-[#E8E8E8]">{{ Str::limit($post->title, 50) }}</div>
								<div class="text-sm text-[#555] font-mono">/{{ $post->locale }}/blog/{{ $post->slug }}</div>
							</td>
							<td class="p-4 text-[#A0A0A0]">{{ $post->category }}</td>
							<td class="p-4">
								@if($post->status === 'published')
									<span
										class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-[#00FF88]/20 text-[#00FF88]">
										Published
									</span>
								@else
									<span
										class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-[#FFD700]/20 text-[#FFD700]">
										Draft
									</span>
								@endif
							</td>
							<td class="p-4 text-[#A0A0A0] uppercase font-mono">{{ $post->locale }}</td>
							<td class="p-4 text-[#A0A0A0]">{{ $post->created_at->format('M d, Y') }}</td>
							<td class="p-4 text-right">
								<div class="flex items-center justify-end gap-3">
									<a href="{{ route('blog.show', ['locale' => $post->locale, 'slug' => $post->slug]) }}"
										target="_blank" class="text-[#555] hover:text-[#00BFFF] transition-colors" title="View">
										<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
												d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
												d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
										</svg>
									</a>
									<a href="{{ route('admin.posts.edit', $post->id) }}"
										class="text-[#555] hover:text-[#00FF88] transition-colors" title="Edit">
										<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
												d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
										</svg>
									</a>
									<form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline"
										onsubmit="return confirm('Delete this post?')">
										@csrf
										@method('DELETE')
										<button type="submit" class="text-[#555] hover:text-red-400 transition-colors"
											title="Delete">
											<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
											</svg>
										</button>
									</form>
								</div>
							</td>
						</tr>
					@empty
						<tr>
							<td class="p-8 text-center text-[#555]" colspan="6">
								No posts yet. <a href="{{ route('admin.posts.create') }}"
									class="text-[#00FF88] hover:underline">Create your first post</a>
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>

		<div class="mt-6">{{ $posts->links() }}</div>
	</div>
@endsection