@extends('frontend.layouts.template')

@section('pageTitle', 'Simulasi Taksiran Gadai Elektronik')

@push('customCss')
    <style>
        /* Styling Simulasi Taksiran Elektronik Simple (Rentang Terendah s/d Tertinggi) */
        .simulasi-container {
            position: relative;
        }

        .search-input-wrapper {
            position: relative;
            width: 100%;
        }

        .search-icon-badge {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
            display: flex;
            align-items: center;
        }

        .input-search-custom {
            width: 100%;
            padding: 14px 44px 14px 44px;
            background: rgba(255, 255, 255, 0.05);
            border: 1.5px solid var(--border-color);
            border-radius: var(--radius-sm);
            color: var(--text-main);
            font-family: var(--font-body);
            font-size: 15px;
            outline: none;
            transition: var(--transition-smooth);
        }

        .input-search-custom:focus {
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 4px rgba(255, 110, 43, 0.15);
        }

        .clear-search-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 4px;
            display: none;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: var(--transition-smooth);
        }

        .clear-search-btn:hover {
            color: var(--text-main);
            background: rgba(255, 255, 255, 0.1);
        }

        /* Dropdown Autocomplete */
        .autocomplete-dropdown {
            position: absolute;
            top: calc(100% + 6px);
            left: 0;
            right: 0;
            background: #0f172a;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: var(--radius-md);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.45);
            z-index: 999;
            max-height: 340px;
            overflow-y: auto;
            display: none;
        }

        :root.light-mode .autocomplete-dropdown {
            background: #ffffff;
            border-color: rgba(8, 56, 84, 0.12);
            box-shadow: 0 16px 36px rgba(8, 56, 84, 0.14);
        }

        .autocomplete-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            cursor: pointer;
            transition: var(--transition-smooth);
            text-decoration: none;
            color: inherit;
        }

        :root.light-mode .autocomplete-item {
            border-bottom-color: rgba(8, 56, 84, 0.06);
        }

        .autocomplete-item:hover,
        .autocomplete-item.active {
            background: rgba(255, 110, 43, 0.1);
        }

        .autocomplete-item:last-child {
            border-bottom: none;
        }

        .autocomplete-item-title {
            font-weight: 600;
            font-size: 14px;
            color: var(--text-main);
            margin-bottom: 2px;
        }

        .autocomplete-item-meta {
            font-size: 12px;
            color: var(--text-muted);
        }

        .autocomplete-item-price {
            text-align: right;
            font-weight: 700;
            font-size: 13px;
            color: var(--primary);
        }

        /* SKELETON LOADING SHIMMER ANIMATION */
        @keyframes shimmerAnim {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        .skeleton-shimmer {
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.04) 25%, rgba(255, 255, 255, 0.12) 50%, rgba(255, 255, 255, 0.04) 75%);
            background-size: 200% 100%;
            animation: shimmerAnim 1.4s infinite ease-in-out;
            border-radius: 4px;
        }

        :root.light-mode .skeleton-shimmer {
            background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%);
            background-size: 200% 100%;
        }

        .skeleton-search-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            gap: 12px;
        }

        :root.light-mode .skeleton-search-item {
            border-bottom-color: rgba(8, 56, 84, 0.06);
        }

        .skeleton-search-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .skeleton-search-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .skeleton-line {
            height: 12px;
            border-radius: 4px;
        }

        .skeleton-line.w-70 {
            width: 70%;
            height: 14px;
        }

        .skeleton-line.w-40 {
            width: 40%;
            height: 11px;
        }

        .skeleton-line.w-25 {
            width: 85px;
            height: 16px;
        }

        /* Skeleton for Results Simulation */
        .result-skeleton-overlay {
            position: relative;
            transition: opacity 0.25s ease;
        }

        .result-skeleton-overlay.is-loading {
            pointer-events: none;
            opacity: 0.55;
            filter: blur(1px);
        }

        /* Quick Suggestion Chips */
        .quick-chips-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
            align-items: center;
        }

        .quick-chip-label {
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .quick-chip {
            padding: 5px 12px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            color: var(--text-main);
            cursor: pointer;
            transition: var(--transition-smooth);
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .quick-chip:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: rgba(255, 110, 43, 0.08);
        }

        /* Submit Simulation Button */
        .btn-simulasi-submit {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 15px 24px;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.3px;
            background: linear-gradient(135deg, var(--primary) 0%, #ff8c42 100%);
            border: none;
            border-radius: var(--radius-sm);
            color: #ffffff;
            cursor: pointer;
            box-shadow: 0 8px 24px rgba(255, 110, 43, 0.3);
            transition: var(--transition-smooth);
            margin-top: 14px;
        }

        .btn-simulasi-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(255, 110, 43, 0.45);
        }

        .btn-simulasi-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Item Highlight Banner */
        .selected-item-banner {
            background: linear-gradient(135deg, rgba(8, 56, 84, 0.4) 0%, rgba(0, 78, 191, 0.15) 100%);
            border: 1px solid rgba(0, 78, 191, 0.3);
            border-radius: var(--radius-md);
            padding: 16px 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            animation: fadeInResult 0.35s ease;
        }

        :root.light-mode .selected-item-banner {
            background: linear-gradient(135deg, #f0f7ff 0%, #e6f0fa 100%);
            border-color: rgba(0, 78, 191, 0.2);
        }

        .selected-item-info h4 {
            margin: 0 0 4px 0;
            font-size: 16px;
            font-weight: 700;
            color: var(--text-main);
        }

        .selected-item-info p {
            margin: 0;
            font-size: 13px;
            color: var(--text-muted);
        }

        /* Range Summary Card */
        .range-highlight-card {
            background: linear-gradient(135deg, rgba(255, 110, 43, 0.09) 0%, rgba(2, 195, 168, 0.08) 100%);
            border: 1.5px solid rgba(255, 110, 43, 0.35);
            border-radius: var(--radius-md);
            padding: 24px;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
            animation: fadeInResult 0.35s ease;
        }

        .range-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            background: rgba(255, 110, 43, 0.15);
            color: var(--primary);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            border-radius: 20px;
            margin-bottom: 10px;
        }

        .range-main-val {
            font-family: var(--font-heading);
            font-size: 26px;
            font-weight: 800;
            color: #02C3A8;
            line-height: 1.25;
            margin-bottom: 4px;
        }

        @media (max-width: 576px) {
            .range-main-val {
                font-size: 21px;
            }
        }

        .range-sub-val {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Rincian Simulasi Box */
        .simulasi-rincian-box {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 20px 22px;
            margin-bottom: 22px;
            animation: fadeInResult 0.35s ease;
        }

        :root.light-mode .simulasi-rincian-box {
            background: #f8fafc;
            border-color: rgba(8, 56, 84, 0.08);
        }

        .rincian-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }

        .rincian-header h4 {
            margin: 0;
            font-size: 15px;
            font-weight: 700;
            color: var(--text-main);
        }

        .rincian-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            font-size: 14px;
            border-bottom: 1px dashed rgba(255, 255, 255, 0.06);
        }

        :root.light-mode .rincian-row {
            border-bottom-color: rgba(8, 56, 84, 0.07);
        }

        .rincian-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .rincian-row.highlight-row {
            margin-top: 6px;
            padding-top: 14px;
            border-top: 1px solid var(--border-color);
            border-bottom: none;
        }

        .rincian-label {
            color: var(--text-muted);
            font-weight: 500;
        }

        .rincian-val {
            font-weight: 700;
            color: var(--text-main);
            text-align: right;
        }

        @keyframes fadeInResult {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush

@section('content')
    @php
        $waNumber = preg_replace('/[^0-9]/', '', @$CONF->whatsapp ?: '6281181126771');
    @endphp

    <!-- Subpage Hero Section -->
    <section class="subhero-section">
        <div class="container">
            <span class="section-badge">CEK TAKSIRAN GADAI ELEKTRONIK</span>
            <h1 class="subhero-title">Simulasi <span class="gold-text">Taksiran Elektronik</span></h1>
            <p class="subhero-subtitle">Cek estimasi taksiran, rentang pinjaman (paling rendah s/d paling tinggi), sewa
                modal, dan biaya administrasi khusus Barang Elektronik Anda secara instan & transparan.</p>
        </div>
    </section>

    <!-- Main Simulation Section -->
    <section class="page-content-section simulasi-container">
        <div class="container">
            <div class="about-detail-grid" style="grid-template-columns: 1.15fr 0.85fr; align-items: start; gap: 40px;">
                <!-- Left Column: The 2-Input Form & Results -->
                <div class="calculator-card-wrapper" id="kalkulator">
                    <div class="calculator-card">
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                            <div class="feature-icon-wrapper"
                                style="width: 44px; height: 44px; background: rgba(2, 195, 168, 0.12); border-color: rgba(2, 195, 168, 0.3); color: #02C3A8;">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="5" y="2" width="14" height="20" rx="3" stroke="currentColor"
                                        stroke-width="2" />
                                    <circle cx="12" cy="18" r="1.5" fill="currentColor" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="calc-title" style="margin-bottom: 2px;">Cek Taksiran Elektronik</h3>
                                <p class="calc-desc" style="margin-bottom: 0;">Pilih jenis barang & ketik nama barang untuk
                                    melihat estimasi nilai terendah s/d tertinggi</p>
                            </div>
                        </div>

                        <div style="height: 1px; background: var(--border-color); margin: 20px 0 24px 0;"></div>

                        <!-- 2 INPUT FORM (KHUSUS ELEKTRONIK) -->
                        <div class="calc-form" style="margin-bottom: 24px;">
                            <!-- Input 1: Jenis Barang -->
                            <div class="input-group">
                                <label class="input-label" for="simulasi-jenis">1. Jenis Barang Elektronik</label>
                                <select class="input-select" id="simulasi-jenis" onchange="onCategoryChange()">
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat['id'] }}" {{ $cat['id'] === 'all' ? 'selected' : '' }}>
                                            {{ $cat['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Input 2: Nama Barang (Live Autocomplete with Skeleton) -->
                            <div class="input-group" style="position: relative;">
                                <label class="input-label" for="simulasi-nama">2. Nama Barang Elektronik</label>
                                <div class="search-input-wrapper">
                                    <span class="search-icon-badge">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                    </span>
                                    <input type="text" id="simulasi-nama" class="input-search-custom"
                                        placeholder="Ketik tipe / seri barang (contoh: iPhone 15 Pro, MacBook Air, Sony A7, PS5...)"
                                        autocomplete="off" maxlength="100" onkeydown="handleKeyDown(event)"
                                        oninput="handleSearchInput(this.value)">
                                    <input type="hidden" id="simulasi-kode" value="">
                                    <button type="button" class="clear-search-btn" id="btn-clear-search"
                                        onclick="clearSearch()" title="Hapus">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                    <!-- Autocomplete Results Dropdown with Skeleton Loading -->
                                    <div class="autocomplete-dropdown" id="dropdown-search"></div>
                                </div>

                                <!-- Quick Suggestion Chips with Solid Icons -->
                                <div class="quick-chips-wrapper">
                                    <span class="quick-chip-label">Populer:</span>
                                    <span class="quick-chip" onclick="quickSelect('iPhone 15 Pro Max 256GB')">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"
                                            style="vertical-align: -1px; margin-right: 4px;">
                                            <path
                                                d="M17 1.01L7 1c-1.1 0-2 .9-2 2v18c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V3c0-1.1-.9-1.99-2-1.99zM17 19H7V5h10v14z" />
                                        </svg>iPhone 15 Pro Max
                                    </span>
                                    <span class="quick-chip" onclick="quickSelect('MacBook Air 13&quot; M2 8GB/256GB')">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"
                                            style="vertical-align: -1px; margin-right: 4px;">
                                            <path
                                                d="M20 18c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2H0v2h24v-2h-4zM4 6h16v10H4V6z" />
                                        </svg>MacBook Air M2
                                    </span>
                                    <span class="quick-chip" onclick="quickSelect('Samsung Galaxy S24 Ultra 256GB')">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"
                                            style="vertical-align: -1px; margin-right: 4px;">
                                            <path
                                                d="M17 1.01L7 1c-1.1 0-2 .9-2 2v18c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V3c0-1.1-.9-1.99-2-1.99zM17 19H7V5h10v14z" />
                                        </svg>Galaxy S24 Ultra
                                    </span>
                                    <span class="quick-chip" onclick="quickSelect('Sony Alpha A7 III (Body Only)')">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"
                                            style="vertical-align: -1px; margin-right: 4px;">
                                            <path
                                                d="M9 2L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2h-3.17L15 2H9zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z" />
                                        </svg>Sony A7 III
                                    </span>
                                    <span class="quick-chip"
                                        onclick="quickSelect('Sony PlayStation 5 Slim Disc Edition')">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"
                                            style="vertical-align: -1px; margin-right: 4px;">
                                            <path
                                                d="M21 6H3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-10 7H8v3H6v-3H3v-2h3V8h2v3h3v2zm4.5 2c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm4-3c-.83 0-1.5-.67-1.5-1.5S18.67 9 19.5 9s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z" />
                                        </svg>PS5 Slim
                                    </span>
                                </div>
                            </div>

                            <!-- SUBMIT SIMULASI BUTTON -->
                            <button type="button" class="btn-simulasi-submit" id="btn-submit-simulasi"
                                onclick="submitSimulasi()">
                                <span id="btn-submit-text">Simulasikan Taksiran Sekarang</span>
                                <svg id="btn-submit-icon" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2.2">
                                    <path d="M5 12h14"></path>
                                    <path d="m12 5 7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- HASIL SIMULASI WRAPPER (Target scroll & Skeleton state - Hidden by default) -->
                        <div id="kalkulator-hasil" class="result-skeleton-overlay" style="display: none;">
                            <!-- Selected Item Banner -->
                            <div class="selected-item-banner" id="item-banner" style="display: none;">
                                <div class="selected-item-info">
                                    <h4 id="banner-item-name">-</h4>
                                    <p id="banner-item-meta">-</p>
                                </div>
                                <div style="text-align: right;">
                                    <span
                                        style="font-size: 11px; text-transform: uppercase; color: var(--text-muted); display: block;">Estimasi
                                        Pasar</span>
                                    <span style="font-weight: 800; font-size: 15px; color: var(--primary);"
                                        id="banner-item-price">-</span>
                                </div>
                            </div>

                            <!-- RENTANG UTAMA ESTIMASI PENCAIRAN -->
                            <div class="range-highlight-card" id="range-card">
                                <div class="range-badge">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <polygon
                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                        </polygon>
                                    </svg>
                                    Estimasi Nilai Pencairan Bersih
                                </div>
                                <div class="range-sub-val">Rentang Dana Cair Bersih (Terendah s/d Tertinggi):</div>
                                <div class="range-main-val" id="range-pencairan-display">-</div>
                            </div>

                            <!-- TULISAN DIBAWAH RANGE CARD & DIATAS BUTTON AJUKAN -->
                            <p class="simulasi-note-text"
                                style="font-size: 13px; line-height: 1.6; color: var(--text-muted); margin: 18px 0 16px 0; text-align: center; background: rgba(2, 195, 168, 0.08); border: 1px dashed rgba(2, 195, 168, 0.4); padding: 12px 16px; border-radius: 12px;">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#02C3A8"
                                    stroke-width="2"
                                    style="vertical-align: -2px; margin-right: 6px; display: inline-block;">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="16" x2="12" y2="12"></line>
                                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                </svg>
                                Nilai pencairan akhir ditentukan berdasarkan hasil pemeriksaan fisik perangkat secara
                                langsung di cabang Serba Gadai.
                            </p>

                            <!-- ACTION CTA BUTTONS -->
                            <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 6px;">
                                <a href="https://api.whatsapp.com/send?phone={{ $waNumber }}" id="wa-submit-btn"
                                    target="_blank" class="btn btn-primary btn-block calc-btn"
                                    style="padding: 16px; justify-content: center;">
                                    <span>Ajukan Gadai Barang Ini</span>
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2ZM12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.15 12.04 20.15C10.56 20.15 9.11 19.76 7.85 19L7.55 18.83L4.43 19.65L5.26 16.61L5.06 16.29C4.24 14.98 3.8 13.47 3.8 11.91C3.81 7.37 7.5 3.67 12.05 3.67ZM8.53 7.33C8.37 7.33 8.1 7.39 7.87 7.64C7.65 7.89 7 8.5 7 9.71C7 10.93 7.89 12.1 8 12.27C8.14 12.44 9.76 14.94 12.25 16.02C14.36 16.93 14.79 16.75 15.23 16.7C15.68 16.66 16.69 16.1 16.89 15.53C17.1 14.96 17.1 14.47 17.04 14.36C16.97 14.26 16.81 14.2 16.56 14.08C16.31 13.95 15.09 13.35 14.87 13.27C14.64 13.18 14.48 13.14 14.31 13.39C14.15 13.64 13.67 14.2 13.53 14.36C13.38 14.53 13.24 14.55 12.99 14.43C12.74 14.3 11.94 14.04 11 13.2C10.26 12.54 9.77 11.73 9.62 11.48C9.48 11.23 9.61 11.1 9.73 10.97C9.84 10.86 9.98 10.68 10.1 10.54C10.23 10.39 10.27 10.29 10.35 10.13C10.43 9.96 10.39 9.82 10.33 9.7C10.27 9.57 9.77 8.35 9.56 7.86C9.36 7.38 9.16 7.44 9.01 7.43C8.86 7.43 8.7 7.33 8.53 7.33Z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Info & Guidelines -->
                <div style="display: flex; flex-direction: column; gap: 24px;">
                    <!-- 3 Steps Guide -->
                    <div class="premium-about-card">
                        <span class="section-badge">PANDUAN CEPAT</span>
                        <h3 style="margin-top: 8px; margin-bottom: 16px;">3 Langkah Gadai Elektronik</h3>
                        <div class="features-list" style="gap: 16px;">
                            <div class="feature-card">
                                <div class="feature-icon-wrapper">
                                    <span style="font-weight: 800; color: var(--primary); font-size: 16px;">1</span>
                                </div>
                                <div>
                                    <h4 class="feature-title">Pilih Barang & Simulasikan</h4>
                                    <p class="feature-desc-text">Ketik nama smartphone, laptop, kamera, atau barang
                                        elektronik Anda lalu klik <strong>Simulasikan</strong> untuk melihat estimasi nilai
                                        taksiran dan pinjaman secara instan.</p>
                                </div>
                            </div>
                            <div class="feature-card">
                                <div class="feature-icon-wrapper">
                                    <span style="font-weight: 800; color: var(--primary); font-size: 16px;">2</span>
                                </div>
                                <div>
                                    <h4 class="feature-title">Bawa Barang & KTP ke Cabang</h4>
                                    <p class="feature-desc-text">Kunjungi outlet resmi Serba Gadai dengan membawa KTP dan
                                        perangkat elektronik beserta kelengkapan (charger, kardus jika ada).</p>
                                </div>
                            </div>
                            <div class="feature-card">
                                <div class="feature-icon-wrapper">
                                    <span style="font-weight: 800; color: var(--primary); font-size: 16px;">3</span>
                                </div>
                                <div>
                                    <h4 class="feature-title">Pemeriksaan ± 8 Menit & Dana Cair</h4>
                                    <p class="feature-desc-text">Petugas penaksir bersertifikasi akan memeriksa unit, dana
                                        langsung cair tunai atau transfer rekening tanpa potongan tersembunyi.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Keamanan & Regulasi Card -->
                    <div class="o-card" style="padding: 24px;">
                        <h4
                            style="font-family: var(--font-heading); font-size: 17px; font-weight: 700; margin-bottom: 12px; color: var(--text-main);">
                            🛡️ Jaminan Keamanan Serba Gadai
                        </h4>
                        <ul
                            style="list-style: none; padding: 0; margin: 0 0 16px 0; display: flex; flex-direction: column; gap: 8px; color: var(--text-muted); font-size: 13px;">
                            <li>✓ Berizin resmi dan diawasi oleh Otoritas Jasa Keuangan (OJK).</li>
                            <li>✓ Barang disimpan di ruang khusus bersegel dan terlindungi asuransi 100%.</li>
                            <li>✓ Tidak ada biaya tersembunyi, perhitungan sewa modal dan admin transparan.</li>
                        </ul>
                        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                            <a href="{{ route('outlet') }}" class="btn btn-outline btn-sm">Temukan Outlet Terdekat →</a>
                            <a href="{{ route('services') }}" class="btn btn-secondary btn-sm">Info Syarat & Ketentuan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('customJs')
    <script>
        (function() {
            // Security: Helper for XSS protection
            function escapeHtml(str) {
                if (!str) return '';
                return String(str)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }

            // State variables
            let currentItem = null;
            let selectedItem = null;
            let searchDebounceTimer = null;
            const waBasePhone = "{{ $waNumber }}";
            const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document.querySelector(
                'meta[name="csrf-token"]').getAttribute('content') : '';

            // Initial Popular Items loaded from controller
            const initialItems = @json($initialItems ?? []);

            // Handle Enter key in input
            window.handleKeyDown = function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const dropdown = document.getElementById('dropdown-search');
                    dropdown.style.display = 'none';
                    submitSimulasi();
                }
            };

            // Handle Category change
            window.onCategoryChange = function() {
                const query = document.getElementById('simulasi-nama').value.trim();
                if (query.length > 0) {
                    searchElectronics(query);
                }
            };

            // Handle Input Search with Skeleton Loading & Debounce
            window.handleSearchInput = function(val) {
                const clearBtn = document.getElementById('btn-clear-search');
                const codeInput = document.getElementById('simulasi-kode');
                if (codeInput) {
                    codeInput.value = '';
                }
                selectedItem = null;

                const trimmed = val.trim();

                if (trimmed.length > 0) {
                    clearBtn.style.display = 'flex';
                } else {
                    clearBtn.style.display = 'none';
                    document.getElementById('dropdown-search').style.display = 'none';
                    return;
                }

                // Show instant skeleton loading inside dropdown
                renderSearchSkeleton();

                clearTimeout(searchDebounceTimer);
                searchDebounceTimer = setTimeout(function() {
                    searchElectronics(trimmed);
                }, 220);
            };

            // Clear search input
            window.clearSearch = function() {
                const input = document.getElementById('simulasi-nama');
                input.value = '';
                input.focus();
                const codeInput = document.getElementById('simulasi-kode');
                if (codeInput) {
                    codeInput.value = '';
                }
                selectedItem = null;
                document.getElementById('btn-clear-search').style.display = 'none';
                document.getElementById('dropdown-search').style.display = 'none';
            };

            // Quick select from chips
            window.quickSelect = function(name, code = '') {
                document.getElementById('simulasi-nama').value = name;
                const codeInput = document.getElementById('simulasi-kode');
                if (codeInput) {
                    codeInput.value = code;
                }
                selectedItem = null;
                document.getElementById('btn-clear-search').style.display = 'flex';
                renderSearchSkeleton();
                searchElectronics(name, true, code);
            };

            // Render Skeleton Loading in Search Dropdown
            function renderSearchSkeleton() {
                const dropdown = document.getElementById('dropdown-search');
                dropdown.innerHTML = `
            <div class="skeleton-search-item">
                <div class="skeleton-search-icon skeleton-shimmer"></div>
                <div class="skeleton-search-body">
                    <div class="skeleton-line w-70 skeleton-shimmer"></div>
                    <div class="skeleton-line w-40 skeleton-shimmer"></div>
                </div>
                <div class="skeleton-line w-25 skeleton-shimmer"></div>
            </div>
            <div class="skeleton-search-item">
                <div class="skeleton-search-icon skeleton-shimmer"></div>
                <div class="skeleton-search-body">
                    <div class="skeleton-line w-70 skeleton-shimmer" style="width: 60%;"></div>
                    <div class="skeleton-line w-40 skeleton-shimmer" style="width: 35%;"></div>
                </div>
                <div class="skeleton-line w-25 skeleton-shimmer"></div>
            </div>
            <div class="skeleton-search-item">
                <div class="skeleton-search-icon skeleton-shimmer"></div>
                <div class="skeleton-search-body">
                    <div class="skeleton-line w-70 skeleton-shimmer" style="width: 80%;"></div>
                    <div class="skeleton-line w-40 skeleton-shimmer" style="width: 45%;"></div>
                </div>
                <div class="skeleton-line w-25 skeleton-shimmer"></div>
            </div>
        `;
                dropdown.style.display = 'block';
            }

            // Search via Backend API with Security Headers
            function searchElectronics(keyword, autoSelectAndSimulate = false, code = '') {
                const category = document.getElementById('simulasi-jenis').value;
                const dropdown = document.getElementById('dropdown-search');
                const startTime = Date.now();

                let searchUrl =
                    `{{ route('simulasi.search') }}?jenis=${encodeURIComponent(category)}&nama=${encodeURIComponent(keyword)}`;
                if (code) {
                    searchUrl += `&kode=${encodeURIComponent(code)}`;
                }

                fetch(searchUrl, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => {
                        if (!res.ok) throw new Error('Network error');
                        return res.json();
                    })
                    .then(res => {
                        const elapsed = Date.now() - startTime;
                        const remainingDelay = Math.max(0, 220 - elapsed);

                        setTimeout(function() {
                            if (res.status === 'success' && res.data && res.data.length > 0) {
                                renderDropdown(res.data);
                                if (autoSelectAndSimulate) {
                                    const target = (code ? res.data.find(d => d.code === code) : null) ||
                                        res.data[0];
                                    selectedItem = target;
                                    const codeInput = document.getElementById('simulasi-kode');
                                    if (codeInput && target.code) {
                                        codeInput.value = target.code;
                                    }
                                    setItem(target, true);
                                    dropdown.style.display = 'none';
                                }
                            } else {
                                renderEmptyDropdown(keyword);
                            }
                        }, remainingDelay);
                    })
                    .catch(err => {
                        console.error('Search error:', err);
                        dropdown.style.display = 'none';
                    });
            }

            // Render search results dropdown with sanitization
            function renderDropdown(items) {
                const dropdown = document.getElementById('dropdown-search');
                dropdown.innerHTML = '';

                items.forEach(function(item) {
                    const div = document.createElement('div');
                    div.className = 'autocomplete-item';
                    div.innerHTML = `
                <div>
                    <div class="autocomplete-item-title">${escapeHtml(item.name)}</div>
                    <div class="autocomplete-item-meta">${escapeHtml(item.brand)} • ${escapeHtml(item.code)}</div>
                </div>
            `;
                    div.addEventListener('click', function() {
                        document.getElementById('simulasi-nama').value = item.name;
                        const codeInput = document.getElementById('simulasi-kode');
                        if (codeInput) {
                            codeInput.value = item.code || '';
                        }
                        selectedItem = item;
                        document.getElementById('btn-clear-search').style.display = 'flex';
                        dropdown.style.display = 'none';
                    });
                    dropdown.appendChild(div);
                });

                dropdown.style.display = 'block';
            }

            // Render empty state
            function renderEmptyDropdown(keyword) {
                const dropdown = document.getElementById('dropdown-search');
                dropdown.innerHTML = `
            <div style="padding: 16px; text-align: center; color: var(--text-muted); font-size: 13px;">
                Barang "<strong>${escapeHtml(keyword)}</strong>" belum ada di daftar cepat.<br>
                <span style="font-size: 11px; margin-top: 4px; display: inline-block;">Silakan klik <strong>Simulasikan</strong> atau hubungi WhatsApp kami.</span>
            </div>
        `;
                dropdown.style.display = 'block';
            }

            // Set active item and update calculations (Simple Min s/d Max Range)
            function setItem(item, animateResults = true) {
                currentItem = item;

                // Show results wrapper
                const resultsWrapper = document.getElementById('kalkulator-hasil');
                if (resultsWrapper) {
                    resultsWrapper.style.display = 'block';
                }

                // Show banner
                const banner = document.getElementById('item-banner');
                if (banner) {
                    banner.style.display = 'flex';
                    document.getElementById('banner-item-name').textContent = item.name;
                    document.getElementById('banner-item-meta').textContent = `${item.brand} • Kode: ${item.code}`;
                    document.getElementById('banner-item-price').textContent = item.base_price_fmt;
                }

                // Update Range Main Box
                const range = item.breakdown.range;
                const rangeDisplay = document.getElementById('range-pencairan-display');
                if (rangeDisplay) {
                    rangeDisplay.textContent = range.pencairan_range_fmt;
                }

                updateWhatsAppLink();

                if (animateResults) {
                    triggerResultShimmer();
                }
            }

            // Trigger brief skeleton shimmer on results when simulating
            function triggerResultShimmer() {
                const resultsWrapper = document.getElementById('kalkulator-hasil');
                if (resultsWrapper) {
                    resultsWrapper.classList.add('is-loading');
                    setTimeout(function() {
                        resultsWrapper.classList.remove('is-loading');
                    }, 300);
                }
            }

            // SUBMIT SIMULASI BUTTON ACTION
            window.submitSimulasi = function() {
                const inputVal = document.getElementById('simulasi-nama').value.trim();
                const codeInput = document.getElementById('simulasi-kode');
                const codeVal = (codeInput ? codeInput.value : '').trim();
                const categoryVal = document.getElementById('simulasi-jenis').value;
                const btn = document.getElementById('btn-submit-simulasi');
                const btnText = document.getElementById('btn-submit-text');

                // Close dropdown
                document.getElementById('dropdown-search').style.display = 'none';

                if (!inputVal) {
                    document.getElementById('simulasi-nama').focus();
                    return;
                }

                // Animate button state
                btn.disabled = true;
                btnText.textContent = 'Menghitung Taksiran...';

                // Trigger shimmer effect on the results container
                const resultsWrapper = document.getElementById('kalkulator-hasil');
                if (resultsWrapper) {
                    resultsWrapper.classList.add('is-loading');
                }

                // If user already clicked this item from autocomplete dropdown or quick chips
                if (selectedItem && ((codeVal && selectedItem.code === codeVal) || (!codeVal && selectedItem.name
                        .toLowerCase() === inputVal.toLowerCase()))) {
                    setTimeout(function() {
                        btn.disabled = false;
                        btnText.textContent = 'Simulasikan Taksiran Sekarang';
                        if (resultsWrapper) {
                            resultsWrapper.classList.remove('is-loading');
                        }
                        setItem(selectedItem, true);
                        scrollToResults();
                    }, 350);
                    return;
                }

                // Fetch best match with item.code if present
                const query = inputVal || '';
                let searchUrl =
                    `{{ route('simulasi.search') }}?jenis=${encodeURIComponent(categoryVal)}&nama=${encodeURIComponent(query)}`;
                if (codeVal) {
                    searchUrl += `&kode=${encodeURIComponent(codeVal)}`;
                }

                fetch(searchUrl, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(res => {
                        setTimeout(function() {
                            btn.disabled = false;
                            btnText.textContent = 'Simulasikan Taksiran Sekarang';
                            if (resultsWrapper) {
                                resultsWrapper.classList.remove('is-loading');
                            }

                            if (res.status === 'success' && res.data && res.data.length > 0) {
                                const matched = (codeVal ? res.data.find(d => d.code === codeVal) :
                                    null) || res.data[0];
                                selectedItem = matched;
                                if (codeInput && matched.code) {
                                    codeInput.value = matched.code;
                                }
                                document.getElementById('simulasi-nama').value = matched.name;
                                setItem(matched, true);
                            } else if (currentItem) {
                                setItem(currentItem, true);
                            }
                            scrollToResults();
                        }, 350);
                    })
                    .catch(err => {
                        btn.disabled = false;
                        btnText.textContent = 'Simulasikan Taksiran Sekarang';
                        if (resultsWrapper) {
                            resultsWrapper.classList.remove('is-loading');
                        }
                        console.error('Submit error:', err);
                    });
            };

            // Smooth scroll helper
            function scrollToResults() {
                const hasil = document.getElementById('kalkulator-hasil');
                if (hasil) {
                    const yOffset = -80;
                    const y = hasil.getBoundingClientRect().top + window.pageYOffset + yOffset;
                    window.scrollTo({
                        top: y,
                        behavior: 'smooth'
                    });
                }
            }

            // Update WhatsApp CTA link with pre-filled assessment inquiry (Min - Max Range)
            function updateWhatsAppLink() {
                if (!currentItem) return;

                const range = currentItem.breakdown.range;

                const msg = `Halo Serba Gadai, saya ingin mengajukan taksiran gadai elektronik:\n` +
                    `• Barang: ${currentItem.name} (${currentItem.brand})\n` +
                    `• Estimasi Rentang Pencairan: ${range.pencairan_range_fmt}\n\n` +
                    `Mohon info kelengkapan persyaratan dan jadwal kunjungan cabang terdekat. Terima kasih.`;

                const waUrl = `https://api.whatsapp.com/send?phone=${waBasePhone}&text=${encodeURIComponent(msg)}`;
                const btn = document.getElementById('wa-submit-btn');
                if (btn) {
                    btn.href = waUrl;
                }
            }

            // Hide dropdown when clicking outside
            document.addEventListener('click', function(e) {
                const dropdown = document.getElementById('dropdown-search');
                const input = document.getElementById('simulasi-nama');
                if (!dropdown.contains(e.target) && e.target !== input) {
                    dropdown.style.display = 'none';
                }
            });

        })();
    </script>
@endpush
