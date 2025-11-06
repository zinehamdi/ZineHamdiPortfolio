@props(['events'])
<ul class="border-l-2 border-brand pl-6">
    @foreach($events as $event)
        <li class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center">
                <span class="font-bold text-brand">{{ $event['year'] }}</span>
                <span class="ml-2 text-lg font-semibold">{{ $event['title'] }}</span>
            </div>
            <p class="ml-2 text-gray-700">{{ $event['description'] }}</p>
        </li>
    @endforeach
</ul>
