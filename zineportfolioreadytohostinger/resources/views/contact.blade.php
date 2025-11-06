@extends('layouts.app')

@section('title', __('contact.meta.title'))
@section('meta_description', __('contact.meta.description'))
@section('og_title', __('contact.meta.title'))
@section('og_description', __('contact.meta.description'))
@section('og_image', asset(__('contact.meta.og_image')))

@section('content')
  @include('sections.contact')
@endsection
