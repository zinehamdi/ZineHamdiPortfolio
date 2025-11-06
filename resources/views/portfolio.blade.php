@extends('layouts.app')

@section('title', __('portfolio.title').' – '.__('common.brand'))
@section('meta_description', __('nav.meta_description'))

@section('content')
  @include('sections.portfolio')
  @include('sections.testimonials')
@endsection
