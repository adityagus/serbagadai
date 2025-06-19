<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center sticky-top">
	<div class="container d-flex align-items-center justify-content-between">

		<h1 class="logo"><a href="{{ route('home') }}">
				<img src="{{ url('storage/'.$CONF->logo) }}" />
			</a></h1>
		<!-- Uncomment below if you prefer to use an image logo -->
		<!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

		<nav id="navbar" class="navbar">
			<ul>
				<li><a class="nav-link scrollto" href="{{ route('about') }}">Tentang</a></li>
				<li class="dropdown w-100 d-sm-none"><a href="#"><span>Produk & Layanan</span> <i class="bi bi-chevron-down"></i></a>
					<ul>
						@foreach($products as $product)
						<li><a href="{{ route('product.detail',['slug'=>$product->slug]) }}">{{ $product->title }}</a></li>
						@endforeach
					</ul>
				</li>
				<li class="dropdown d-none d-sm-flex">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"><span>Produk & Layanan</span></a>
					<div class="dropdown-menu nav-sub-menu" aria-labelledby="navbarDarkDropdownMenuLink">
						<div class="row">
							<div class="col-3">
								<p class="subheading-24 weight-bold">{{ $product_config->menu_title }}</p>
								<p class="caption-14 grayscale-700 text-justify">{{ $product_config->menu_short_description }}</p>
							</div>
							<div class="col-9" style="max-height: 400px;overflow-y: scroll;overflow-x: hidden;">
								<div class="row gx-5 gy-5">
									@foreach($products as $product)
									<div class="col-md-4" onclick="location.href=`{{ route('product.detail',['slug'=>$product->slug]) }}`">
										<div class="d-flex justify-content-between align-items-start gap-3 submenu">
											<img class="col-lg-4" src="{{ url('storage/'.$product->icon) }}" />
											<div>
												<p class="subtitle-20 weight-bold mb-1">{{ $product->title }}</p>
												<p class="caption-14 grayscale-700 mb-0">{{ $product->short_description }}</p>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</li>
				<li><a class="nav-link scrollto" href="{{ route('promo') }}">Promo</a></li>
				<li><a class="nav-link scrollto" href="{{ route('outlet') }}">Outlet</a></li>
				<li><a class="nav-link scrollto" href="{{ route('career') }}">Karir</a></li>
				<li><a class="nav-link scrollto" href="{{ route('article') }}">Artikel</a></li>
				<li><a class="getstarted scrollto" href="{{ route('contact') }}">Hubungi</a></li>
			</ul>
			<i class="bi bi-list mobile-nav-toggle"></i>
		</nav><!-- .navbar -->

	</div>
</header>
<!-- End Header -->