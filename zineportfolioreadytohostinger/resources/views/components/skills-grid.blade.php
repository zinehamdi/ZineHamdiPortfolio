@props(['skills'])
<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    @foreach($skills as $skill)
    <div class="bg-brand-grayPanel rounded p-4 text-center font-semibold">
            {{ $skill }}
        </div>
    @endforeach
</div>
