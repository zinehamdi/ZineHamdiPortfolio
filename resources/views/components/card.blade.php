@props(['title','description','icon'=>null])
<article class="bg-white rounded-lg p-6 h-full border border-brand-ink/10">
  @if($icon)
    <div class="mb-4 text-3xl">{!! $icon !!}</div>
  @endif
  <h3 class="text-xl font-bold mb-2">{{ $title }}</h3>
  <p class="text-gray-700">{{ $description }}</p>
</article>
