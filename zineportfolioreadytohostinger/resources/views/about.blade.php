@extends('layouts.app')

@section('title', __('about.meta.title'))
@section('meta_description', __('about.meta.description'))
@section('og_title', __('about.meta.title'))
@section('og_description', __('about.meta.description'))
@section('og_image', asset(__('about.meta.og_image')))

@section('content')
  <x-section :title="__('about.title')" :subtitle="__('about.intro')">
    <div class="grid md:grid-cols-3 gap-8 items-start">
      <div class="md:col-span-1">
  <img src="/images/profile.jpg" alt="Zine" class="w-full rounded-2xl object-cover" loading="lazy">
      </div>
      <div class="md:col-span-2 space-y-6">
  <article class="prose max-w-none">
          <h3 class="text-xl font-semibold">{{ __('about.sections.mission.title') }}</h3>
          <p>{{ __('about.sections.mission.body') }}</p>
          <h3 class="text-xl font-semibold mt-6">{{ __('about.sections.bio.title') }}</h3>
          <p>{{ __('about.sections.bio.body') }}</p>
        </article>

        <div>
          <h3 class="text-xl font-semibold mb-3">{{ __('common.nav.services') }}</h3>
          <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
            @foreach(__('about.skills') as $skill)
              <span class="px-3 py-2 rounded-lg bg-white border border-olive-600/20 text-sm">{{ $skill }}</span>
            @endforeach
          </div>
        </div>

        <div>
          <h3 class="text-xl font-semibold mb-3">Timeline</h3>
          <ol class="space-y-2">
            @foreach(__('about.timeline') as $event)
              <li class="flex items-center gap-3">
                <span class="inline-flex w-16 shrink-0 font-semibold text-olive-700">{{ $event['year'] }}</span>
                <span>{{ $event['title'] }}</span>
              </li>
            @endforeach
          </ol>
        </div>

        <div class="grid grid-cols-2 gap-6">
          <x-metric :value="'25+'" :label="__('about.metrics.projects')" />
          <x-metric :value="'7'" :label="__('about.metrics.avg_days')" />
        </div>
      </div>
    </div>
  </x-section>

  <div class="mt-8">
    <x-section :title="__('about.sections.cta.title')" :subtitle="__('about.sections.cta.body')">
      <x-button href="{{ url('/quote') }}">{{ __('packages.cta_label') }}</x-button>
    </x-section>
  </div>
@endsection
