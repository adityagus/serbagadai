<!-- Navbar -->
<header class="navbar-container">
    <div class="container navbar">
        <a href="{{ route('home') }}" class="logo-area">
            <div class="logo-shield-crop">
                <img src="{{ url('serbamulia/assets/logo.png') }}" alt="{{ @$CONF->title ?? 'Gadai Mulia' }}" class="logo-img-source">
            </div>
            <div class="logo-text-crop">
                <img src="{{ url('serbamulia/assets/logo.png') }}" alt="{{ @$CONF->title ?? 'Gadai Mulia' }}" class="logo-img-source">
            </div>
        </a>

        <nav class="nav-links">
            <a href="{{ route('simulasi') }}" class="nav-link {{ request()->routeIs('simulasi*') ? 'active' : '' }}">Simulasi</a>
            <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">Tentang</a>

            <div class="nav-dropdown">
                <a href="{{ route('services') }}" class="nav-link nav-dropdown-trigger {{ request()->routeIs('services') || request()->routeIs('product.*') ? 'active' : '' }}">
                    <span>Produk & Layanan</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </a>
                <div class="nav-dropdown-menu">
                    <a href="{{ route('services') }}" class="nav-dropdown-item">
                        <div>
                            <span class="nav-dropdown-item-title">{{ @$product_config->menu_title ?? 'Semua Produk & Layanan' }}</span>
                            <span class="nav-dropdown-item-sub">{{ @$product_config->menu_short_description ?? 'Lihat ringkasan seluruh layanan gadai kami' }}</span>
                        </div>
                    </a>
                    @if(!empty($products) && count($products) > 0)
                        <div class="nav-dropdown-divider"></div>
                        @foreach($products as $navProduct)
                            <a href="{{ route('product.detail', ['slug' => $navProduct->slug]) }}" class="nav-dropdown-item">
                                @if(!empty($navProduct->icon))
                                    <img src="{{ url('storage/'.$navProduct->icon) }}" alt="{{ $navProduct->title }}" onerror="this.style.display='none'">
                                @endif
                                <div>
                                    <span class="nav-dropdown-item-title">{{ $navProduct->title }}</span>
                                    <span class="nav-dropdown-item-sub">{{ $navProduct->short_description }}</span>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>

            <a href="{{ route('promo') }}" class="nav-link {{ request()->routeIs('promo*') ? 'active' : '' }}">Promo</a>
            <a href="{{ route('career') }}" class="nav-link {{ request()->routeIs('career*') ? 'active' : '' }}">Karir</a>
            <a href="{{ route('article') }}" class="nav-link {{ request()->routeIs('article*') ? 'active' : '' }}">Artikel</a>
        </nav>

        <div class="nav-actions">
            <a href="{{ route('contact') }}" class="btn btn-primary btn-nav">
                Hubungi
            </a>
            <button id="theme-toggle" class="theme-toggle-btn" aria-label="Toggle Theme">
                <svg id="theme-toggle-dark-icon" class="hidden" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                </svg>
                <svg id="theme-toggle-light-icon" class="hidden" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="5"></circle>
                    <line x1="12" y1="1" x2="12" y2="3"></line>
                    <line x1="12" y1="21" x2="12" y2="23"></line>
                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                    <line x1="1" y1="12" x2="3" y2="12"></line>
                    <line x1="21" y1="12" x2="23" y2="12"></line>
                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                </svg>
            </button>
            <button id="menu-toggle" class="menu-toggle-btn" aria-label="Toggle Menu">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>
    </div>
</header>
