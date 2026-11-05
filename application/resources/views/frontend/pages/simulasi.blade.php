@extends('frontend.layouts.template')

@section('pageTitle', 'Simulasi Taksiran Gadai')

@section('content')
@php
    $waNumber = preg_replace('/[^0-9]/', '', @$CONF->whatsapp ?: '6281181126771');
@endphp

<!-- Subpage Hero Section -->
<section class="subhero-section">
    <div class="container">
        <span class="section-badge">KALKULATOR GADAI</span>
        <h1 class="subhero-title">Hitung <span class="gold-text">Simulasi Taksiran</span></h1>
        <p class="subhero-subtitle">Hitung estimasi nilai pencairan pinjaman, sewa modal, dan biaya administrasi untuk jaminan Emas / Logam Mulia maupun Barang Elektronik Anda secara instan & transparan.</p>
    </div>
</section>

<!-- Main Calculator & Info Section -->
<section class="page-content-section">
    <div class="container">
        <div class="about-detail-grid" style="grid-template-columns: 1.1fr 0.9fr; align-items: start; gap: 48px;">
            <!-- Interactive Calculator Widget -->
            <div class="calculator-card-wrapper" id="kalkulator">
                <div class="calculator-card">
                    <h3 class="calc-title">Simulasi Nilai Taksiran</h3>
                    <p class="calc-desc">Pilih kategori barang jaminan Anda dan sesuaikan parameter di bawah ini</p>
                    
                    <div class="calc-tabs">
                        <button class="calc-tab active" id="tab-emas" onclick="switchTab('emas')">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="tab-icon">
                                <rect x="2" y="7" width="20" height="10" rx="2" fill="currentColor"/>
                                <path d="M6 12H18" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            Emas / LM
                        </button>
                        <button class="calc-tab" id="tab-elektronik" onclick="switchTab('elektronik')">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="tab-icon">
                                <rect x="5" y="2" width="14" height="20" rx="3" stroke="currentColor" stroke-width="2"/>
                                <circle cx="12" cy="18" r="1.5" fill="currentColor"/>
                            </svg>
                            Elektronik
                        </button>
                    </div>

                    <!-- Emas Form -->
                    <div class="calc-form" id="form-emas">
                        <div class="input-group">
                            <label class="input-label">Jenis Emas / Purity</label>
                            <select class="input-select" id="emas-karat" onchange="calculateGold()">
                                <option value="24">Logam Mulia / Emas 24 Karat (99.9%)</option>
                                <option value="22">Emas Perhiasan 22 Karat (91.6%)</option>
                                <option value="18">Emas Perhiasan 18 Karat (75.0%)</option>
                                <option value="16">Emas Perhiasan 16 Karat (70.0%)</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <div class="label-row">
                                <label class="input-label">Berat Emas</label>
                                <span class="range-val"><span id="gold-weight-txt">10</span> gram</span>
                            </div>
                            <input type="range" class="input-range" id="emas-berat" min="1" max="100" value="10" step="1" oninput="updateRangeText('gold-weight-txt', this.value); calculateGold();">
                        </div>
                    </div>

                    <!-- Elektronik Form (Hidden by default) -->
                    <div class="calc-form hidden" id="form-elektronik">
                        <div class="input-group">
                            <label class="input-label">Jenis Barang Elektronik</label>
                            <select class="input-select" id="elektronik-jenis" onchange="calculateElectronics()">
                                <option value="smartphone">Smartphone Flagship (iPhone/Samsung S)</option>
                                <option value="laptop">Laptop / MacBook</option>
                                <option value="camera">Kamera DSLR / Mirrorless</option>
                                <option value="tv">TV LED / Game Console</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label class="input-label">Kondisi Fisik & Fungsi</label>
                            <select class="input-select" id="elektronik-kondisi" onchange="calculateElectronics()">
                                <option value="1.0">Mulus & Lengkap (Like New, Dus ada)</option>
                                <option value="0.8">Fungsi Normal (Fisik standard pemakaian)</option>
                                <option value="0.6">Batangan / Tanpa Box (Hanya Charger)</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <div class="label-row">
                                <label class="input-label">Estimasi Harga Beli Awal</label>
                                <span class="range-val">Rp <span id="price-txt">10.000.000</span></span>
                            </div>
                            <input type="range" class="input-range" id="elektronik-harga" min="1000000" max="30000000" value="10000000" step="500000" oninput="updatePriceText(this.value); calculateElectronics();">
                        </div>
                    </div>

                    <!-- Calculation Output -->
                    <div class="calc-results">
                        <div class="result-row highlight">
                            <span class="result-label">Taksiran Pinjaman</span>
                            <span class="result-value" id="taksiran-pinjaman">Rp 10.450.000</span>
                        </div>
                        <div class="result-divider"></div>
                        <div class="result-row">
                            <span class="result-label-sub">Sewa Modal (15 hari)</span>
                            <span class="result-value-sub" id="sewa-modal">Rp 120.175</span>
                        </div>
                        <div class="result-row">
                            <span class="result-label-sub">Biaya Administrasi</span>
                            <span class="result-value-sub" id="biaya-admin">Rp 35.000</span>
                        </div>
                    </div>

                    <a href="https://api.whatsapp.com/send?phone={{ $waNumber }}" id="wa-submit-btn" target="_blank" class="btn btn-primary btn-block calc-btn">
                        <span>Ajukan Hasil Simulasi Via WhatsApp</span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM16.59 14.59L13.59 17.59C13.2 17.98 12.57 17.98 12.18 17.59L9.18 14.59C8.79 14.2 8.79 13.57 9.18 13.18L10.59 11.77L8.7 9.88C8.31 9.49 8.31 8.86 8.7 8.47L10.12 7.05C10.51 6.66 11.14 6.66 11.53 7.05L12.95 8.47C13.34 8.86 13.34 9.49 12.95 9.88L12 10.83C12.35 11.45 12.9 12 13.52 12.35L14.47 11.4C14.86 11.01 15.49 11.01 15.88 11.4L17.3 12.82C17.69 13.21 17.69 13.84 17.3 14.23L16.59 14.59Z" fill="currentColor"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Right Side Information & Steps -->
            <div style="display: flex; flex-direction: column; gap: 24px;">
                <div class="premium-about-card">
                    <span class="section-badge">PANDUAN CEPAT</span>
                    <h3 style="margin-top: 8px; margin-bottom: 16px;">3 Langkah Mudah Cairkan Dana</h3>
                    <div class="features-list" style="gap: 16px;">
                        <div class="feature-card">
                            <div class="feature-icon-wrapper">
                                <span style="font-weight: 800; color: var(--primary); font-size: 16px;">1</span>
                            </div>
                            <div>
                                <h4 class="feature-title">Hitung Estimasi Taksiran</h4>
                                <p class="feature-desc-text">Gunakan kalkulator di samping untuk mengetahui estimasi pinjaman dan sewa modal sesuai barang jaminan Anda.</p>
                            </div>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon-wrapper">
                                <span style="font-weight: 800; color: var(--primary); font-size: 16px;">2</span>
                            </div>
                            <div>
                                <h4 class="feature-title">Kunjungi Cabang / Hubungi WhatsApp</h4>
                                <p class="feature-desc-text">Bawa KTP asli dan barang jaminan Anda ke outlet resmi terdekat untuk pengecekan fisik oleh penaksir berpengalaman.</p>
                            </div>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon-wrapper">
                                <span style="font-weight: 800; color: var(--primary); font-size: 16px;">3</span>
                            </div>
                            <div>
                                <h4 class="feature-title">Dana Langsung Cair (± 8 Menit)</h4>
                                <p class="feature-desc-text">Setelah disepakati, dana langsung cair tunai atau transfer ke rekening Anda. Barang disimpan aman & diasuransikan 100%.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="o-card" style="padding: 28px;">
                    <h4 style="font-family: var(--font-heading); font-size: 18px; font-weight: 700; margin-bottom: 10px; color: var(--text-main);">📌 Catatan Simulasi</h4>
                    <ul style="list-style: none; padding: 0; margin: 0 0 20px 0; display: flex; flex-direction: column; gap: 10px; color: var(--text-muted); font-size: 14px;">
                        <li>✓ Nilai taksiran di atas merupakan estimasi awal dan dapat menyesuaikan hasil pengecekan fisik serta harga pasar harian di outlet.</li>
                        <li>✓ Setiap barang jaminan mendapatkan perlindungan asuransi penuh selama masa gadai.</li>
                        <li>✓ Berizin resmi dan diawasi oleh Otoritas Jasa Keuangan (OJK).</li>
                    </ul>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <a href="{{ route('outlet') }}" class="btn btn-outline btn-sm">Cari Cabang Terdekat →</a>
                        <a href="{{ route('services') }}" class="btn btn-secondary btn-sm">Detail Produk & Syarat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

