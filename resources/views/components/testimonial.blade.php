@props(['author', 'role' => null, 'quote'])
<figure class="bg-white rounded-2xl p-6 border border-brand-ink/10">
  <blockquote class="text-lg text-gray-800 italic">“{{ $quote }}”</blockquote>
  <figcaption class="mt-4 flex items-center gap-3 flex-dir-rr">
    <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-brand/10 text-brand font-bold" aria-hidden="true">{{ mb_substr($author,0,1) }}</span>
    <div>
      <div class="font-semibold">{{ $author }}</div>
      @if($role)
  <div class="text-sm text-gray-700">{{ $role }}</div>
      @endif
    </div>
  </figcaption>
</figure>
