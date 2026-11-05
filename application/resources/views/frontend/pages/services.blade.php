@extends('frontend.layouts.template')

@section('pageTitle', 'Produk & Layanan')

@section('content')
@php
    $waNumber = preg_replace('/[^0-9]/', '', @$CONF->whatsapp ?: '6281181126771');
@endphp

<!-- Subpage Hero Section -->
<section class="subhero-section">
    <div class="container">
        <span class="section-badge">LAYANAN</span>
        <h1 class="subhero-title">{{ @$product_config->menu_title ?? 'Produk & Layanan Kami' }}</h1>
        <p class="subhero-subtitle">{{ @$product_config->menu_short_description ?? 'Kami menyediakan solusi pendanaan cepat dengan jaminan emas dan barang elektronik yang dinilai secara transparan & tepercaya.' }}</p>
    </div>
</section>

<!-- Services Details Section -->
<section class="page-content-section">
    <div class="container">
        @if(!empty($products) && count($products) > 0)
            @foreach($products as $idx => $product)
                @php
                    $isReverse = ($idx % 2 == 1);
                    $fallbackAsset = ($idx % 2 == 0) ? url('serbamulia/assets/emas.jpg') : url('serbamulia/assets/elektronik.jpg');
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
        @endif
    </div>
</section>
@endsection

