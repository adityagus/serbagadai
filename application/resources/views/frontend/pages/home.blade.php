@extends('frontend.layouts.template')

@section('pageTitle','Beranda')

@push('customCss')
	<style>
		.carousel-control-next, .carousel-control-prev {
			width: 10%
		}
		/* Brand color carousel indicator */
		.carousel-indicators [data-bs-target] {
			background-color: rgba(255,255,255,0.5);
			border-radius: 50%;
			width: 10px;
			height: 10px;
		}
		.carousel-indicators [data-bs-target].active {
			background-color: var(--gold-primary, #F5A623);
		}
		.btn-circle {
			width: 40px;
			height: 40px;
			padding: 12px 0px;
			border-radius: 35px;
			text-align: center;
			font-size: 12px;
			line-height: 1.42857;
			background-color: rgba(255,255,255,0.15);
			border: 1px solid rgba(255,255,255,0.3);
			backdrop-filter: blur(4px);
		}
		/* Hero button gold style for contrast on red */
		#hero .btn-primary-dark {
			background-color: var(--gold-primary, #F5A623) !important;
			color: #1a0a00 !important;
			border-color: var(--gold-primary, #F5A623) !important;
			box-shadow: 0 4px 20px rgba(245, 166, 35, 0.5);
		}
		#hero .btn-primary-dark:hover {
			background-color: var(--gold-dark, #D4880A) !important;
			color: #fff !important;
			border-color: var(--gold-dark, #D4880A) !important;
		}
	</style>
@endpush

@section('content')

	<main id="main">
		<!-- ======= Hero Section ======= -->
		<section id="hero" style="background-image: url('{{url('storage/'.@$page->hero_background)}}')">
			<div class="row g-0">
				<div class="col-lg-6 container">
					<p class="heading-48 weight-bold mb-2">{{ @$page->hero_header }}</p>
					<p class="body-18 grayscale-900 mb-5">{{ @$page->hero_sub_header }}</p>
					<a target="_blank" href="{{ @$page->hero_action }}" class="btn btn-primary-dark mb-5">
						Ajukan Sekarang
						<i class="bi bi-arrow-right push-right ms-2" style="border-width: 2px;"></i>
					</a>
				</div>
				<div class="col-lg-6 d-none d-lg-flex">
					<div id="horizontalScroll" class="scroll">
						@foreach(@$page->hero_sliders as $slider)
						<div class="card" style="background-image: url('{{ url('storage/'.$slider->image) }}'); background-size: cover; background-repeat: no-repeat;"></div>
						@endforeach
					</div>
					<button class="carousel-control-prev" type="button" id="slideBack" style="left: 50%;">
						<div class="btn-circle">
							<i class="bi bi-chevron-left"></i>
						</div>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" id="slideNext">
						<div class="btn-circle">
							<i class="bi bi-chevron-right"></i>
						</div>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
			</div>
		</section>
		<!-- End Hero -->

		<!-- ======= About Section ======= -->
		<section>
			<div class="row g-0 about-us-container" data-aos="fade-up">
				<div class="col-lg-6 d-none d-lg-flex">
					<img src="{{ url('storage/'.@$page->about_image) }}" class="object-fit-cover img-fluid" width="100%" alt="image about us">
				</div>
				<div class="col-lg-6 bg-grayscale-50 about-us">
					<p class="subheading-24 weight-bold mb-4">{{ @$page->about_title }}</p>
					<p class="body-16 grayscale-800 mb-5">{{ @$page->about_content }}</p>
					<a role="button" class="btn btn-outline-secondary" href="{{ route('about') }}">
						Selengkapnya
						<i class="bi bi-arrow-right push-right ms-2"></i>
					</a>
				</div>
			</div>
		</section>
		<!-- ======= End About Section ======= -->

		<!-- ======= Product & Service Section ======= -->
		<section id="about" class="section about">
			<div class="container" data-aos="fade-up">

				<div class="section-title mb-5">
					<p class="heading-36 weight-bold text-black mb-4">{{ @$page->product_title }}</p>
					<p class="body-18 grayscale-800">{{ @$page->product_sub_title }}</p>
				</div>

				<div class="row content gx-4 gy-4">
					@foreach($products as $product)
					<div class="col-lg-4 col-md-6 col-sm-12 col-12 d-flex">
						<div class="card-item flex-fill" data-bs-title="{{ $product->title }}" data-bs-icon="{{ url('storage/'.$product->icon) }}">
							<img class="col-lg-4 col-md-6 col-sm-6 col-6" src="{{ url('storage/'.$product->icon) }}" />
							<p class="subtitle-20 weight-bold mb-2">{{ $product->title }}</p>
							<p class="body-16 grayscale-700 mb-0">{{ $product->short_description }}</p>
							<div class="overlay border-radius-24 bg-primary-400">
								<div class="d-flex align-items-center justify-content-center" style="height: 100%;">
									<a role="button" class="btn btn-outline-secondary-small" href="{{ route('product.detail',['slug'=>$product->slug]) }}">
										Lihat Selengkapnya
										<i class="bi bi-arrow-right push-right ms-2"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</section>
		<!-- End Product & Service Section -->

		<!-- Why Section -->
		<section id="about" class="section about">
			<div class="container" data-aos="fade-up">
				<div class="mb-5">
					<p class="heading-36 weight-bold text-black">Mengapa harus Gadai Mulia?</p>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div id="carouselExampleCaptions1" class="carousel slide" data-bs-ride="carousel">
							<div class="carousel-indicators">
								@foreach(@$page->why_us as $key => $item)
								<button type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide {{$key}}"></button>
								@endforeach
							</div>
							<div class="carousel-inner">
								@foreach(@$page->why_us as $key => $item)
									<div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
										<img src="{{ url('storage/'.$item->image) }}" class="d-block w-100 border-radius-24" alt="{{ $item->title }}">
									</div>
								@endforeach
							</div>
							<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide="prev">
								<div class="btn-circle">
									<i class="bi bi-chevron-left"></i>
								</div>
								<span class="visually-hidden">Previous</span>
							</button>
							<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions1" data-bs-slide="next">
								<div class="btn-circle">
									<i class="bi bi-chevron-right"></i>
								</div>
								<span class="visually-hidden">Next</span>
							</button>
						</div>
					</div>
					<div class="col-lg-6 d-flex align-items-center">
						@foreach(@$page->why_us as $key => $item)
							<div class="ms-5 mt-5 carousel-item-description carousel-item-description-{{$key}}">
								<p class="subheading-24 weight-bold text-sm-start">{{ $item->title }}</p>
								<p class="body-18 grayscale-800 text-sm-start">{{ $item->description }}</p>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</section>
		<!-- End Why Section -->

		<!-- Testimony Section -->
		<section class="section bg-primary-50">
			<div class="container" data-aos="fade-up">
				<div class="row g-0 mb-5">
					<div class="col-lg-6">
						<p class="heading-36 weight-bold text-sm-start text-center">{{ @$page->testimony_header }}</p>
						<p class="body-18 grayscale-800 text-sm-start text-center">{{ @$page->testimony_sub_header }}</p>
					</div>
					<div class="col-lg-6 d-flex align-items-center justify-content-lg-end">
						<a href="{{ @$page->testimony_action }}" target="_blank" class="btn btn-primary d-none d-sm-flex">
							Ajukan Sekarang
							<i class="bi bi-arrow-right push-right ms-2"></i>
						</a>
					</div>
				</div>
				<div class="horizontal-scroll gap-3" id="horizontalScroll3">
					@foreach(@$page->testimony_sliders as $slider)
					<div class="px-4 py-5 bg-primary-100 border-radius-24" style="width: 392px;">
						<div class="d-flex gap-3 mb-2">
							<i class="bi bi-star{{ 1 <= $slider->star ? '-fill' : '' }} fs-3 primary-500"></i>
							<i class="bi bi-star{{ 2 <= $slider->star ? '-fill' : '' }} fs-3 primary-500"></i>
							<i class="bi bi-star{{ 3 <= $slider->star ? '-fill' : '' }} fs-3 primary-500"></i>
							<i class="bi bi-star{{ 4 <= $slider->star ? '-fill' : '' }} fs-3 primary-500"></i>
							<i class="bi bi-star{{ 5 <= $slider->star ? '-fill' : '' }} fs-3 primary-500"></i>
						</div>
						<p class="body-16 grayscale-950">{{ $slider->content }}</p>
						<div class="mt-4">
							<p class="subheading-20 weight-bold mb-1">{{ $slider->title }}</p>
							<p class="body-18 grayscale-700">{{ $slider->role }}</p>
						</div>
					</div>
					@endforeach
				</div>
				<button class="carousel-control-prev" type="button" id="slideBack3" style="top: 30%;">
					<div class="btn-circle">
						<i class="bi bi-chevron-left"></i>
					</div>
					<span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" id="slideNext3" style="top: 30%;">
					<div class="btn-circle">
						<i class="bi bi-chevron-right"></i>
					</div>
					<span class="visually-hidden">Next</span>
				</button>
				<button type="button" class="btn btn-primary mt-4 d-sm-none">
					Ajukan Sekarang
					<i class="bi bi-arrow-right push-right ms-2"></i>
				</button>
			</div>
		</section>
		<!-- End Testimony Section -->

		<!-- Promo Section -->
		<section class="section">
			<div class="container" data-aos="fade-up">
				<div class="row g-0 mb-5">
					<div class="col-lg-6 d-flex align-items-center">
						<p class="heading-36 weight-bold mb-0">Promo</p>
					</div>
					<div class="col-lg-6 d-flex align-items-center justify-content-lg-end">
						<a role="button" class="btn btn-outline-secondary d-none d-sm-flex" href="{{ route('promo') }}">
							Selengkapnya
							<i class="bi bi-arrow-right push-right ms-2"></i>
						</a>
					</div>
				</div>
				<div id="horizontalScroll2" class="horizontal-scroll gap-3 px-2 pb-3">
					@foreach($promos as $promo)
						<div id="promo-card" class="card border-radius-24" style="width: 392px">
							<img src="{{url('storage/'.$promo->image)}}" class="border-radius-top-24" alt="image promo" height="220">
							<div class="card-body d-grid">
								<p class="card-text">Sampai {{ \Carbon\Carbon::parse($promo->valid_date)->format('d F Y') }}</p>
								<a target="_blank" href="{{ $promo->action_link }}" class="btn btn-primary">
									Ajukan Sekarang
								</a>
							</div>
						</div>
					@endforeach
				</div>
				<button class="carousel-control-prev" type="button" id="slideBack2" style="top: 20%;">
					<div class="btn-circle">
						<i class="bi bi-chevron-left"></i>
					</div>
					<span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" id="slideNext2" style="top: 20%;">
					<div class="btn-circle">
						<i class="bi bi-chevron-right"></i>
					</div>
					<span class="visually-hidden">Next</span>
				</button>
				<div class="col-lg-6 d-flex align-items-center justify-content-lg-end mt-4 d-sm-none">
					<a role="button" class="btn btn-outline-secondary" href="{{ route('promo') }}">
						Selengkapnya
						<i class="bi bi-arrow-right push-right ms-2"></i>
					</a>
				</div>
			</div>
		</section>
		<!-- End Promo Section -->

	</main>

@endsection

@push('customJs')
	<script>

		var button = document.getElementById('slideNext');
		button.onclick = function () {
			var container = document.getElementById('horizontalScroll');
			scrollAmount = 0;
			var slideTimer = setInterval(function(){
				container.scrollLeft += 10;
				scrollAmount += 10;
				if(scrollAmount >= 250){
					window.clearInterval(slideTimer);
				}
			}, 25);
		};

		var back = document.getElementById('slideBack');
		back.onclick = function () {
			var container = document.getElementById('horizontalScroll');
			scrollAmount = 0;
			var slideTimer = setInterval(function(){
				container.scrollLeft -= 10;
				scrollAmount += 10;
				if(scrollAmount >= 250){
					window.clearInterval(slideTimer);
				}
			}, 25);
		};

		var button = document.getElementById('slideNext2');
		button.onclick = function () {
			var container = document.getElementById('horizontalScroll2');
			scrollAmount = 0;
			var slideTimer = setInterval(function(){
				container.scrollLeft += 10;
				scrollAmount += 10;
				if(scrollAmount >= 250){
					window.clearInterval(slideTimer);
				}
			}, 25);
		};

		var back = document.getElementById('slideBack2');
		back.onclick = function () {
			var container = document.getElementById('horizontalScroll2');
			scrollAmount = 0;
			var slideTimer = setInterval(function(){
				container.scrollLeft -= 10;
				scrollAmount += 10;
				if(scrollAmount >= 250){
					window.clearInterval(slideTimer);
				}
			}, 25);
		};

		var button = document.getElementById('slideNext3');
		button.onclick = function () {
			var container = document.getElementById('horizontalScroll3');
			scrollAmount = 0;
			var slideTimer = setInterval(function(){
				container.scrollLeft += 10;
				scrollAmount += 10;
				if(scrollAmount >= 250){
					window.clearInterval(slideTimer);
				}
			}, 25);
		};

		var back = document.getElementById('slideBack3');
		back.onclick = function () {
			var container = document.getElementById('horizontalScroll3');
			scrollAmount = 0;
			var slideTimer = setInterval(function(){
				container.scrollLeft -= 10;
				scrollAmount += 10;
				if(scrollAmount >= 250){
					window.clearInterval(slideTimer);
				}
			}, 25);
		};

		$('.carousel-item-description').hide();

		var currentIndex = $('#carouselExampleCaptions1 .carousel-item.active').index();
		$('.carousel-item-description-'+currentIndex).show();

		$('#carouselExampleCaptions1 ').on('slid.bs.carousel', function() {
			$('.carousel-item-description').hide();
			currentIndex = $('#carouselExampleCaptions1 .carousel-item.active').index();
			$('.carousel-item-description-'+currentIndex).show();
		});
	</script>
@endpush
