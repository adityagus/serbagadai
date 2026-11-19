@extends('frontend.layouts.template')

@section('pageTitle', 'Beranda')

@section('content')
    @php
        $waNumber = preg_replace('/[^0-9]/', '', @$CONF->whatsapp ?: '6281181126771');
        $heroBg = !empty($page->hero_background)
            ? url('storage/' . $page->hero_background)
            : url('serbamulia/assets/hero_bg.jpg');
        $heroTitle =
            !empty($page->hero_header) &&
            trim($page->hero_header) !== '.' &&
            stripos($page->hero_header, 'emas') === false
                ? $page->hero_header
                : '';
        $heroSub =
            !empty($page->hero_sub_header) &&
            trim($page->hero_sub_header) !== '.' &&
            stripos($page->hero_sub_header, 'emas') === false
                ? $page->hero_sub_header
                : '';
        $aboutImg = !empty($page->about_image)
            ? url('storage/' . $page->about_image)
            : url('serbamulia/assets/elektronik.jpg');
    @endphp

    <!-- cnaf Style Hero Banner Carousel Section -->
    <section class="cnaf-hero-wrapper" id="hero">
        <div class="cnaf-slider" id="cnafSlider">
            <div class="cnaf-track" id="cnafTrack">

                <!-- Slide 1: Gadai Elektronik Utama -->
                {{-- <div class="cnaf-slide-item">
                    <div class="cnaf-slide-bg" style="background-image: url('{{ $heroBg }}');"></div>
                    <div class="cnaf-slide-overlay"></div>
                    <div class="container cnaf-slide-content">
                        <div class="cnaf-slide-grid">
                            <div class="cnaf-slide-info">
                                <div class="cnaf-slide-badge">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2L3 7V12C3 16.5 6.8 20.7 12 22C17.2 20.7 21 16.5 21 12V7L12 2Z" fill="#02C3A8" />
                                        <path d="M9 12L11 14L15 10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Gadai Elektronik Berizin & Diawasi OJK</span>
                                </div>
                                <h1 class="cnaf-slide-title">{!! $heroTitle !!}</h1>
                                <p class="cnaf-slide-desc">{!! $heroSub !!}</p>
                                <div class="cnaf-slide-features">
                                    <div class="cnaf-slide-feat-item">
                                        <span class="feat-chk">✓</span>
                                        <span>Syarat Cukup KTP</span>
                                    </div>
                                    <div class="cnaf-slide-feat-item">
                                        <span class="feat-chk">✓</span>
                                        <span>Unit Disegel & Asuransi</span>
                                    </div>
                                    <div class="cnaf-slide-feat-item">
                                        <span class="feat-chk">✓</span>
                                        <span>Cair Instan ± 8 Menit</span>
                                    </div>
                                </div>
                                <div class="cnaf-slide-actions">
                                    <a href="{{ route('simulasi') }}" class="btn btn-primary">Simulasi Gadai Elektronik</a>
                                    @if (!empty($page->hero_action) && $page->hero_action !== '#')
                                        <a href="{{ $page->hero_action }}" target="_blank" class="btn btn-secondary">Ajukan Sekarang</a>
                                    @else
                                        <a href="https://api.whatsapp.com/send?phone={{ $waNumber }}&text=Halo%20Serba%20Gadai%20saya%20ingin%20mengajukan%20gadai%20elektronik" target="_blank" class="btn btn-secondary">Konsultasi WhatsApp</a>
                                    @endif
                                </div>
                            </div>
                            <div class="cnaf-slide-visual">
                                <div class="cnaf-visual-card">
                                    <img src="{{ url('serbamulia/assets/test.gif') }}" onerror="this.onerror=null;this.src='{{ url('serbamulia/assets/elektronik.jpg') }}';" alt="Gadai Elektronik" class="cnaf-visual-img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}


                <!-- CMS Sliders (if uploaded in CMS) -->
                @if (!empty($page->hero_sliders) && count($page->hero_sliders) > 0)
                    @foreach ($page->hero_sliders as $slider)
                        @if (!empty($slider->image))
                            <div class="cnaf-slide-item cnaf-slide-banner-item">
                                <a href="{{ !empty($slider->link) ? $slider->link : route('simulasi') }}"
                                    class="cnaf-slide-banner-link"
                                    {{ !empty($slider->link) && str_starts_with($slider->link, 'http') ? 'target="_blank"' : '' }}>
                                    <img src="{{ url('storage/' . $slider->image) }}"
                                        alt="{{ $slider->title ?? 'Promo Serba Gadai' }}" class="cnaf-slide-banner-img">
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endif

            </div>

            <!-- Navigation Controls -->
            <button class="cnaf-nav-btn cnaf-nav-prev" onclick="prevCnafSlide()" aria-label="Previous Slide">‹</button>
            <button class="cnaf-nav-btn cnaf-nav-next" onclick="nextCnafSlide()" aria-label="Next Slide">›</button>

            <!-- Dots Indicator (cnaf Style) -->
            <div class="cnaf-dots-container" id="cnafDots"></div>
        </div>
    </section>



    <!-- OJK and Trust Banner -->
    <section class="trust-banner">
        <div class="container trust-container">
            <span class="trust-label">DISETUJUI & DIAWASI OLEH OJK</span>
            <div class="trust-logos">
                <span class="insurance-badge">Barang Jaminan 100% Aman & Diasuransikan</span>
            </div>
        </div>
    </section>

    <!-- cnaf Style Keuntungan / Benefit Section -->
    <section class="section-benefit" id="keuntungan">
        <div class="container">
            <div class="row">
                <div class="col-md-12 benefit-content">
                    <h2 class="benefit-heading">Keuntungan Gadai di Serba Gadai</h2>
                    <p class="benefit-subheading">
                        Serba Gadai senantiasa memberikan kemudahan layanan gadai barang elektronik yang aman, transparan,
                        dan terpercaya dengan izin resmi Otoritas Jasa Keuangan (OJK).
                    </p>
                </div>
            </div>
            <div class="row-icon-benefit">
                <div class="benefit-card">
                    <div class="benefit-icon-wrapper icon-wrap-orange">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                    </div>
                    <h5>Pengajuan Mudah</h5>
                    <p>Cukup bawa KTP dan barang elektronik Anda (HP, Laptop, Kamera, TV). Proses tanpa BI checking dan
                        tanpa persyaratan yang rumit.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon-wrapper icon-wrap-teal">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <h5>Proses Cepat ± 8 Menit</h5>
                    <p>Penaksiran unit dilakukan secara objektif sesuai harga pasar terkini dan pencairan dana langsung cair
                        tunai atau transfer ke rekening Anda.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon-wrapper icon-wrap-blue">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </div>
                    <h5>100% Aman & Diasuransikan</h5>
                    <p>Barang jaminan disimpan di ruang brankas khusus bebas lembap, disegel resmi di hadapan Anda, dan
                        diawasi resmi oleh OJK.</p>
                </div>
            </div>
        </div>
    </section>


    {{-- <!-- CNAF Style Products & Services Slider Section -->
    <section class="cnaf-product-section" id="layanan">
        <div class="container">
            <div class="cnaf-product-header text-center">
                <h2 class="cnaf-product-title">{{ !empty($page->product_title) ? $page->product_title : 'Produk & Simulasi CIMB Niaga Finance' }}</h2>
                <p class="cnaf-product-desc">{{ !empty($page->product_sub_title) ? $page->product_sub_title : 'Cari tahu angsuran dan pilihan tenor sesuai dengan kemampuan kamu disini. Simulasikan pilihan pembiayaan kamu sekarang' }}</p>
            </div>

            <div class="cnaf-product-wrapper">
                <button class="cnaf-product-btn cnaf-product-btn-prev" onclick="prevProductCard()" aria-label="Previous">‹</button>
                <button class="cnaf-product-btn cnaf-product-btn-next" onclick="nextProductCard()" aria-label="Next">›</button>

                <div class="cnaf-product-viewport" id="cnafProductViewport">
                    <div class="cnaf-product-track" id="cnafProductTrack">
                        @php
                            $prodSliders = !empty($page->product_sliders) ? $page->product_sliders : [];
                        @endphp

                        @if(!empty($prodSliders) && count($prodSliders) > 0)
                            @foreach($prodSliders as $pIndex => $pItem)
                                <div class="cnaf-product-card">
                                    <a href="{{ !empty($pItem->link) ? $pItem->link : route('simulasi') }}" class="cnaf-product-card-link">
                                        <div class="cnaf-product-icon-box">
                                            @if(!empty($pItem->image))
                                                <img src="{{ url('storage/' . $pItem->image) }}" alt="{{ $pItem->title }}" class="cnaf-product-icon-img">
                                            @else
                                                <svg width="34" height="34" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V8l8 5 8-5v10zm-8-7L4 6h16l-8 5z"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <h3 class="cnaf-product-card-title">{{ $pItem->title }}</h3>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <!-- Default 6 Elektronik Product Cards (CNAF Style) -->
                            <div class="cnaf-product-card">
                                <a href="{{ route('simulasi') }}?jenis=smartphone" class="cnaf-product-card-link">
                                    <div class="cnaf-product-icon-box">
                                        <img src="{{ url('serbamulia/assets/icon-02.svg') }}" alt="Gadai Smartphone" class="cnaf-product-icon-img">
                                    </div>
                                    <h3 class="cnaf-product-card-title">Gadai Smartphone & Tablet</h3>
                                </a>
                            </div>

                            <div class="cnaf-product-card">
                                <a href="{{ route('simulasi') }}?jenis=laptop" class="cnaf-product-card-link">
                                    <div class="cnaf-product-icon-box">
                                        <img src="{{ url('serbamulia/assets/icon-01.svg') }}" alt="Gadai Laptop" class="cnaf-product-icon-img">
                                    </div>
                                    <h3 class="cnaf-product-card-title">Gadai Laptop & MacBook</h3>
                                </a>
                            </div>

                            <div class="cnaf-product-card">
                                <a href="{{ route('simulasi') }}?jenis=kamera" class="cnaf-product-card-link">
                                    <div class="cnaf-product-icon-box">
                                        <img src="{{ url('serbamulia/assets/icon-03.svg') }}" alt="Gadai Kamera" class="cnaf-product-icon-img">
                                    </div>
                                    <h3 class="cnaf-product-card-title">Gadai Kamera & Lensa</h3>
                                </a>
                            </div>

                            <div class="cnaf-product-card">
                                <a href="{{ route('simulasi') }}?jenis=tv_audio" class="cnaf-product-card-link">
                                    <div class="cnaf-product-icon-box">
                                        <img src="{{ url('serbamulia/assets/icon-04.svg') }}" alt="Gadai Smart TV" class="cnaf-product-icon-img">
                                    </div>
                                    <h3 class="cnaf-product-card-title">Gadai Smart TV & Audio</h3>
                                </a>
                            </div>

                            <div class="cnaf-product-card">
                                <a href="{{ route('simulasi') }}?jenis=gadget" class="cnaf-product-card-link">
                                    <div class="cnaf-product-icon-box">
                                        <img src="{{ url('serbamulia/assets/icon-05.svg') }}" alt="Gadai Konsol" class="cnaf-product-icon-img">
                                    </div>
                                    <h3 class="cnaf-product-card-title">Gadai Konsol Game & PS5</h3>
                                </a>
                            </div>

                            <div class="cnaf-product-card">
                                <a href="{{ route('simulasi') }}?jenis=gadget" class="cnaf-product-card-link">
                                    <div class="cnaf-product-icon-box">
                                        <img src="{{ url('serbamulia/assets/icon-07.svg') }}" alt="Gadai Smartwatch & Gadget" class="cnaf-product-icon-img">
                                    </div>
                                    <h3 class="cnaf-product-card-title">Gadai Smartwatch & Gadget</h3>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

           <!-- Products & Services -->
    <section class="products-section" id="layanan">
        <div class="container">
            <div class="section-header-center">
                <span class="section-badge center">PRODUK GADAI ELEKTRONIK</span>
                <h2 class="section-title-dark text-center">Produk Gadai Elektronik Kami</h2>
                <p class="section-desc-center text-center">Penaksiran perangkat elektronik secara objektif sesuai harga
                    pasar terkini dengan pencairan dana instan.</p>
            </div>

            <div class="products-grid">
                @if (!empty($products) && count($products) > 0)
                    @foreach ($products as $idx => $product)
                        @php
                            $fallbackAsset = url('serbamulia/assets/elektronik.jpg');
                            $prodImg = !empty($product->image)
                                ? url('storage/' . $product->image)
                                : (!empty($product->icon)
                                    ? url('storage/' . $product->icon)
                                    : $fallbackAsset);
                            $advantages = !empty($product->advantages) ? json_decode($product->advantages) : [];
                        @endphp
                        <div class="product-card">
                            <div class="product-img-wrapper">
                                <img src="{{ $prodImg }}" onerror="this.onerror=null;this.src='{{ $fallbackAsset }}';"
                                    alt="{{ $product->title }}" class="product-img">
                            </div>
                            <div class="product-info">
                                <h3 class="product-title">{{ $product->title }}</h3>
                                <p class="product-desc">{{ $product->short_description }}</p>
                                @if (!empty($advantages) && is_array($advantages))
                                    <ul class="product-features">
                                        @foreach (array_slice($advantages, 0, 3) as $adv)
                                            @if (!empty($adv->text))
                                                <li>{{ \Illuminate\Support\Str::limit($adv->text, 65) }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                                <div style="display: flex; gap: 10px; margin-top: auto;">
                                    <a href="{{ route('product.detail', ['slug' => $product->slug]) }}"
                                        class="btn btn-outline btn-sm" style="flex: 1;">Lihat Detail</a>
                                    <a href="{{ !empty($product->call_action) ? $product->call_action : 'https://api.whatsapp.com/send?phone=' . $waNumber . '&text=Halo%20Serba%20Gadai%20saya%20tertarik%20dengan%20' . urlencode($product->title) }}"
                                        target="_blank" class="btn btn-primary btn-sm" style="flex: 1;">Ajukan</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Default Elektronik cards if CMS products empty -->
                    <div class="product-card">
                        <div class="product-img-wrapper">
                            <img src="{{ url('serbamulia/assets/elektronik.jpg') }}" alt="Gadai Smartphone & Tablet"
                                class="product-img">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Gadai Smartphone & Tablet</h3>
                            <p class="product-desc">Pinjaman dana tunai cepat dengan jaminan iPhone, Samsung Galaxy, iPad,
                                dan berbagai merek smartphone Android pilihan.</p>
                            <ul class="product-features">
                                <li>Taksiran tinggi sesuai harga pasar</li>
                                <li>Data privasi aman & unit disegel</li>
                                <li>Cair instan dalam ± 8 menit</li>
                            </ul>
                            <a href="{{ route('simulasi') }}" class="btn btn-primary btn-sm">Simulasi Sekarang</a>
                        </div>
                    </div>
                    <div class="product-card">
                        <div class="product-img-wrapper">
                            <img src="{{ url('serbamulia/assets/elektronik.jpg') }}" alt="Gadai Laptop & MacBook"
                                class="product-img">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Gadai Laptop & MacBook</h3>
                            <p class="product-desc">Solusi dana mendesak dengan jaminan MacBook, Laptop Gaming, maupun
                                Ultrabook kerja dengan penyimpanan ruang khusus.</p>
                            <ul class="product-features">
                                <li>Menerima berbagai merek & spesifikasi</li>
                                <li>Penyimpanan bebas lembap & bersegel</li>
                                <li>100% dilindungi asuransi barang</li>
                            </ul>
                            <a href="{{ route('simulasi') }}" class="btn btn-primary btn-sm">Simulasi Sekarang</a>
                        </div>
                    </div>
                    <div class="product-card">
                        <div class="product-img-wrapper">
                            <img src="{{ url('serbamulia/assets/elektronik.jpg') }}" alt="Gadai Kamera, TV & Konsol"
                                class="product-img">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Gadai Kamera, TV & Gadget</h3>
                            <p class="product-desc">Terima gadai Kamera Mirrorless/DSLR, Smart TV LED, PlayStation 5,
                                Nintendo Switch, dan perangkat elektronik lainnya.</p>
                            <ul class="product-features">
                                <li>Proses penaksiran transparan & cepat</li>
                                <li>Syarat mudah cukup bawa KTP</li>
                                <li>Sewa modal ringan & kompetitif</li>
                            </ul>
                            <a href="{{ route('simulasi') }}" class="btn btn-primary btn-sm">Simulasi Sekarang</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    
    

    <!-- Why Us Section -->
    <section class="why-section" id="mengapa">
        <div class="container">
            <div class="why-grid">
                <div class="why-text-side">
                    <span class="section-badge">KEUNGGULAN KAMI</span>
                    <h2 class="section-title-light">Mengapa Ribuan Nasabah Memilih {{ @$CONF->title ?? 'Gadai Mulia' }}?
                    </h2>
                    <p class="section-desc-light">Kami berkomitmen memberikan pelayanan terbaik dengan integritas tinggi
                        dan transparansi penuh untuk seluruh nasabah kami.</p>
                </div>


                <!-- Feature visual showcase -->
                <div class="why-image-side">
                    <div class="neon-card-glow"></div>
                    <div class="info-showcase-card">
                        <div class="showcase-header">
                            <div class="avatar-group">
                                <div class="avatar">👨‍💼</div>
                                <div class="avatar">👩‍💼</div>
                                <div class="avatar">🙋</div>
                            </div>
                            <div class="showcase-header-text">
                                <span class="primary-text">10.000+ Nasabah</span>
                                <span class="secondary-text">Telah terbantu keuangan mendesaknya</span>
                            </div>
                        </div>
                        <div class="showcase-body">
                            <div class="showcase-row">
                                <span>Rata-rata Waktu Proses</span>
                                <span class="highlight-green">8 Menit Cair</span>
                            </div>
                            <div class="showcase-row">
                                <span>Rating Kepuasan</span>
                                <span class="highlight-gold">★★★★★ 4.9/5</span>
                            </div>
                            <div class="showcase-row">
                                <span>Izin Operasional</span>
                                <span class="highlight-blue">Resmi OJK</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="why-grid" style="gap: 20px">
                @if (!empty($page->why_us) && count($page->why_us) > 0)
                    @foreach ($page->why_us as $item)
                        <div class="feature-card">
                            <div class="feature-icon-wrapper">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2L3 7V12C3 16.5 6.8 20.7 12 22C17.2 20.7 21 16.5 21 12V7L12 2Z"
                                        fill="#F59E0B" />
                                    <path d="M9 12L11 14L15 10" stroke="white" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="feature-title">{{ $item->title }}</h4>
                                <p class="feature-desc-text">{{ $item->description }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM13 17H11V11H13V17ZM13 9H11V7H13V9Z"
                                    fill="#F59E0B" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="feature-title">Pencairan Tinggi, Biaya Murah</h4>
                            <p class="feature-desc-text">Nilai taksiran barang berharga Anda dinilai seadil mungkin
                                untuk mendapatkan pinjaman maksimal.</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M18 8H17V6C17 3.24 14.76 1 12 1C9.24 1 7 3.24 7 6V8H6C4.9 8 4 8.9 4 10V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V10C20 8.9 19.1 8 18 8ZM12 17C10.9 17 10 16.1 10 15C10 13.9 10.9 13 12 13C13.1 13 14 13.9 14 15C14 16.1 13.1 17 12 17ZM15.1 8H8.9V6C8.9 4.29 10.29 2.9 12 2.9C13.71 2.9 15.1 4.29 15.1 6V8Z"
                                    fill="#F59E0B" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="feature-title">Keamanan Jaminan 100%</h4>
                            <p class="feature-desc-text">Barang jaminan disimpan di lemari besi khusus berstandar
                                keamanan tinggi dan sepenuhnya diasuransikan.</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM16.2 16.2L11 13V7H12.5V12.2L17 14.9L16.2 16.2Z"
                                    fill="#F59E0B" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="feature-title">Syarat Mudah & Instan</h4>
                            <p class="feature-desc-text">Hanya butuh KTP dan barang jaminan. Proses cepat, uang
                                langsung cair di tempat dalam hitungan menit.</p>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>


    <!-- Promo Highlight Section -->
    @if (!empty($promos) && count($promos) > 0)
        <section class="page-content-section" id="promo-home">
            <div class="container">
                <div class="section-header-center">
                    <span class="section-badge center">PROMO SPESIAL</span>
                    <h2 class="section-title-dark text-center">Penawaran & Promo Terbaru</h2>
                    <p class="section-desc-center text-center">Nikmati berbagai keuntungan ekstra dan program promo menarik
                        dari {{ @$CONF->title ?? 'Gadai Mulia' }}.</p>
                </div>

                <div class="promo-grid">
                    @foreach ($promos->take(3) as $promo)
                        <div class="p-card">
                            <div class="p-card-tag active">PROMO AKTIF</div>
                            <div class="p-card-img-wrapper">
                                <img src="{{ url('storage/' . $promo->image) }}" alt="{{ $promo->title ?? 'Promo' }}"
                                    style="width: 100%; height: 100%; object-fit: cover;"
                                    onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                                <div class="gradient-fallback-img p-fallback" style="display: none;">
                                    <span class="p-icon">🎁</span>
                                </div>
                            </div>
                            <div class="p-card-content">
                                <span class="p-date">Sampai
                                    {{ \Carbon\Carbon::parse($promo->valid_date)->format('d F Y') }}</span>
                                <h3 class="p-title">
                                    {{ !empty($promo->title) ? $promo->title : 'Promo Spesial Gadai Mulia' }}</h3>
                                <a href="{{ !empty($promo->action_link) ? $promo->action_link : 'https://api.whatsapp.com/send?phone=' . $waNumber . '&text=Halo%20Admin,%20saya%20ingin%20klaim%20promo%20' . urlencode($promo->title ?? 'Gadai Mulia') }}"
                                    target="_blank" class="btn btn-primary btn-block" style="margin-top: auto;">Ajukan
                                    Sekarang</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="text-align: center; margin-top: 40px;">
                    <a href="{{ route('promo') }}" class="btn btn-outline">Lihat Semua Promo →</a>
                </div>
            </div>
        </section>
    @endif

    <!-- Interactive Branch Locator Section -->
    <section class="page-content-section" id="lokasi-cabang">
        <div class="container">
            <div class="section-header-center">
                <span class="section-badge center">CABANG & OUTLET</span>
                <h2 class="section-title-dark text-center">Temukan Lokasi <span class="gold-text">Cabang Terdekat</span>
                </h2>
                <p class="section-desc-center text-center">Gunakan peta interaktif atau fitur deteksi lokasi untuk
                    menemukan cabang resmi {{ @$CONF->title ?? 'Gadai Mulia' }} terdekat dari tempat Anda.</p>
            </div>

            @include('frontend.pages.part.branch-locator')
        </div>
    </section>

    <!-- Apa Kata Mereka (Testimonials Slider - cnaf Style) -->
    <section class="cnaf-testi-section" id="testimoni">
        <div class="container">
            <div class="cnaf-testi-header">
                <h2 class="cnaf-testi-title">
                    {{ !empty($page->testimony_header) ? $page->testimony_header : 'Apa Kata Mereka' }}
                </h2>
                @if (!empty($page->testimony_sub_header) && $page->testimony_sub_header !== '.')
                    <p class="cnaf-testi-subtitle">{{ $page->testimony_sub_header }}</p>
                @endif
            </div>

            <div class="cnaf-testi-wrapper">
                <div class="cnaf-testi-viewport">
                    <div class="cnaf-testi-track" id="cnafTestiTrack">
                        @if (!empty($page->testimony_sliders) && count($page->testimony_sliders) > 0)
                            @foreach ($page->testimony_sliders as $slider)
                                <div class="cnaf-testi-card">
                                    <span class="cnaf-testi-quote-mark">“</span>
                                    <p class="cnaf-testi-text">"{{ $slider->content }}"</p>
                                    <div class="cnaf-testi-author-row">
                                        @if (!empty($slider->image))
                                            <img src="{{ url('storage/' . $slider->image) }}" alt="{{ $slider->title }}"
                                                class="cnaf-testi-avatar"
                                                onerror="this.onerror=null;this.style.display='none';this.nextElementSibling.style.display='flex';">
                                            <div class="cnaf-testi-avatar-placeholder" style="display: none;">👤</div>
                                        @else
                                            <div class="cnaf-testi-avatar-placeholder">👤</div>
                                        @endif
                                        <div class="cnaf-testi-author-info">
                                            <h4 class="cnaf-testi-author-name">{{ $slider->title }}</h4>
                                            <p class="cnaf-testi-author-role">{{ $slider->role }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Default High-Impact Testimonial Cards (Gadai Elektronik) -->
                            <div class="cnaf-testi-card">
                                <span class="cnaf-testi-quote-mark">“</span>
                                <p class="cnaf-testi-text">"Pertama kali gadai laptop kerja dan smartphone di Serba Gadai
                                    karena ada kebutuhan mendesak. Proses taksirannya transparan banget, cuma butuh waktu 10
                                    menit langsung cair ke rekening. Sangat terbantu!"</p>
                                <div class="cnaf-testi-author-row">
                                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80"
                                        alt="Nurul Iman" class="cnaf-testi-avatar"
                                        onerror="this.onerror=null;this.src='{{ url('serbamulia/assets/logo_shield.png') }}';">
                                    <div class="cnaf-testi-author-info">
                                        <h4 class="cnaf-testi-author-name">Nurul Iman</h4>
                                        <p class="cnaf-testi-author-role">Dosen / Akademisi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="cnaf-testi-card">
                                <span class="cnaf-testi-quote-mark">“</span>
                                <p class="cnaf-testi-text">"Kamera mirrorless dan lensa saya disimpan dengan sangat rapi
                                    dan disegel langsung di depan saya. Bunganya ringan dan bisa ditebus fleksibel. Tempat
                                    gadai elektronik paling terpercaya!"</p>
                                <div class="cnaf-testi-author-row">
                                    <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=150&auto=format&fit=crop&q=80"
                                        alt="Shinta P. Ramadhani" class="cnaf-testi-avatar"
                                        onerror="this.onerror=null;this.src='{{ url('serbamulia/assets/logo_shield.png') }}';">
                                    <div class="cnaf-testi-author-info">
                                        <h4 class="cnaf-testi-author-name">Shinta P. Ramadhani</h4>
                                        <p class="cnaf-testi-author-role">Content Creator / Wirausaha</p>
                                    </div>
                                </div>
                            </div>
                            <div class="cnaf-testi-card">
                                <span class="cnaf-testi-quote-mark">“</span>
                                <p class="cnaf-testi-text">"Rekomendasi dari teman sekantor untuk gadai MacBook. Awalnya
                                    ragu, tapi ternyata tempatnya nyaman, aman, dan diawasi resmi oleh OJK. Pelayanan
                                    stafnya juga ramah dan profesional."</p>
                                <div class="cnaf-testi-author-row">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80"
                                        alt="Adi Kurniawan" class="cnaf-testi-avatar"
                                        onerror="this.onerror=null;this.src='{{ url('serbamulia/assets/logo_shield.png') }}';">
                                    <div class="cnaf-testi-author-info">
                                        <h4 class="cnaf-testi-author-name">Adi Kurniawan</h4>
                                        <p class="cnaf-testi-author-role">Karyawan Swasta, Designer</p>
                                    </div>
                                </div>
                            </div>
                            <div class="cnaf-testi-card">
                                <span class="cnaf-testi-quote-mark">“</span>
                                <p class="cnaf-testi-text">"Gadai Smart TV 55 inch dan PlayStation 5 untuk keperluan modal
                                    tambahan usaha. Unit dicek bareng, packing aman, dan pencairan super kilat. Pasti akan
                                    balik lagi kalau butuh dana darurat!"</p>
                                <div class="cnaf-testi-author-row">
                                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&auto=format&fit=crop&q=80"
                                        alt="Budi Santoso" class="cnaf-testi-avatar"
                                        onerror="this.onerror=null;this.src='{{ url('serbamulia/assets/logo_shield.png') }}';">
                                    <div class="cnaf-testi-author-info">
                                        <h4 class="cnaf-testi-author-name">Budi Santoso</h4>
                                        <p class="cnaf-testi-author-role">Pelaku UMKM / Kuliner</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Floating Round Arrow Controls -->
                <button type="button" class="cnaf-testi-btn cnaf-testi-btn-prev" onclick="prevTestiCard()"
                    aria-label="Previous Testimonial">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
                <button type="button" class="cnaf-testi-btn cnaf-testi-btn-next" onclick="nextTestiCard()"
                    aria-label="Next Testimonial">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
            </div>
        </div>
    </section>


@endsection

@push('customJs')
    <script>
        (function() {
            let currentSlide = 0;
            const track = document.getElementById('cnafTrack');
            const slides = track ? track.querySelectorAll('.cnaf-slide-item') : [];
            const dotsContainer = document.getElementById('cnafDots');
            const slider = document.getElementById('cnafSlider');
            let autoSlideTimer = null;
            let touchStartX = 0;
            let touchEndX = 0;

            if (!track || slides.length === 0) return;

            // Build dots
            if (dotsContainer) {
                dotsContainer.innerHTML = '';
                slides.forEach((_, idx) => {
                    const dot = document.createElement('button');
                    dot.type = 'button';
                    dot.className = 'cnaf-dot' + (idx === 0 ? ' active' : '');
                    dot.setAttribute('aria-label', 'Slide ' + (idx + 1));
                    dot.addEventListener('click', () => goToSlide(idx));
                    dotsContainer.appendChild(dot);
                });
            }

            function updateSlider() {
                track.style.transform = `translateX(-${currentSlide * 100}%)`;
                if (dotsContainer) {
                    const dots = dotsContainer.querySelectorAll('.cnaf-dot');
                    dots.forEach((dot, idx) => {
                        dot.classList.toggle('active', idx === currentSlide);
                    });
                }
            }

            window.goToSlide = function(idx) {
                currentSlide = (idx + slides.length) % slides.length;
                updateSlider();
                resetAutoSlide();
            };

            window.nextCnafSlide = function() {
                goToSlide(currentSlide + 1);
            };

            window.prevCnafSlide = function() {
                goToSlide(currentSlide - 1);
            };

            function startAutoSlide() {
                if (autoSlideTimer) clearInterval(autoSlideTimer);
                autoSlideTimer = setInterval(() => {
                        goToSlide(currentSlide + 1);
                    }, 3000

                );
            }

            function resetAutoSlide() {
                startAutoSlide();
            }

            if (slider) {
                slider.addEventListener('mouseenter', () => clearInterval(autoSlideTimer));
                slider.addEventListener('mouseleave', () => startAutoSlide());

                // Touch events for mobile swiping (just like cnaf)
                slider.addEventListener('touchstart', (e) => {
                    touchStartX = e.changedTouches[0].screenX;
                }, {
                    passive: true
                });

                slider.addEventListener('touchend', (e) => {
                    touchEndX = e.changedTouches[0].screenX;
                    handleSwipe();
                }, {
                    passive: true
                });
            }

            function handleSwipe() {
                const swipeThreshold = 50;
                if (touchEndX < touchStartX - swipeThreshold) {
                    nextCnafSlide();
                } else if (touchEndX > touchStartX + swipeThreshold) {
                    prevCnafSlide();
                }
            }

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                const rect = slider ? slider.getBoundingClientRect() : null;
                if (rect && rect.top >= -200 && rect.bottom <= window.innerHeight + 200) {
                    if (e.key === 'ArrowLeft') prevCnafSlide();
                    if (e.key === 'ArrowRight') nextCnafSlide();
                }
            });

            startAutoSlide();
        })();

        // Apa Kata Mereka (Testimonials Slider)
        (function() {
            const track = document.getElementById('cnafTestiTrack');
            if (!track) return;

            let currentIndex = 0;
            let startX = 0;
            let endX = 0;

            function getVisibleCards() {
                if (window.innerWidth <= 640) return 1;
                if (window.innerWidth <= 991) return 2;
                return 3;
            }

            function updateTestiSlider() {
                const cards = track.querySelectorAll('.cnaf-testi-card');
                if (cards.length === 0) return;

                const visible = getVisibleCards();
                const maxIndex = Math.max(0, cards.length - visible);
                if (currentIndex > maxIndex) currentIndex = maxIndex;
                if (currentIndex < 0) currentIndex = 0;

                const cardWidth = cards[0].offsetWidth;
                const gap = 28;
                const moveAmount = currentIndex * (cardWidth + gap);

                track.style.transform = `translateX(-${moveAmount}px)`;
            }

            window.nextTestiCard = function() {
                const cards = track.querySelectorAll('.cnaf-testi-card');
                const visible = getVisibleCards();
                const maxIndex = Math.max(0, cards.length - visible);
                if (currentIndex >= maxIndex) {
                    currentIndex = 0;
                } else {
                    currentIndex++;
                }
                updateTestiSlider();
            };

            window.prevTestiCard = function() {
                const cards = track.querySelectorAll('.cnaf-testi-card');
                const visible = getVisibleCards();
                const maxIndex = Math.max(0, cards.length - visible);
                if (currentIndex <= 0) {
                    currentIndex = maxIndex;
                } else {
                    currentIndex--;
                }
                updateTestiSlider();
            };

            window.addEventListener('resize', updateTestiSlider);

            track.addEventListener('touchstart', (e) => {
                startX = e.changedTouches[0].screenX;
            }, {
                passive: true
            });

            track.addEventListener('touchend', (e) => {
                endX = e.changedTouches[0].screenX;
                if (endX < startX - 40) {
                    nextTestiCard();
                } else if (endX > startX + 40) {
                    prevTestiCard();
                }
            }, {
                passive: true
            });
        })();

        // CNAF Style Product Slider
        (function() {
            const track = document.getElementById('cnafProductTrack');
            if (!track) return;

            let currentIndex = 0;
            let startX = 0;
            let endX = 0;

            function getVisibleCards() {
                if (window.innerWidth <= 640) return 1;
                if (window.innerWidth <= 991) return 2;
                return 3;
            }

            function updateProductSlider() {
                const cards = track.querySelectorAll('.cnaf-product-card');
                if (cards.length === 0) return;

                const visible = getVisibleCards();
                const maxIndex = Math.max(0, cards.length - visible);
                if (currentIndex > maxIndex) currentIndex = maxIndex;
                if (currentIndex < 0) currentIndex = 0;

                const cardWidth = cards[0].offsetWidth;
                const gap = 24;
                const moveAmount = currentIndex * (cardWidth + gap);

                track.style.transform = `translateX(-${moveAmount}px)`;
            }

            window.nextProductCard = function() {
                const cards = track.querySelectorAll('.cnaf-product-card');
                const visible = getVisibleCards();
                const maxIndex = Math.max(0, cards.length - visible);
                if (currentIndex >= maxIndex) {
                    currentIndex = 0;
                } else {
                    currentIndex++;
                }
                updateProductSlider();
            };

            window.prevProductCard = function() {
                const cards = track.querySelectorAll('.cnaf-product-card');
                const visible = getVisibleCards();
                const maxIndex = Math.max(0, cards.length - visible);
                if (currentIndex <= 0) {
                    currentIndex = maxIndex;
                } else {
                    currentIndex--;
                }
                updateProductSlider();
            };

            window.addEventListener('resize', updateProductSlider);

            track.addEventListener('touchstart', (e) => {
                startX = e.changedTouches[0].screenX;
            }, {
                passive: true
            });

            track.addEventListener('touchend', (e) => {
                endX = e.changedTouches[0].screenX;
                if (endX < startX - 40) {
                    nextProductCard();
                } else if (endX > startX + 40) {
                    prevProductCard();
                }
            }, {
                passive: true
            });
        })();
    </script>
@endpush
