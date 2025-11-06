@props(['icon', 'title', 'description'])
<div class="bg-white rounded-lg p-6 flex flex-col items-center text-center border border-brand-ink/10">
    <div class="mb-4">
        <span class="text-4xl">{!! $icon !!}</span>
    </div>
    <h3 class="text-xl font-bold mb-2">{{ $title }}</h3>
    <p class="text-gray-700">{{ $description }}</p>
</div>
