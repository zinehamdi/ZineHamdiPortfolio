@extends('layouts.app')

@section('title', __('packages.meta.title'))
@section('meta_description', __('packages.meta.description'))
@section('og_title', __('packages.meta.title'))
@section('og_description', __('packages.meta.description'))
@section('og_image', asset(__('packages.meta.og_image')))

@section('content')
  <x-section :title="__('packages.title')" :subtitle="__('packages.intro')">
    @php
      $models = \App\Models\Package::query()->orderByDesc('is_featured')->get() ?? collect();
      $tiers = $models->isNotEmpty() ? null : __('packages.tiers');
    @endphp
    <x-pricing-table :packages="$models" :tiers="$tiers" />
  </x-section>
@endsection
