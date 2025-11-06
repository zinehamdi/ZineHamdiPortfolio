@extends('layouts.portfolio')

@section('title', __('home.meta.title'))
@section('meta_description', __('home.meta.description'))
@section('og_title', __('home.meta.title'))
@section('og_description', __('home.meta.description'))
@section('og_image', asset('images/og/home.jpg'))

@section('content')
  @include('sections.hero')
  @include('sections.about')
  @include('sections.resume')
  @include('sections.portfolio')
  @include('sections.testimonials')
  @include('sections.contact')
@endsection

