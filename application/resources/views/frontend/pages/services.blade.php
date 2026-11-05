@extends('frontend.layouts.template')

@section('pageTitle', 'Produk & Layanan')

@section('content')
@php
    $waNumber = preg_replace('/[^0-9]/', '', @$CONF->whatsapp ?: '6281181126771');
@endphp

<!-- Subpage Hero Section -->
<section class="subhero-section">
    <div class="container">
        <span class="section-badge">LAYANAN GADAI ELEKTRONIK</span>
        <h1 class="subhero-title">Layanan <span class="gold-text">Gadai Elektronik</span></h1>
        <p class="subhero-subtitle">Kami menyediakan solusi pendanaan cepat khusus jaminan barang elektronik (Smartphone, Laptop, Kamera, TV, & Gadget) yang dinilai secara transparan & tepercaya.</p>
    </div>
</section>

<!-- Services Details Section -->
<section class="page-content-section">
    <div class="container">
        @if(!empty($products) && count($products) > 0)
            @foreach($products as $idx => $product)
                @php
                    $isReverse = ($idx % 2 == 1);
                    $fallbackAsset = url('serbamulia/assets/elektronik.jpg');
                    $prodImg = !empty($product->image) ? url('storage/'.$product->image) : (!empty($product->icon) ? url('storage/'.$product->icon) : $fallbackAsset);
                    $advantages = !empty($product->advantages) ? json_decode($product->advantages) : [];
                @endphp
                <div class="service-detail-card {{ $isReverse ? 'reverse' : '' }}" id="{{ $product->slug }}">
                    <div class="service-detail-grid-row">
                        @if($isReverse)
                            <div class="service-image-box">
                                <img src="{{ $prodImg }}" onerror="this.onerror=null;this.src='{{ $fallbackAsset }}';" alt="{{ $product->title }}" class="service-image">
                            </div>
                        @endif

                        <div class="service-text-box">
                            <span class="gold-text-badge">PRODUK UNGGULAN</span>
                            <h2>{{ $idx + 1 }}. {{ $product->title }}</h2>
                            <div class="section-text cms-rich-content">
                                {!! !empty($product->description) ? $product->description : '<p>'.$product->short_description.'</p>' !!}
                            </div>
                            
                            @if(!empty($advantages) && is_array($advantages))
                                <div class="service-features-grid">
                                    @foreach(array_slice($advantages, 0, 4) as $advIdx => $adv)
                                        @if(!empty($adv->text))
                                            <div class="s-feature">
                                                <strong>Keunggulan {{ $advIdx + 1 }}</strong>
                                                <p>{{ $adv->text }}</p>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                            <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 24px;">
                                <a href="{{ route('product.detail', ['slug' => $product->slug]) }}" class="btn btn-outline">Syarat & Tabel Pricing →</a>
                                <a href="{{ !empty($product->call_action) ? $product->call_action : 'https://api.whatsapp.com/send?phone='.$waNumber.'&text=Halo%20Admin%20Gadai%20Mulia,%20saya%20ingin%20tanya%20'.urlencode($product->title) }}" target="_blank" class="btn btn-primary">Ajukan Sekarang</a>
                            </div>
                        </div>

                        @if(!$isReverse)
                            <div class="service-image-box">
                                <img src="{{ $prodImg }}" onerror="this.onerror=null;this.src='{{ $fallbackAsset }}';" alt="{{ $product->title }}" class="service-image">
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="service-detail-card">
                <div class="service-detail-grid-row">
                    <div class="service-text-box">
                        <span class="gold-text-badge">LAYANAN UTAMA</span>
                        <h2>1. Gadai Smartphone & Tablet</h2>
                        <div class="section-text cms-rich-content">
                            <p>Dapatkan pinjaman dana tunai cepat dengan menjaminkan Smartphone (iPhone, Samsung Galaxy, Oppo, Vivo, Xiaomi, dll.) atau Tablet/iPad Anda. Proses pengecekan transparan, privasi data terjaga, dan unit disegel aman.</p>
                        </div>
                        <div class="service-features-grid">
                            <div class="s-feature">
                                <strong>Taksiran Tinggi</strong>
                                <p>Penilaian objektif mengikuti harga pasar terkini.</p>
                            </div>
                            <div class="s-feature">
                                <strong>Privasi & Segel Aman</strong>
                                <p>Unit disimpan dalam kondisi mati, disegel, dan diasuransikan.</p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 24px;">
                            <a href="{{ route('simulasi') }}" class="btn btn-outline">Hitung Simulasi →</a>
                            <a href="https://api.whatsapp.com/send?phone={{ $waNumber }}&text=Halo%20Serba%20Gadai,%20saya%20ingin%20tanya%20Gadai%20Smartphone" target="_blank" class="btn btn-primary">Ajukan Sekarang</a>
                        </div>
                    </div>
                    <div class="service-image-box">
                        <img src="{{ url('serbamulia/assets/elektronik.jpg') }}" alt="Gadai Smartphone & Tablet" class="service-image">
                    </div>
                </div>
            </div>

            <div class="service-detail-card reverse">
                <div class="service-detail-grid-row">
                    <div class="service-image-box">
                        <img src="{{ url('serbamulia/assets/elektronik.jpg') }}" alt="Gadai Laptop & Kamera" class="service-image">
                    </div>
                    <div class="service-text-box">
                        <span class="gold-text-badge">LAYANAN UNGGULAN</span>
                        <h2>2. Gadai Laptop, Kamera, TV & Gadget</h2>
                        <div class="section-text cms-rich-content">
                            <p>Solusi dana cepat untuk kebutuhan mendesak maupun modal usaha dengan jaminan MacBook, Laptop Gaming/Kerja, Kamera Mirrorless/DSLR, Smart TV LED, hingga Konsol Game (PS5 / Nintendo Switch).</p>
                        </div>
                        <div class="service-features-grid">
                            <div class="s-feature">
                                <strong>Cair ± 8 Menit</strong>
                                <p>Proses verifikasi singkat cukup dengan KTP asli.</p>
                            </div>
                            <div class="s-feature">
                                <strong>Ruang Penyimpanan Khusus</strong>
                                <p>Bebas lembap, berstandar keamanan tinggi & diawasi CCTV 24 jam.</p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 24px;">
                            <a href="{{ route('simulasi') }}" class="btn btn-outline">Hitung Simulasi →</a>
                            <a href="https://api.whatsapp.com/send?phone={{ $waNumber }}&text=Halo%20Serba%20Gadai,%20saya%20ingin%20tanya%20Gadai%20Laptop%20dan%20Elektronik" target="_blank" class="btn btn-primary">Ajukan Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

