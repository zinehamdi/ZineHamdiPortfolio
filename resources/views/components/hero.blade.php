@props([
    'title',
    'subtitle' => null,
    'cta_label' => null,
    'cta_href' => null,
    'image' => null,
    'overlay' => true,
    'eyebrow' => null,
    'priority' => false,
    'srcset' => null,
    'sizes' => '100vw',
    // New: control the rendered height and focal point
    'heightClass' => 'h-[420px] md:h-[520px]',
    'objectPosition' => 'object-center', // e.g. object-top, object-bottom, object-left, object-right
    // New: split layout controls
    'layout' => 'full', // 'full' or 'split'
    'imageSide' => 'left', // 'left' or 'right'
    'imageFraction' => '1/3', // '1/3' or '2/3'
    'remainderBg' => 'bg-brand-accent', // Non-image pane background
    'imagePaneBg' => 'bg-brand-grayPanel', // Fallback when image absent
])

<section {{ $attributes->merge(['class' => 'relative overflow-hidden']) }}>
    @if($layout === 'split')
        <div class="relative {{ $heightClass }}">
            <div class="absolute inset-0 grid grid-cols-1 md:grid-cols-3">
                @php
                    $imgCols = $imageFraction === '2/3' ? 'col-span-2' : 'col-span-1';
                    $txtCols = $imageFraction === '2/3' ? 'col-span-1' : 'col-span-2';
                @endphp
                @if($imageSide === 'left')
                    <div class="block md:block {{ $imgCols }} relative {{ $image ? '' : $imagePaneBg }}">
                        @if($image)
                            <img src="{{ $image }}" @if($srcset) srcset="{{ $srcset }}" @endif sizes="(min-width: 768px) 66vw, 100vw" alt="" class="absolute inset-0 w-full h-full object-cover {{ $objectPosition }}" @if($priority) loading="eager" fetchpriority="high" @else loading="lazy" fetchpriority="low" @endif width="1920" height="520">
                        @endif
                        @if($image && $overlay)
                            <div class="absolute inset-0 bg-black/30"></div>
                        @endif
                    </div>
                    <div class="{{ $txtCols }} {{ $remainderBg }} text-white flex items-center justify-center px-6">
                        <div class="text-center max-w-2xl">
                            @if($eyebrow)
                                <p class="mb-2 text-sm tracking-wide uppercase text-gold">{{ $eyebrow }}</p>
                            @endif
                            <h1 class="text-3xl md:text-5xl font-extrabold mb-3">{{ $title }}</h1>
                            @if($subtitle)
                                <p class="max-w-2xl text-base md:text-lg mb-6 text-sand">{{ $subtitle }}</p>
                            @endif
                            @if($cta_label && $cta_href)
                                <x-button href="{{ $cta_href }}">{{ $cta_label }}</x-button>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="{{ $txtCols }} {{ $remainderBg }} text-white flex items-center justify-center px-6">
                        <div class="text-center max-w-2xl">
                            @if($eyebrow)
                                <p class="mb-2 text-sm tracking-wide uppercase text-gold">{{ $eyebrow }}</p>
                            @endif
                            <h1 class="text-3xl md:text-5xl font-extrabold mb-3">{{ $title }}</h1>
                            @if($subtitle)
                                <p class="max-w-2xl text-base md:text-lg mb-6 text-sand">{{ $subtitle }}</p>
                            @endif
                            @if($cta_label && $cta_href)
                                <x-button href="{{ $cta_href }}">{{ $cta_label }}</x-button>
                            @endif
                        </div>
                    </div>
                    <div class="block md:block {{ $imgCols }} relative {{ $image ? '' : $imagePaneBg }}">
                        @if($image)
                            <img src="{{ $image }}" @if($srcset) srcset="{{ $srcset }}" @endif sizes="(min-width: 768px) 66vw, 100vw" alt="" class="absolute inset-0 w-full h-full object-cover {{ $objectPosition }}" @if($priority) loading="eager" fetchpriority="high" @else loading="lazy" fetchpriority="low" @endif width="1920" height="520">
                        @endif
                        @if($image && $overlay)
                            <div class="absolute inset-0 bg-black/30"></div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    @else
        @if($image)
        <img
            src="{{ $image }}"
            @if($srcset) srcset="{{ $srcset }}" @endif
            sizes="{{ $sizes }}"
            alt=""
            class="w-full {{ $heightClass }} object-cover {{ $objectPosition }}"
            @if($priority) loading="eager" fetchpriority="high" @else loading="lazy" fetchpriority="low" @endif
            width="1920" height="520"
        >
        @if($overlay)
            <div class="absolute inset-0 bg-black/40"></div>
        @endif
        @endif
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-4">
        @if($eyebrow)
            <p class="mb-2 text-sm tracking-wide uppercase text-gold">{{ $eyebrow }}</p>
        @endif
        <h1 class="text-3xl md:text-5xl font-extrabold mb-3">{{ $title }}</h1>
        @if($subtitle)
            <p class="max-w-2xl text-base md:text-lg mb-6 text-sand">{{ $subtitle }}</p>
        @endif
        @if($cta_label && $cta_href)
            <x-button href="{{ $cta_href }}">{{ $cta_label }}</x-button>
        @endif
        </div>
    @endif
</section>
