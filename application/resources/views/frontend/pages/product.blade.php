@extends('frontend.layouts.template')

@section('pageTitle', $product->title)

@section('content')
@php
    $waNumber = preg_replace('/[^0-9]/', '', @$CONF->whatsapp ?: '6281181126771');
    $prodImg = !empty($product->image) ? url('storage/'.$product->image) : url('serbamulia/assets/emas.jpg');
    $advantages = !empty($product->advantages) ? json_decode($product->advantages) : [];
@endphp

<!-- Subpage Hero Section -->
<section class="subhero-section">
    <div class="container">
        <span class="section-badge">PRODUK & LAYANAN</span>
        <h1 class="subhero-title">{{ $product->title }}</h1>
        <p class="subhero-subtitle">{{ $product->short_description }}</p>
    </div>
</section>

<!-- Product Overview & Advantages -->
<section class="page-content-section">
    <div class="container">
        <div class="service-detail-card">
            <div class="service-detail-grid-row">
                <div class="service-text-box">
                    <span class="gold-text-badge">DESKRIPSI LAYANAN</span>
                    <h2>{{ $product->title }}</h2>
                    <div class="cms-rich-content text-justify">
                        {!! $product->description !!}
                    </div>
                    <div style="margin-top: 28px;">
                        <a href="{{ !empty($product->call_action) ? $product->call_action : 'https://api.whatsapp.com/send?phone='.$waNumber.'&text=Halo%20Admin,%20saya%20tertarik%20mengajukan%20'.urlencode($product->title) }}" target="_blank" class="btn btn-primary">Ajukan {{ $product->title }} Sekarang</a>
                    </div>
                </div>
                <div class="service-image-box">
                    <img src="{{ $prodImg }}" onerror="this.onerror=null;this.src='{{ url('serbamulia/assets/emas.jpg') }}';" alt="{{ $product->title }}" class="service-image">
                </div>
            </div>
        </div>

        <!-- Keunggulan -->
        @if(!empty($advantages) && is_array($advantages))
        <div style="margin-bottom: 64px;">
            <div class="section-header-center" style="margin-bottom: 36px;">
                <span class="section-badge center">KEUNGGULAN</span>
                <h2 class="section-title-dark text-center">Keunggulan {{ $product->title }}</h2>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
                @foreach($advantages as $advantage)
                    @if(!empty($advantage->text))
                    <div class="o-card" style="display: flex; align-items: flex-start; gap: 16px; padding: 24px;">
                        <div class="feature-icon-wrapper" style="width: 40px; height: 40px;">
                            <span style="color: var(--primary); font-weight: 800;">✓</span>
                        </div>
                        <p style="color: var(--text-main); font-size: 15px; margin: 0;">{{ $advantage->text }}</p>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

        <!-- Persyaratan & Pricing -->
        <div class="about-detail-grid" style="grid-template-columns: 0.9fr 1.1fr;">
            <div class="premium-about-card">
                <h3>Persyaratan Pengajuan</h3>
                <div class="cms-rich-content">
                    {!! $product->terms !!}
                </div>
            </div>
            <div>
                <h3 class="section-title-dark" style="font-size: 28px; margin-bottom: 20px;">Pricing & Skema Produk</h3>
                <div class="cms-table-wrapper pricing">
                    {!! $product->pricing !!}
                </div>
            </div>
        </div>

        <!-- Call to Action Banner -->
        <div class="service-detail-card" style="margin-top: 64px; margin-bottom: 0; background: linear-gradient(135deg, rgba(245, 158, 11, 0.15) 0%, var(--bg-secondary) 100%); border-color: rgba(245, 158, 11, 0.3); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 24px;">
            <div>
                <span class="gold-text-badge">BUTUH DANA CEPAT?</span>
                <h3 style="font-family: var(--font-heading); font-size: 28px; font-weight: 800; margin-bottom: 8px;">Dapatkan Dana Tunai Sekarang di {{ @$CONF->title ?? 'Gadai Mulia' }}!</h3>
                <p style="color: var(--text-muted); font-size: 15px;">Proses transparan, aman, dan diawasi langsung oleh Otoritas Jasa Keuangan (OJK).</p>
            </div>
            <a href="{{ !empty($product->call_action) ? $product->call_action : 'https://api.whatsapp.com/send?phone='.$waNumber.'&text=Halo%20Admin,%20saya%20ingin%20mengajukan%20'.urlencode($product->title) }}" target="_blank" class="btn btn-primary">Ajukan Sekarang →</a>
        </div>
    </div>
</section>
@endsection
