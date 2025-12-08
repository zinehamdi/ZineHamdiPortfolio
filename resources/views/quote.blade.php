@extends('layouts.portfolio')

@section('title', 'Get a Quote')
@section('meta_description', 'Request a customized quote for your project')

@section('content')
<section class="py-16 lg:py-24" aria-labelledby="quote-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        
        <!-- Section Header -->
        <header class="mb-12 text-center">
            <div class="inline-flex items-center gap-2 mb-4 px-4 py-2 rounded-full bg-[#12121a] border border-[#00FF88]/20">
                <span class="w-2 h-2 bg-[#00FF88] rounded-full animate-pulse"></span>
                <span class="text-[#A0A0A0] text-sm font-mono">quote.request()</span>
            </div>
            <h1 id="quote-heading" class="section-title mb-4">{{ __('packages.title') ?? 'Get Your Quote' }}</h1>
            <p class="section-subtitle mx-auto">{{ __('packages.intro') ?? 'Tell us about your project and get an instant estimate' }}</p>
        </header>

        <!-- Quote Wizard -->
        <livewire:quote-wizard />

        <!-- Trust Badges -->
        <div class="mt-16 text-center">
            <p class="text-[#A0A0A0] mb-6">Trusted by businesses worldwide</p>
            <div class="flex flex-wrap justify-center gap-8">
                @php $badges = [
                    ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'label' => 'Secure'],
                    ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => '24h Response'],
                    ['icon' => 'M5 13l4 4L19 7', 'label' => 'No Commitment'],
                ]; @endphp
                @foreach($badges as $b)
                    <div class="flex items-center gap-2 text-[#A0A0A0]">
                        <div class="w-8 h-8 rounded-lg bg-[#00FF88]/10 flex items-center justify-center">
                            <svg class="w-4 h-4 text-[#00FF88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $b['icon'] }}"/>
                            </svg>
                        </div>
                        <span class="text-sm">{{ $b['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
@endsection
