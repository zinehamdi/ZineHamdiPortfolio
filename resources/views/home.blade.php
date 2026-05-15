@extends('layouts.portfolio')

@php
	// Use ZINDEV logo as primary OG image for social media
	$ogImagePath = asset('images/zindev/zindevlogo3d.png');
	
	// Fallback to other images if logo doesn't exist
	if (!file_exists(public_path('images/zindev/zindevlogo3d.png'))) {
		$ogImagePath = file_exists(public_path('images/og/bgPortfolioImage.webp'))
			? asset('images/og/bgPortfolioImage.webp')
			: (file_exists(public_path('images/home.jpg')) ? asset('images/home.jpg') : asset('favicon.ico'));
	}
	
	$metaDescription = __('home.meta_description');
	if ($metaDescription === 'home.meta_description') {
		$metaDescription = 'Senior full-stack Laravel developer delivering AI-enabled web platforms, branding, and growth for ambitious founders across Tunisia and the Gulf.';
	}
@endphp

@section('title', __('common.brand').' | '.__('home.page_title'))
@section('meta_description', $metaDescription)
@section('og_title', __('common.brand').' | '.__('home.og_title'))
@section('og_description', $metaDescription)
@section('og_image', $ogImagePath)


@section('content')
	<div id="home">
		@include('sections.metallic-hero')
	</div>
	@include('sections.about')
	<div id="services">
		@include('sections.premium-services')
	</div>
	<div id="projects">
		@include('sections.metallic-projects')
	</div>
	@include('sections.pricing')
	@include('sections.quote')
	@include('sections.blog-preview')
	<div id="contact">
		@include('sections.contact')
	</div>
@endsection
