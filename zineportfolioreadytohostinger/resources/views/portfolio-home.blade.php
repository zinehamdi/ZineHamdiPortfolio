@extends('layouts.portfolio')

@section('title', __('home.meta.title'))
@section('meta_description', __('home.meta.description'))

@section('content')
  <section class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-2xl shadow-soft p-6">
      <h2 class="text-sm uppercase font-bold tracking-wide2 mb-2">Services</h2>
      <p class="text-brand-ink/80">A preview grid could go here.</p>
    </div>
    <div class="bg-white rounded-2xl shadow-soft p-6">
      <h2 class="text-sm uppercase font-bold tracking-wide2 mb-2">Portfolio</h2>
      <p class="text-brand-ink/80">Recent work tiles.</p>
    </div>
    <div class="bg-white rounded-2xl shadow-soft p-6">
      <h2 class="text-sm uppercase font-bold tracking-wide2 mb-2">Contact</h2>
      <p class="text-brand-ink/80">CTA block to contact or quote.</p>
    </div>
  </section>

  @include('sections.about')
@endsection
