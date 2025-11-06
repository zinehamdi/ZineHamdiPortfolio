@extends('layouts.app')

@section('title', 'Quote')

@section('content')
  <x-section title="{{ __('packages.title') }}" subtitle="{{ __('packages.intro') }}">
    <livewire:quote-wizard />
  </x-section>
@endsection
