@extends('frontend.layouts.template')

@section('pageTitle', 'Tentang Kami')

@section('content')
<!-- Subpage Hero Section -->
<section class="subhero-section">
    <div class="container">
        <span class="section-badge">SIAPA KAMI</span>
        <h1 class="subhero-title">{{ !empty($page->general_title) ? $page->general_title : 'Tentang Gadai Mulia' }}</h1>
        <p class="subhero-subtitle">{{ !empty($page->general_sub_header) ? $page->general_sub_header : 'Perusahaan pergadaian swasta resmi yang terdaftar, berizin, dan diawasi langsung oleh Otoritas Jasa Keuangan (OJK).' }}</p>
    </div>
</section>

<!-- Content Section -->
<section class="page-content-section">
    <div class="container">
        <div class="about-detail-grid">
            <div>
                <h2 class="section-title-dark">Sejarah & Profil Singkat</h2>
                @if(!empty($page->general_content))
                    <div class="cms-rich-content text-justify">
                        {!! $page->general_content !!}
                    </div>
                @else
                    <p class="section-text text-justify">Gadai Mulia didirikan pada bulan Agustus 2018 dengan komitmen menjadi solusi dana cepat bagi masyarakat dengan jaminan emas perhiasan, logam mulia, dan barang elektronik. Dalam perjalanannya, Gadai Mulia senantiasa mematuhi regulasi keuangan yang ketat demi menjaga kenyamanan dan kepercayaan para nasabah.</p>
                @endif

                <div class="license-list">
                    <div class="license-item">
                        <span class="license-bullet">🛡️</span>
                        <div>
                            <strong>Wilayah DKI Jakarta</strong>
                            <p class="license-desc-text">Surat Keputusan OJK KEP-10/NB.1/2022 tertanggal 11 Februari 2022.</p>
                        </div>
                    </div>
                    <div class="license-item">
                        <span class="license-bullet">🛡️</span>
                        <div>
                            <strong>Wilayah Jawa Barat</strong>
                            <p class="license-desc-text">Surat Keputusan OJK KEP-337/PL.02/2025 tertanggal 18 November 2025.</p>
                        </div>
                    </div>
                    <div class="license-item">
                        <span class="license-bullet">🛡️</span>
                        <div>
                            <strong>Wilayah Kepulauan Riau</strong>
                            <p class="license-desc-text">Surat Keputusan OJK KEP-158/NB.1/2020 tertanggal 24 November 2020.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="visual-card-wrapper">
                <div class="premium-about-card">
                    <h3>Visi Kami</h3>
                    <div class="card-quote cms-rich-content">
                        @if(!empty($page->vision_content))
                            {!! $page->vision_content !!}
                        @else
                            "Menjadi pergadaian swasta pilihan utama masyarakat Indonesia yang memberikan pelayanan keuangan tercepat, teraman, dan memiliki integritas terbaik."
                        @endif
                    </div>
                    
                    <div class="divider-line"></div>
                    
                    <h3>Misi Kami</h3>
                    <div class="cms-rich-content">
                        @if(!empty($page->mission_content))
                            {!! $page->mission_content !!}
                        @else
                            <ul class="about-misi-list">
                                <li>Menghadirkan pelayanan pergadaian yang mudah, cepat, dan transparan bagi semua kalangan.</li>
                                <li>Menjamin keamanan barang jaminan nasabah dengan sistem proteksi asuransi terpercaya.</li>
                                <li>Mendukung kemajuan UMKM lokal melalui penyediaan akses permodalan yang adil dan sewa modal rendah.</li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Corporate Values -->
        @if(!empty($page->values) && count($page->values) > 0)
        <div style="margin-top: 90px;">
            <div class="section-header-center">
                <span class="section-badge center">NILAI PERUSAHAAN</span>
                <h2 class="section-title-dark text-center">Corporate Values</h2>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 24px;">
                @foreach($page->values as $value)
                    <div class="stat-card" style="text-align: center; padding: 32px 24px;">
                        @if(!empty($value->image))
                            <img src="{{ url('storage/'.$value->image) }}" alt="{{ $value->title }}" style="width: 64px; height: 64px; object-fit: contain; margin: 0 auto 16px auto; display: block;" onerror="this.style.display='none'">
                        @endif
                        <h3 class="product-title" style="color: var(--primary); margin-bottom: 10px;">{{ $value->title }}</h3>
                        <p class="section-text" style="margin-bottom: 0; font-size: 14px;">{{ $value->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Area / Wilayah Operasional -->
        <div class="about-detail-grid" style="margin-top: 90px; align-items: center;">
            <div>
                <span class="section-badge">JARINGAN OUTLET</span>
                <h2 class="section-title-dark">{{ !empty($page->area_title) ? $page->area_title : 'Jangkauan Wilayah Operasional Kami' }}</h2>
                <p class="section-text">{{ !empty($page->area_content) ? $page->area_content : 'Kami hadir melayani masyarakat di berbagai wilayah strategis dengan standar pelayanan terbaik.' }}</p>
                <a href="{{ route('outlet') }}" class="btn btn-primary">Lihat Seluruh Outlet Kami →</a>
            </div>
            <div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                    @if(!empty($outlets) && count($outlets) > 0)
                        @foreach($outlets as $outlet)
                            <div class="o-card" style="padding: 24px; text-align: center;">
                                <span class="region-badge-small active" style="background: rgba(245, 158, 11, 0.12); color: var(--primary);">WILAYAH</span>
                                <h3 style="font-size: 22px; margin-bottom: 12px;">{{ $outlet->province_name }}</h3>
                                <a href="{{ route('outlet') }}" class="btn btn-outline btn-sm">Cek Cabang</a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <!-- Activities Gallery -->
        @if(!empty($page->activities) && count($page->activities) > 0)
        <div style="margin-top: 90px;">
            <div class="section-header-center">
                <span class="section-badge center">DOKUMENTASI</span>
                <h2 class="section-title-dark text-center">{{ !empty($page->activity_header) ? $page->activity_header : 'Kegiatan Kami' }}</h2>
                <p class="section-desc-center text-center">{{ !empty($page->activity_sub_header) }}</p>
            </div>

            <div class="outlet-filters">
                <button class="o-filter-btn active" onclick="filterActivity('MARKETING', this)">Kegiatan Marketing</button>
                <button class="o-filter-btn" onclick="filterActivity('INTERNAL', this)">Kegiatan Internal</button>
                <button class="o-filter-btn" onclick="filterActivity('CSR', this)">Corporate Social Responsibility</button>
            </div>

            <div class="article-grid" id="activity-grid">
                @foreach($page->activities as $activity)
                    <div class="art-card activity-item" data-category="{{ $activity->category }}" style="{{ $activity->category == 'MARKETING' ? '' : 'display: none;' }}">
                        <div class="art-img-wrapper" style="height: 240px;">
                            <img src="{{ url('storage/'.$activity->image) }}" alt="{{ $activity->title ?? 'Kegiatan' }}" class="art-img" onerror="this.src='{{ url('serbamulia/assets/emas.jpg') }}'">
                        </div>
                        @if(!empty($activity->title))
                        <div class="art-content" style="padding: 16px 20px;">
                            <h4 class="art-title" style="margin-bottom: 0;">{{ $activity->title }}</h4>
                        </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection

@push('customJs')
<script>
    function filterActivity(category, btnEl) {
        document.querySelectorAll('.outlet-filters .o-filter-btn').forEach(btn => btn.classList.remove('active'));
        btnEl.classList.add('active');

        document.querySelectorAll('.activity-item').forEach(item => {
            if (item.getAttribute('data-category') === category) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>
@endpush
