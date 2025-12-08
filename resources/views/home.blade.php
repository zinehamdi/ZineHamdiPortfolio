@extends('layouts.portfolio')

@php
	$ogImagePath = file_exists(public_path('images/og/bgPortfolioImage.webp'))
		? asset('images/og/bgPortfolioImage.webp')
		: (file_exists(public_path('images/home.jpg')) ? asset('images/home.jpg') : asset('favicon.ico'));
	$metaDescription = __('home.meta_description');
	if ($metaDescription === 'home.meta_description') {
		$metaDescription = 'Senior full-stack Laravel developer delivering AI-enabled web platforms, branding, and growth for ambitious founders across Tunisia and the Gulf.';
	}
@endphp

@section('title', __('common.brand').' | Full-Stack Laravel & AI Studio')
@section('meta_description', $metaDescription)
@section('og_title', __('common.brand').' | Laravel & AI Solutions')
@section('og_description', $metaDescription)
@section('og_image', $ogImagePath)


@section('content')
	<div id="home">
		@include('sections.metallic-hero')
	</div>
	@include('sections.about')
	@include('sections.case-studies', ['sectionId' => 'case-studies', 'headingId' => 'case-studies-heading'])
	<div id="projects">
		@include('sections.metallic-projects')
	</div>
	<div id="services">
		@include('sections.premium-services')
	</div>
	@include('sections.pricing')
	@include('sections.quote')
	@include('sections.blog-preview')
	<div id="contact">
		@include('sections.contact')
	</div>
@endsection
