@extends('frontend.layouts.template')

@section('pageTitle', 'Cabang & Outlet')

@section('content')
@php
    $waNumber = preg_replace('/[^0-9]/', '', @$CONF->whatsapp ?: '6281181126771');
    $badgeColors = ['red', 'blue', 'green'];
@endphp

<!-- Subpage Hero Section -->
<section class="subhero-section">
    <div class="container">
        <span class="section-badge">OUTLET KAMI</span>
        <h1 class="subhero-title">Lokasi <span class="gold-text">Cabang Terdekat</span></h1>
        <p class="subhero-subtitle">Kami hadir lebih dekat dengan Anda. Kunjungi outlet resmi {{ @$CONF->title ?? 'Gadai Mulia' }} terdekat di lokasi Anda.</p>
    </div>
</section>

<!-- Outlets Map & List Section -->
<section class="page-content-section">
    <div class="container">
        <!-- Interactive Branch Locator (Sidebar + Leaflet Map + Nearest Geolocation) -->
        <div style="margin-bottom: 56px;">
            @include('frontend.pages.part.branch-locator')
        </div>

        <div class="section-header-center" style="margin-bottom: 32px;">
            <span class="section-badge center">DIREKTORI LENGKAP</span>
            <h2 class="section-title-dark text-center">Daftar Seluruh Cabang</h2>
        </div>

        <!-- Filters & Search -->
        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 36px;">
            <div class="outlet-filters" style="margin-bottom: 0; flex-wrap: wrap; justify-content: flex-start;">
                <button class="o-filter-btn active" onclick="filterOutlets('all', this)">Semua Wilayah</button>
                @foreach($provinces as $province)
                    <button class="o-filter-btn" onclick="filterOutlets('{{ $province->id }}', this)">{{ $province->name }}</button>
                @endforeach
            </div>

            <div style="min-width: 280px; flex: 0 1 340px;">
                <input type="text" id="outlet-search" class="input-select" placeholder="🔍 Cari nama cabang atau alamat..." oninput="applyOutletFilters()">
            </div>
        </div>

        <!-- Outlets Cards Grid -->
        <div class="outlets-grid" id="outlets-grid">
            @foreach($outlets as $idx => $outlet)
                @php
                    $colorClass = $badgeColors[$idx % count($badgeColors)];
                    $provName = @$outlet->province->name ?? 'CABANG RESMI';
                    $mapQuery = !empty($outlet->lat_lng) ? $outlet->lat_lng : urlencode($outlet->name . ' ' . $outlet->address);
                @endphp
                <div class="o-card outlet-card-item" data-province="{{ $outlet->province_id }}" data-search="{{ strtolower($outlet->name . ' ' . $outlet->address . ' ' . $provName) }}">
                    <div class="o-header">
                        <span class="region-badge-small {{ $colorClass }}">{{ strtoupper($provName) }}</span>
                        <h3>{{ $outlet->name }}</h3>
                    </div>
                    <div class="o-body">
                        <p class="o-address">📍 {{ $outlet->address }}</p>
                        <p class="o-hours">⏰ Senin - Jumat (08:30 - 17:00) | Sabtu (08:30 - 14:00)</p>
                        <p class="o-phone">📞 {{ @$CONF->phone ?? '0811-8112-6771' }}</p>
                        
                        <div class="o-actions">
                            <a href="https://maps.google.com/?q={{ $mapQuery }}" target="_blank" rel="noopener" class="btn btn-secondary btn-sm">Petunjuk Arah</a>
                            <a href="https://api.whatsapp.com/send?phone={{ $waNumber }}&text=Halo%20Gadai%20Mulia%20Cabang%20{{ urlencode($outlet->name) }},%20saya%20ingin%20tanya..." target="_blank" rel="noopener" class="btn btn-primary btn-sm">WhatsApp Cabang</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('customJs')
<script>
    let activeProvince = 'all';

    function filterOutlets(provinceId, btnEl) {
        activeProvince = String(provinceId);
        document.querySelectorAll('.outlet-filters .o-filter-btn').forEach(btn => btn.classList.remove('active'));
        if (btnEl) btnEl.classList.add('active');
        applyOutletFilters();
    }

    function applyOutletFilters() {
        const query = (document.getElementById('outlet-search')?.value || '').toLowerCase().trim();
        document.querySelectorAll('.outlet-card-item').forEach(card => {
            const cardProv = card.getAttribute('data-province');
            const cardSearch = card.getAttribute('data-search') || '';
            const matchProv = (activeProvince === 'all' || cardProv === activeProvince);
            const matchSearch = (!query || cardSearch.includes(query));
            card.style.display = (matchProv && matchSearch) ? 'block' : 'none';
        });
    }
</script>
@endpush
