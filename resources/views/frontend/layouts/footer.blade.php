<!-- ======= Footer ======= -->
<footer id="footer">

	<div class="footer-top">
		<div class="container">
			<div class="row">

				<div class="col-lg-4 col-md-6 footer-contact">
					<img src="{{ url('storage/'.$CONF->logoSecond) }}" />
					<p class="description text-justify">{{ $CONF->about }}</p>
				</div>

				<div class="col-lg-3 col-md-6 footer-links">
					<h4>Kantor Pusat</h4>
					<ul>
						<li><i class="bi bi-geo-alt d-flex align-items-center me-3"></i>{{ $CONF->address }}</li>
						<li><i class="bi bi-envelope d-flex align-items-center me-3"></i>{{ $CONF->email }}</li>
						<li><i class="bi bi-phone d-flex align-items-center me-3"></i>{{ $CONF->phone }}</li>
					</ul>
				</div>

				<div class="col-lg-2 col-md-6 col-sm-6 col-6 footer-links">
					<h4>&nbsp;&nbsp;</h4>
					<ul>
						<li><a href="{{ route('about') }}">Tentang</a></li>
						<li><a href="{{ route('promo') }}">Promo</a></li>
						<li><a href="{{ route('outlet') }}">Outlet</a></li>
						<li><a href="{{ route('career') }}">Karir</a></li>
						<li><a href="{{ route('article') }}">Artikel</a></li>
						<li><a href="{{ route('contact') }}">Hubungi</a></li>
					</ul>
				</div>

				<div class="col-lg-3 col-md-6 col-sm-6 col-6 footer-links">
					<h4>Ikuti Media Sosial Kami</h4>
					<ul>
						<li><a href="{{ $CONF->facebook }}"><img src="{{ url('frontend/assets/img/sosmed-fb.png') }}" class="me-3" />Facebook</a></li>
						<li><a href="{{ $CONF->instagram  }}"><img src="{{ url('frontend/assets/img/sosmed-ig.png') }}" class="me-3" /></i>Instagram</a></li>
						<li><a href="mailto:{{ $CONF->email }}"><img src="{{ url('frontend/assets/img/sosmed-email.png') }}" class="me-3" /></i>Email Us</a></li>
					</ul>
					<img src="{{ url('frontend/assets/img/ojk.png') }}" />
				</div>
				<div class="col-12 footer-contact text-center">
					<p class="copyright">Copyright © {{ date('Y') }} Gadai Mulia | All Rights Reserved </p>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- End Footer -->

{{--<div id="preloader"></div>--}}
<a href="https://api.whatsapp.com/send?phone={{ $CONF->whatsapp }}&amp;text=Halo%20Admin%20Saya%20Ingin%20Bertanya%20terkait%20{{ str_replace(' ','%20',$CONF->title)  }}" class="back-to-top d-flex align-items-center justify-content-center bg-primary-400 btn-wa-footer">
	<img src="{{ url('frontend/assets/img/img-wa.png')}}" class="img-wa-footer" />
</a>