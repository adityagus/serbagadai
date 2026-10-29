<div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse">
		<ul class="page-sidebar-menu  page-header-fixed "
			data-keep-expanded="false" data-auto-scroll="true"
			data-slide-speed="200" style="padding-top: 38px">
			<li class="nav-item {{@$sidebar === 'dashboard'? 'active' : ''}} "><a
				href="{{route('admin.dashboard')}}" class="nav-link nav-toggle"> <i
					class="fa fa-dashboard"></i> <span class="title">Beranda</span> <span
					class="arrow {{@$sidebar === 'dashboard'? '' : 'hidden'}}"></span>
			</a></li>
			<?php
				$master = ['user'];
				$career = ['career','career_submission'];
				$setting = ['general','home','about','setting-career','setting-product','province','location'];
			?>
			@if(@\Auth::user()->role == \App\Util\Constant::USER_ROLE_ADMIN)
			<li class="nav-item {{ in_array(@$sidebar,$master) ? 'active' : ''}}">
				<a href="javascript" class="nav-link nav-toggle"> <i
							class="fa fa-database"></i> <span class="title">Pengguna</span>
					<span class="arrow {{ in_array(@$sidebar,$master) ? '' : 'hidden'}}"></span>
				</a>
				<ul class="sub-menu">
					<li class="nav-item {{@$sidebar === 'user'? 'active' : ''}}">
						<a
							href="{{route('admin.users')}}" class="nav-link nav-toggle"> <i
								class="fa fa-users"></i> <span class="title">Akun</span> <span
								class="arrow {{@$sidebar === 'user'? '' : 'hidden'}}"></span>
						</a>
					</li>
				</ul>
			</li>
			<li class="nav-item {{@$sidebar === 'product'? 'active' : ''}} "><a
						href="{{route('admin.product')}}" class="nav-link nav-toggle"> <i
							class="fa fa-tag"></i> <span class="title">Produk</span> <span
							class="arrow {{@$sidebar === 'product'? '' : 'hidden'}}"></span>
				</a></li>
			<li class="nav-item {{@$sidebar === 'promo'? 'active' : ''}} "><a
					href="{{route('admin.promo')}}" class="nav-link nav-toggle"> <i
						class="fa fa-dollar"></i> <span class="title">Promo</span> <span
						class="arrow {{@$sidebar === 'promo'? '' : 'hidden'}}"></span>
			</a></li>
			<li class="nav-item {{@$sidebar === 'outlet'? 'active' : ''}} "><a
				href="{{route('admin.outlet')}}" class="nav-link nav-toggle"> <i
					class="fa fa-location-arrow"></i> <span class="title">Outlet</span> <span
					class="arrow {{@$sidebar === 'outlet'? '' : 'hidden'}}"></span>
			</a></li>
			<li class="nav-item {{@$sidebar === 'article'? 'active' : ''}} "><a
						href="{{route('admin.article')}}" class="nav-link nav-toggle"> <i
							class="fa fa-newspaper-o"></i> <span class="title">Article</span> <span
							class="arrow {{@$sidebar === 'article'? '' : 'hidden'}}"></span>
				</a></li>
			<li class="nav-item {{@$sidebar === 'contact'? 'active' : ''}} "><a
					href="{{route('admin.contact')}}" class="nav-link nav-toggle"> <i
						class="fa fa-envelope"></i> <span class="title">Kontak Kami</span> <span
						class="arrow {{@$sidebar === 'contact'? '' : 'hidden'}}"></span>
			</a></li>
			<li class="nav-item {{in_array(@$sidebar,$setting)? 'active' : ''}}">
				<a href="javascript" class="nav-link nav-toggle"> <i
						class="fa fa-gears"></i> <span class="title">Pengaturan</span>
				<span class="arrow {{in_array(@$sidebar,$setting)? '' : 'hidden'}}"></span>
			</a>
				<ul class="sub-menu">
					<li class="nav-item {{@$sidebar === 'general'? 'active' : ''}}"><a
							href="{{route('admin.settings')}}" class="nav-link nav-toggle"> <i
								class="icon-share"></i> <span class="title">Umum</span> <span
								class="arrow {{@$sidebar === 'general'? '' : 'hidden'}}"></span>
					</a></li>
					<li class="nav-item {{@$sidebar === 'home'? 'active' : ''}}"><a
							href="{{route('admin.pages.home')}}" class="nav-link nav-toggle"> <i
								class="icon-home"></i> <span class="title">Halaman Beranda</span> <span
								class="arrow {{@$sidebar === 'home'? '' : 'hidden'}}"></span>
					</a></li>
					<li class="nav-item {{@$sidebar === 'about'? 'active' : ''}}"><a
							href="{{route('admin.pages.about')}}" class="nav-link nav-toggle"> <i
								class="icon-bulb"></i> <span class="title">Halaman Tentang</span> <span
								class="arrow {{@$sidebar === 'about'? '' : 'hidden'}}"></span>
					</a></li>
					<li class="nav-item {{@$sidebar === 'setting-career'? 'active' : ''}}"><a
							href="{{route('admin.pages.career')}}" class="nav-link nav-toggle"> <i
								class="icon-picture"></i> <span class="title">Halaman Karir</span> <span
								class="arrow {{@$sidebar === 'setting-career'? '' : 'hidden'}}"></span>
					</a></li>
					<li class="nav-item {{@$sidebar === 'setting-product'? 'active' : ''}}"><a
							href="{{route('admin.pages.product')}}" class="nav-link nav-toggle"> <i
								class="fa fa-tag"></i> <span class="title">Menu Produk</span> <span
								class="arrow {{@$sidebar === 'setting-product'? '' : 'hidden'}}"></span>
					</a></li>
					<li class="nav-item {{@$sidebar === 'province'? 'active' : ''}}"><a
							href="{{route('admin.province')}}" class="nav-link nav-toggle"> <i
								class="icon-plus"></i> <span class="title">Provinsi</span> <span
								class="arrow {{@$sidebar === 'province'? '' : 'hidden'}}"></span>
					</a></li>
					<li class="nav-item {{@$sidebar === 'location'? 'active' : ''}}"><a
								href="{{route('admin.location')}}" class="nav-link nav-toggle"> <i
									class="fa fa-building"></i> <span class="title">Lokasi Karir</span> <span
									class="arrow {{@$sidebar === 'location'? '' : 'hidden'}}"></span>
						</a></li>
				</ul>
			</li>
			@endif
			@if(in_array(@\Auth::user()->role,[
				\App\Util\Constant::USER_ROLE_ADMIN,
				\App\Util\Constant::USER_ROLE_HRD,
			]))
			<li class="nav-item {{in_array(@$sidebar,$setting)? 'active' : ''}}">
				<a href="javascript" class="nav-link nav-toggle"> <i
						class="fa fa-gears"></i> <span class="title">Pengaturan</span>
				<span class="arrow {{in_array(@$sidebar,$setting)? '' : 'hidden'}}"></span>
			</a>
				<ul class="sub-menu">
					<li class="nav-item {{@$sidebar === 'setting-career'? 'active' : ''}}"><a
							href="{{route('admin.pages.career')}}" class="nav-link nav-toggle"> <i
								class="icon-picture"></i> <span class="title">Halaman Karir</span> <span
								class="arrow {{@$sidebar === 'setting-career'? '' : 'hidden'}}"></span>
					</a></li>
					<li class="nav-item {{@$sidebar === 'location'? 'active' : ''}}"><a
								href="{{route('admin.location')}}" class="nav-link nav-toggle"> <i
									class="fa fa-building"></i> <span class="title">Lokasi Karir</span> <span
									class="arrow {{@$sidebar === 'location'? '' : 'hidden'}}"></span>
						</a></li>
				</ul>
			</li>
			<li class="nav-item {{ in_array(@$sidebar,$career) ? 'active' : ''}}">
				<a href="javascript" class="nav-link nav-toggle"> <i
							class="fa fa-database"></i> <span class="title">Karir</span>
					<span class="arrow {{ in_array(@$sidebar,$career) ? '' : 'hidden'}}"></span>
				</a>
				<ul class="sub-menu">
					<li class="nav-item {{@$sidebar === 'career'? 'active' : ''}}">
						<a
								href="{{route('admin.career')}}" class="nav-link nav-toggle"> <i
									class="fa fa-users"></i> <span class="title">Daftar Karir</span> <span
									class="arrow {{@$sidebar === 'career'? '' : 'hidden'}}"></span>
						</a>
					</li>
					<li class="nav-item {{@$sidebar === 'career_submission'? 'active' : ''}}">
						<a
								href="{{route('admin.career.submission')}}" class="nav-link nav-toggle"> <i
									class="fa fa-address-card-o"></i> <span class="title">Daftar Lamaran</span> <span
									class="arrow {{@$sidebar === 'career_submission'? '' : 'hidden'}}"></span>
						</a>
					</li>
				</ul>
			</li>
			@endif
		</ul>
	</div>
</div>
