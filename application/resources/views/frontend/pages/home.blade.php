@extends('frontend.layouts.template')

@section('pageTitle', 'Beranda')

@section('content')
@php
    $waNumber = preg_replace('/[^0-9]/', '', @$CONF->whatsapp ?: '6281181126771');
    $heroBg = !empty($page->hero_background) ? url('storage/'.$page->hero_background) : url('serbamulia/assets/hero_bg.jpg');
    $heroTitle = (!empty($page->hero_header) && trim($page->hero_header) !== '.')
        ? $page->hero_header
        : 'Solusi Keuangan Cepat, <br><span class="gradient-text">Aman & Transparan</span>';
    $heroSub = (!empty($page->hero_sub_header) && trim($page->hero_sub_header) !== '.')
        ? $page->hero_sub_header
        : 'Gadaikan Emas, Logam Mulia, atau Barang Elektronik Anda dengan nilai pencairan tinggi hingga 100%, sewa modal rendah, dan tanpa proses berbelit-belit.';
    $aboutImg = !empty($page->about_image) ? url('storage/'.$page->about_image) : url('serbamulia/assets/emas.jpg');
@endphp

<!-- Hero Section -->
<section class="hero-section" id="hero">
    <div class="hero-bg" style="background-image: url('{{ $heroBg }}'), url('{{ url('serbamulia/assets/hero_bg.jpg') }}');"></div>
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <div class="hero-text-side">
            <div class="badge-ojk">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L3 7V12C3 16.5 6.8 20.7 12 22C17.2 20.7 21 16.5 21 12V7L12 2Z" fill="#F59E0B" />
                    <path d="M9 12L11 14L15 10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Berizin & Diawasi oleh OJK</span>
            </div>
            <h1 class="hero-title">{!! $heroTitle !!}</h1>
            <p class="hero-subtitle">{!! $heroSub !!}</p>
            <div class="hero-features">
                <div class="hero-feature-item">
                    <span class="feature-icon">✓</span>
                    <span>Syarat Cukup KTP</span>
                </div>
                <div class="hero-feature-item">
                    <span class="feature-icon">✓</span>
                    <span>Asuransi Jiwa & Barang</span>
                </div>
                <div class="hero-feature-item">
                    <span class="feature-icon">✓</span>
                    <span>Sewa Modal Mulai 1.15%</span>
                </div>
            </div>
            <div class="hero-buttons">
                <a href="{{ route('simulasi') }}" class="btn btn-primary">Simulasi Gadai</a>
                @if(!empty($page->hero_action) && $page->hero_action !== '#')
                    <a href="{{ $page->hero_action }}" target="_blank" class="btn btn-secondary">Ajukan Sekarang</a>
                @else
                    <a href="#layanan" class="btn btn-secondary">Pelajari Layanan</a>
                @endif
            </div>
        </div>

        <!-- Hero Right Visual Showcase (CMS Hero Sliders / Visual Highlight Card) -->
        <div class="why-image-side">
            <div class="neon-card-glow"></div>
            <div class="info-showcase-card" style="padding: 28px;">
                @if(!empty($page->hero_sliders) && count($page->hero_sliders) > 0)
                    @php
                        $firstSlide = $page->hero_sliders[0];
                        $slideImg = !empty($firstSlide->image) ? url('storage/'.$firstSlide->image) : url('serbamulia/assets/emas.jpg');
                    @endphp
                    <div style="border-radius: var(--radius-md); overflow: hidden; margin-bottom: 20px; height: 240px; position: relative;">
                        <img src="{{ $slideImg }}" onerror="this.onerror=null;this.src='{{ url('serbamulia/assets/emas.jpg') }}';" alt="{{ $firstSlide->title ?? 'Gadai Mulia' }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                @else
                    <div style="border-radius: var(--radius-md); overflow: hidden; margin-bottom: 20px; height: 220px; position: relative;">
                        <img src="{{ url('serbamulia/assets/emas.jpg') }}" alt="Gadai Emas & Elektronik" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                @endif

                <div class="showcase-body" style="margin-bottom: 20px;">
                    <div class="showcase-row">
                        <span>Pencairan Pinjaman</span>
                        <span class="highlight-gold">Hingga 100% Taksiran</span>
                    </div>
                    <div class="showcase-row">
                        <span>Waktu Pencairan</span>
                        <span class="highlight-green">± 8 Menit Cair</span>
                    </div>
                    <div class="showcase-row">
                        <span>Keamanan Jaminan</span>
                        <span class="highlight-blue">100% Diasuransikan</span>
                    </div>
                </div>

                <a href="{{ route('simulasi') }}" class="btn btn-primary btn-block">
                    Hitung Simulasi Taksiran →
                </a>
            </div>
        </div>
    </div>
</section>

<!-- OJK and Trust Banner -->
<section class="trust-banner">
    <div class="container trust-container">
        <span class="trust-label">DISETUJUI & DIAWASI OLEH</span>
        <div class="trust-logos">
            <span class="ojk-logo-text">OJK</span>
            <span class="logo-divider">|</span>
            <span class="insurance-badge">Barang Jaminan 100% Aman & Diasuransikan</span>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section" id="tentang">
    <div class="container about-grid">
        <div class="about-image-side">
            <img src="{{ $aboutImg }}" onerror="this.onerror=null;this.src='{{ url('serbamulia/assets/emas.jpg') }}';" alt="Tentang {{ @$CONF->title ?? 'Gadai Mulia' }}" class="about-img">
            <div class="glowing-border-decoration"></div>
        </div>
        <div class="about-text-side">
            <span class="section-badge">SIAPA KAMI</span>
            <h2 class="section-title-dark">{{ !empty($page->about_title) ? $page->about_title : 'Mitra Terpercaya Solusi Finansial Anda' }}</h2>
            <p class="section-desc text-justify">{{ !empty($page->about_content) ? $page->about_content : 'Gadai Mulia berdiri sejak Agustus 2018 sebagai Perusahaan Pergadaian Swasta resmi berizin OJK. Kami melayani wilayah DKI Jakarta, Jawa Barat, dan Kepulauan Riau.' }}</p>
            
            <div class="stats-grid" style="margin-bottom: 28px;">
                <div class="stat-card">
                    <h4 class="stat-number">2018</h4>
                    <p class="stat-label">Tahun Berdiri</p>
                </div>
                <div class="stat-card">
                    <h4 class="stat-number">10k+</h4>
                    <p class="stat-label">Nasabah Puas</p>
                </div>
                <div class="stat-card">
                    <h4 class="stat-number">100%</h4>
                    <p class="stat-label">Barang Diasuransikan</p>
                </div>
            </div>

            <a href="{{ route('about') }}" class="btn btn-outline">Selengkapnya →</a>
        </div>
    </div>
</section>

<!-- Products & Services -->
<section class="products-section" id="layanan">
    <div class="container">
        <div class="section-header-center">
            <span class="section-badge center">LAYANAN KAMI</span>
            <h2 class="section-title-dark text-center">{{ !empty($page->product_title) ? $page->product_title : 'Pilihan Produk Gadai yang Sesuai Kebutuhan Anda' }}</h2>
            <p class="section-desc-center text-center">{{ !empty($page->product_sub_title) ? $page->product_sub_title : 'Kami menawarkan berbagai pilihan produk gadai fleksibel dengan penaksiran yang adil dan transparan.' }}</p>
        </div>

        <div class="products-grid">
            @if(!empty($products) && count($products) > 0)
                @foreach($products as $idx => $product)
                    @php
                        $fallbackAsset = ($idx % 2 == 0) ? url('serbamulia/assets/emas.jpg') : url('serbamulia/assets/elektronik.jpg');
                        $prodImg = !empty($product->image) ? url('storage/'.$product->image) : (!empty($product->icon) ? url('storage/'.$product->icon) : $fallbackAsset);
                        $advantages = !empty($product->advantages) ? json_decode($product->advantages) : [];
                    @endphp
                    <div class="product-card">
                        <div class="product-img-wrapper">
                            <img src="{{ $prodImg }}" onerror="this.onerror=null;this.src='{{ $fallbackAsset }}';" alt="{{ $product->title }}" class="product-img">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">{{ $product->title }}</h3>
                            <p class="product-desc">{{ $product->short_description }}</p>
                            @if(!empty($advantages) && is_array($advantages))
                                <ul class="product-features">
                                    @foreach(array_slice($advantages, 0, 3) as $adv)
                                        @if(!empty($adv->text))
                                            <li>{{ \Illuminate\Support\Str::limit($adv->text, 65) }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                            <div style="display: flex; gap: 10px; margin-top: auto;">
                                <a href="{{ route('product.detail', ['slug' => $product->slug]) }}" class="btn btn-outline btn-sm" style="flex: 1;">Lihat Detail</a>
                                <a href="{{ !empty($product->call_action) ? $product->call_action : 'https://api.whatsapp.com/send?phone='.$waNumber.'&text=Halo%20Gadai%20Mulia%20saya%20tertarik%20dengan%20'.urlencode($product->title) }}" target="_blank" class="btn btn-primary btn-sm" style="flex: 1;">Ajukan</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Default fallback cards if CMS products empty -->
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <img src="{{ url('serbamulia/assets/emas.jpg') }}" alt="Gadai Emas" class="product-img">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">Gadai Emas / Logam Mulia</h3>
                        <p class="product-desc">Pinjaman dana cepat dengan jaminan emas perhiasan atau logam mulia. Penaksiran nilai emas tinggi sesuai harga pasar harian resmi.</p>
                        <ul class="product-features">
                            <li>LTV hingga 100% nilai emas</li>
                            <li>Bunga flat & kompetitif</li>
                            <li>Penyimpanan aman di deposit box</li>
                        </ul>
                        <a href="https://api.whatsapp.com/send?phone={{ $waNumber }}&text=Halo%20Gadai%20Mulia%20saya%20tertarik%20dengan%20Gadai%20Emas" target="_blank" class="btn btn-outline btn-sm">Hubungi Kami</a>
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
                <h2 class="section-title-light">Mengapa Ribuan Nasabah Memilih {{ @$CONF->title ?? 'Gadai Mulia' }}?</h2>
                <p class="section-desc-light">Kami berkomitmen memberikan pelayanan terbaik dengan integritas tinggi dan transparansi penuh untuk seluruh nasabah kami.</p>
                
                <div class="features-list">
                    @if(!empty($page->why_us) && count($page->why_us) > 0)
                        @foreach($page->why_us as $item)
                            <div class="feature-card">
                                <div class="feature-icon-wrapper">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2L3 7V12C3 16.5 6.8 20.7 12 22C17.2 20.7 21 16.5 21 12V7L12 2Z" fill="#F59E0B"/>
                                        <path d="M9 12L11 14L15 10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM13 17H11V11H13V17ZM13 9H11V7H13V9Z" fill="#F59E0B"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="feature-title">Pencairan Tinggi, Biaya Murah</h4>
                                <p class="feature-desc-text">Nilai taksiran barang berharga Anda dinilai seadil mungkin untuk mendapatkan pinjaman maksimal.</p>
                            </div>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon-wrapper">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 8H17V6C17 3.24 14.76 1 12 1C9.24 1 7 3.24 7 6V8H6C4.9 8 4 8.9 4 10V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V10C20 8.9 19.1 8 18 8ZM12 17C10.9 17 10 16.1 10 15C10 13.9 10.9 13 12 13C13.1 13 14 13.9 14 15C14 16.1 13.1 17 12 17ZM15.1 8H8.9V6C8.9 4.29 10.29 2.9 12 2.9C13.71 2.9 15.1 4.29 15.1 6V8Z" fill="#F59E0B"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="feature-title">Keamanan Jaminan 100%</h4>
                                <p class="feature-desc-text">Barang jaminan disimpan di lemari besi khusus berstandar keamanan tinggi dan sepenuhnya diasuransikan.</p>
                            </div>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon-wrapper">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM16.2 16.2L11 13V7H12.5V12.2L17 14.9L16.2 16.2Z" fill="#F59E0B"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="feature-title">Syarat Mudah & Instan</h4>
                                <p class="feature-desc-text">Hanya butuh KTP dan barang jaminan. Proses cepat, uang langsung cair di tempat dalam hitungan menit.</p>
                            </div>
                        </div>
                    @endif
                </div>
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
    </div>
</section>

<!-- Testimonials -->
<section class="testi-section" id="testimoni">
    <div class="container">
        <div class="section-header-center">
            <span class="section-badge center">TESTIMONI</span>
            <h2 class="section-title-dark text-center">{{ !empty($page->testimony_header) ? $page->testimony_header : 'Apa Kata Mereka Tentang Kami?' }}</h2>
            <p class="section-desc-center text-center">{{ !empty($page->testimony_sub_header) ? $page->testimony_sub_header : 'Dengarkan pengalaman nyata nasabah kami yang telah merasakan kemudahan dan keamanan bertransaksi bersama Gadai Mulia.' }}</p>
        </div>

        <div class="testi-slider-wrapper">
            <div class="testi-slider" id="testi-container">
                @if(!empty($page->testimony_sliders) && count($page->testimony_sliders) > 0)
                    @foreach($page->testimony_sliders as $slider)
                        <div class="testi-card">
                            <div class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= ($slider->star ?? 5) ? '★' : '☆' }}
                                @endfor
                            </div>
                            <p class="testi-text">"{{ $slider->content }}"</p>
                            <div class="testi-author">
                                <div class="author-avatar">💬</div>
                                <div>
                                    <h4 class="author-name">{{ $slider->title }}</h4>
                                    <p class="author-role">{{ $slider->role }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="testi-card">
                        <div class="stars">★★★★★</div>
                        <p class="testi-text">"Terima kasih Gadai Mulia, sudah membantu keuangan saya saat darurat modal usaha. Pelayanannya sangat profesional, cepat, dan saya dapat hadiah magic com juga. Sukses selalu!"</p>
                        <div class="testi-author">
                            <div class="author-avatar">👩</div>
                            <div>
                                <h4 class="author-name">Dini Gianti</h4>
                                <p class="author-role">Ibu Rumah Tangga / Wiraswasta</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Controls -->
            <div class="slider-controls">
                <button class="control-btn prev" onclick="slideTesti('prev')">←</button>
                <button class="control-btn next" onclick="slideTesti('next')">→</button>
            </div>
        </div>
    </div>
</section>

<!-- Promo Highlight Section -->
@if(!empty($promos) && count($promos) > 0)
<section class="page-content-section" id="promo-home">
    <div class="container">
        <div class="section-header-center">
            <span class="section-badge center">PROMO SPESIAL</span>
            <h2 class="section-title-dark text-center">Penawaran & Promo Terbaru</h2>
            <p class="section-desc-center text-center">Nikmati berbagai keuntungan ekstra dan program promo menarik dari {{ @$CONF->title ?? 'Gadai Mulia' }}.</p>
        </div>

        <div class="promo-grid">
            @foreach($promos->take(3) as $promo)
                <div class="p-card">
                    <div class="p-card-tag active">PROMO AKTIF</div>
                    <div class="p-card-img-wrapper">
                        <img src="{{ url('storage/'.$promo->image) }}" alt="{{ $promo->title ?? 'Promo' }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                        <div class="gradient-fallback-img p-fallback" style="display: none;">
                            <span class="p-icon">🎁</span>
                        </div>
                    </div>
                    <div class="p-card-content">
                        <span class="p-date">Sampai {{ \Carbon\Carbon::parse($promo->valid_date)->format('d F Y') }}</span>
                        <h3 class="p-title">{{ !empty($promo->title) ? $promo->title : 'Promo Spesial Gadai Mulia' }}</h3>
                        <a href="{{ !empty($promo->action_link) ? $promo->action_link : 'https://api.whatsapp.com/send?phone='.$waNumber.'&text=Halo%20Admin,%20saya%20ingin%20klaim%20promo%20'.urlencode($promo->title ?? 'Gadai Mulia') }}" target="_blank" class="btn btn-primary btn-block" style="margin-top: auto;">Ajukan Sekarang</a>
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
            <h2 class="section-title-dark text-center">Temukan Lokasi <span class="gold-text">Cabang Terdekat</span></h2>
            <p class="section-desc-center text-center">Gunakan peta interaktif atau fitur deteksi lokasi untuk menemukan cabang resmi {{ @$CONF->title ?? 'Gadai Mulia' }} terdekat dari tempat Anda.</p>
        </div>

        @include('frontend.pages.part.branch-locator')
    </div>
</section>

@endsection
