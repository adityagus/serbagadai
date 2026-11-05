@php
    $waNumber = preg_replace('/[^0-9]/', '', @$CONF->whatsapp ?: '6281181126771');
    $defaultPhone = @$CONF->phone ?: '+62 811-8112-6771';

    $cmsBranches = [];
    if (!empty($outlets) && count($outlets) > 0) {
        foreach ($outlets as $idx => $outlet) {
            $coords = !empty($outlet->lat_lng) ? explode(',', $outlet->lat_lng) : [];
            $lat = isset($coords[0]) && is_numeric(trim($coords[0])) ? (float) trim($coords[0]) : (-6.1951 - ($idx * 0.02));
            $lng = isset($coords[1]) && is_numeric(trim($coords[1])) ? (float) trim($coords[1]) : (106.8208 + ($idx * 0.02));
            if ($lat == 0 && $lng == 0) {
                $lat = -6.1951;
                $lng = 106.8208;
            }
            $cmsBranches[] = [
                'id' => (int) $outlet->id,
                'name' => $outlet->name,
                'city' => @$outlet->province->name ?: 'Cabang Resmi',
                'address' => $outlet->address,
                'phone' => $defaultPhone,
                'whatsapp' => $waNumber,
                'openHour' => '08:30',
                'closeHour' => '17:00',
                'days' => 'Senin - Sabtu',
                'lat' => $lat,
                'lng' => $lng,
                'tags' => ['Cabang Resmi OJK', 'Gadai Elektronik'],
            ];
        }
    } else {
        $cmsBranches = [
            [
                'id' => 1,
                'name' => 'Kantor Pusat Kelapa Gading',
                'city' => 'DKI Jakarta',
                'address' => 'Kirana Three Office Tower, Lt. 15, Jl. Boulevard Raya No.1, Kelapa Gading, Jakarta Utara 14240',
                'phone' => $defaultPhone,
                'whatsapp' => $waNumber,
                'openHour' => '08:30',
                'closeHour' => '17:00',
                'days' => 'Senin - Sabtu',
                'lat' => -6.1675,
                'lng' => 106.9003,
                'tags' => ['Kantor Pusat', 'Gadai Elektronik'],
            ],
            [
                'id' => 2,
                'name' => 'Cabang Bandung Dago',
                'city' => 'Jawa Barat',
                'address' => 'Jl. Ir. H. Juanda No.102, Dago, Kecamatan Coblong, Kota Bandung, Jawa Barat 40132',
                'phone' => $defaultPhone,
                'whatsapp' => $waNumber,
                'openHour' => '08:30',
                'closeHour' => '17:00',
                'days' => 'Senin - Sabtu',
                'lat' => -6.8856,
                'lng' => 107.6136,
                'tags' => ['Cabang Resmi OJK', 'Gadai Elektronik'],
            ],
            [
                'id' => 3,
                'name' => 'Cabang Batam Center',
                'city' => 'Kepulauan Riau',
                'address' => 'Ruko Rafflesia Blok C No. 5, Jl. Engku Putri, Batam Center, Kota Batam, Kepulauan Riau 29461',
                'phone' => $defaultPhone,
                'whatsapp' => $waNumber,
                'openHour' => '08:30',
                'closeHour' => '17:00',
                'days' => 'Senin - Sabtu',
                'lat' => 1.1290,
                'lng' => 104.0530,
                'tags' => ['Cabang Resmi OJK', 'Gadai Elektronik'],
            ],
        ];
    }
@endphp

@push('customCss')
<!-- Leaflet CSS & FontAwesome -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

<style>
    /* Store Locator Wrapper */
    .locator-shell {
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-premium);
        display: flex;
        flex-direction: column;
    }

    .locator-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 24px;
        border-bottom: 1px solid var(--border-color);
        background: var(--bg-secondary);
        flex-wrap: wrap;
        gap: 12px;
    }

    .locator-brand {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .locator-brand-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: linear-gradient(135deg, #FF6E2B 0%, #F49A67 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        box-shadow: 0 4px 14px rgba(255, 110, 43, 0.3);
    }

    .locator-brand-title {
        font-family: var(--font-heading);
        font-weight: 700;
        font-size: 17px;
        color: var(--text-main);
        line-height: 1.2;
    }

    .locator-brand-sub {
        font-size: 12px;
        color: var(--text-muted);
    }

    .locator-top-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .locator-mobile-toggle {
        display: none;
        background: var(--bg-primary);
        padding: 4px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
    }

    .locator-mobile-btn {
        border: none;
        background: transparent;
        color: var(--text-muted);
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition-smooth);
    }

    .locator-mobile-btn.active {
        background: var(--primary);
        color: #111827;
    }

    .locator-reset-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 600;
        background: rgba(255, 255, 255, 0.05);
        color: var(--text-main);
        border: 1px solid var(--border-color);
        padding: 8px 14px;
        border-radius: 10px;
        cursor: pointer;
        transition: var(--transition-smooth);
    }

    :root.light-mode .locator-reset-btn {
        background: #f1f5f9;
        color: #0f172a;
    }

    .locator-reset-btn:hover {
        border-color: var(--primary);
        color: var(--primary);
    }

    /* Main Split Body */
    .locator-body {
        display: flex;
        height: 680px;
        position: relative;
        overflow: hidden;
    }

    .locator-sidebar {
        width: 440px;
        flex-shrink: 0;
        border-right: 1px solid var(--border-color);
        display: flex;
        flex-direction: column;
        height: 100%;
        background: var(--bg-secondary);
        z-index: 10;
    }

    .locator-filters-box {
        padding: 18px 20px;
        border-bottom: 1px solid var(--border-color);
    }

    .locator-search-wrap {
        position: relative;
        margin-bottom: 14px;
    }

    .locator-search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 13px;
        pointer-events: none;
    }

    .locator-search-input {
        width: 100%;
        padding: 10px 36px 10px 38px;
        background: var(--bg-primary);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        color: var(--text-main);
        font-size: 13px;
        font-family: var(--font-body);
        outline: none;
        transition: var(--transition-smooth);
    }

    .locator-search-input:focus {
        border-color: var(--primary);
    }

    .locator-search-clear {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        color: var(--text-muted);
        cursor: pointer;
        font-size: 14px;
    }

    .locator-city-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: var(--text-muted);
        margin-bottom: 8px;
    }

    .locator-city-chips {
        display: flex;
        align-items: center;
        gap: 6px;
        overflow-x: auto;
        padding-bottom: 4px;
    }

    .locator-city-chip {
        white-space: nowrap;
        padding: 5px 13px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        border: 1px solid var(--border-color);
        background: var(--bg-primary);
        color: var(--text-muted);
        cursor: pointer;
        transition: var(--transition-smooth);
    }

    .locator-city-chip.active,
    .locator-city-chip:hover {
        background: var(--primary);
        color: #111827;
        border-color: var(--primary);
    }

    .locator-meta-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 12px;
        padding-top: 10px;
        border-top: 1px solid var(--border-color);
        font-size: 12px;
        color: var(--text-muted);
    }

    .locator-open-toggle {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        user-select: none;
        font-weight: 600;
    }

    .locator-open-toggle input {
        accent-color: var(--primary);
        width: 15px;
        height: 15px;
        cursor: pointer;
    }

    /* Scrollable Cards List */
    .locator-list {
        flex: 1;
        overflow-y: auto;
        padding: 16px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        background: var(--bg-primary);
    }

    .locator-card {
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 16px;
        cursor: pointer;
        transition: var(--transition-smooth);
    }

    .locator-card:hover {
        border-color: rgba(245, 158, 11, 0.35);
    }

    .locator-card.selected {
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.25);
    }

    .locator-card-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 8px;
        margin-bottom: 8px;
    }

    .locator-city-badge {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        background: rgba(245, 158, 11, 0.12);
        color: var(--primary);
        margin-bottom: 4px;
    }

    .locator-branch-name {
        font-family: var(--font-heading);
        font-size: 15px;
        font-weight: 700;
        color: var(--text-main);
        line-height: 1.3;
    }

    .locator-status-pill {
        flex-shrink: 0;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .locator-status-pill.open {
        background: rgba(16, 185, 129, 0.12);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.25);
    }

    .locator-status-pill.closed {
        background: rgba(239, 68, 68, 0.12);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.25);
    }

    .locator-address {
        font-size: 12px;
        color: var(--text-muted);
        line-height: 1.5;
        margin-bottom: 10px;
    }

    .locator-info-rows {
        display: flex;
        flex-direction: column;
        gap: 4px;
        font-size: 12px;
        color: var(--text-muted);
        margin-bottom: 10px;
    }

    .locator-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 12px;
    }

    .locator-tag {
        font-size: 10px;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 6px;
        background: var(--bg-primary);
        border: 1px solid var(--border-color);
        color: var(--text-muted);
    }

    .locator-card-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        padding-top: 10px;
        border-top: 1px solid var(--border-color);
    }

    .locator-btn-map {
        flex: 1;
        background: rgba(245, 158, 11, 0.12);
        color: var(--primary);
        border: 1px solid rgba(245, 158, 11, 0.25);
        font-size: 12px;
        font-weight: 600;
        padding: 8px 10px;
        border-radius: 10px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: var(--transition-smooth);
    }

    .locator-btn-map:hover {
        background: var(--primary);
        color: #111827;
    }

    .locator-btn-dir {
        flex: 1;
        background: var(--bg-primary);
        color: var(--text-main);
        border: 1px solid var(--border-color);
        font-size: 12px;
        font-weight: 600;
        padding: 8px 10px;
        border-radius: 10px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: var(--transition-smooth);
    }

    .locator-btn-dir:hover {
        border-color: var(--primary);
        color: var(--primary);
    }

    .locator-btn-wa {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: #10b981;
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        flex-shrink: 0;
        transition: var(--transition-smooth);
    }

    .locator-btn-wa:hover {
        background: #059669;
    }

    /* Map Panel */
    .locator-map-panel {
        flex: 1;
        height: 100%;
        width: 100%;
        position: relative;
    }

    #branchLocatorMap {
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .locator-map-controls {
        position: absolute;
        bottom: 20px;
        right: 20px;
        z-index: 400;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .locator-fab {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        background: #ffffff;
        color: #1e293b;
        border: 1px solid #e2e8f0;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        transition: var(--transition-smooth);
    }

    .locator-fab:hover {
        background: var(--primary);
        color: #111827;
        border-color: var(--primary);
    }

    .locator-toast {
        position: absolute;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 500;
        background: rgba(15, 23, 42, 0.92);
        backdrop-filter: blur(8px);
        color: #ffffff;
        font-size: 12px;
        font-weight: 500;
        padding: 10px 16px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Custom Leaflet Pin */
    .custom-branch-pin {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .custom-branch-pin .pin-body {
        background: #004EBF;
        color: white;
        width: 36px;
        height: 36px;
        border-radius: 50% 50% 50% 0;
        transform: rotate(-45deg);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 14px rgba(0, 78, 191, 0.5);
        border: 2px solid #ffffff;
        transition: all 0.2s ease;
    }
    .custom-branch-pin .pin-body i {
        transform: rotate(45deg);
        font-size: 15px;
    }
    .custom-branch-pin.active .pin-body {
        background: #FF6E2B;
        width: 44px;
        height: 44px;
        box-shadow: 0 6px 18px rgba(255, 110, 43, 0.55);
    }
    .custom-branch-pin.active .pin-body i {
        font-size: 18px;
    }

    /* Custom Leaflet Popup */
    .leaflet-popup-content-wrapper {
        padding: 0;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.25);
    }
    .leaflet-popup-content {
        margin: 0 !important;
        line-height: 1.4;
    }

    @media (max-width: 900px) {
        .locator-mobile-toggle {
            display: flex;
        }
        .locator-reset-btn {
            display: none;
        }
        .locator-sidebar {
            width: 100%;
            border-right: none;
        }
        .locator-body {
            height: 600px;
        }
    }
</style>
@endpush

<div class="locator-shell" id="branch-locator">
    <!-- Top Header Bar -->
    <div class="locator-topbar">
        <div class="locator-brand">
            <div class="locator-brand-icon">
                <i class="fa-solid fa-map-location-dot"></i>
            </div>
            <div>
                <div class="locator-brand-title">Cabang Kita — {{ @$CONF->title ?? 'Gadai Mulia' }}</div>
                <div class="locator-brand-sub">Jaringan Cabang Resmi Berizin & Diawasi OJK</div>
            </div>
        </div>

        <div class="locator-top-actions">
            <div class="locator-mobile-toggle">
                <button type="button" id="mobileViewListBtn" class="locator-mobile-btn active">
                    <i class="fa-solid fa-list"></i> Daftar
                </button>
                <button type="button" id="mobileViewMapBtn" class="locator-mobile-btn">
                    <i class="fa-solid fa-map"></i> Peta
                </button>
            </div>

            <button type="button" onclick="centerOnUserLocation()" class="locator-reset-btn">
                <i class="fa-solid fa-location-crosshairs" style="color: var(--primary);"></i> Cari Terdekat dari Saya
            </button>
            <button type="button" onclick="resetMapView()" class="locator-reset-btn">
                <i class="fa-solid fa-compress"></i> Reset Pandangan Peta
            </button>
        </div>
    </div>

    <!-- Split Sidebar + Map -->
    <div class="locator-body">
        <!-- Sidebar -->
        <aside id="sidebarPanel" class="locator-sidebar">
            <div class="locator-filters-box">
                <div class="locator-search-wrap">
                    <span class="locator-search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Cari nama cabang, jalan, atau wilayah..."
                        class="locator-search-input"
                    >
                    <button type="button" id="clearSearchBtn" class="locator-search-clear hidden">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div>
                    <div class="locator-city-label">Pilih Wilayah</div>
                    <div id="cityFilterContainer" class="locator-city-chips"></div>
                </div>

                <div class="locator-meta-bar">
                    <div>
                        Menampilkan: <strong id="branchCounter" style="color: var(--text-main);">0</strong> Cabang
                    </div>
                    <label class="locator-open-toggle">
                        <input type="checkbox" id="filterOpenOnly">
                        <span>Hanya Buka</span>
                    </label>
                </div>
            </div>

            <div id="branchesList" class="locator-list"></div>
        </aside>

        <!-- Map -->
        <main id="mapPanel" class="locator-map-panel">
            <div id="branchLocatorMap"></div>

            <div class="locator-map-controls">
                <button type="button" onclick="centerOnUserLocation()" title="Gunakan Lokasi Saya" class="locator-fab">
                    <i class="fa-solid fa-location-crosshairs" style="color: #d97706;"></i>
                </button>
                <button type="button" onclick="resetMapView()" title="Tampilkan Semua Cabang" class="locator-fab">
                    <i class="fa-solid fa-expand"></i>
                </button>
            </div>

            <div id="toastNotification" class="locator-toast hidden">
                <i class="fa-solid fa-circle-info" style="color: var(--primary);"></i>
                <span id="toastMessage">Pesan</span>
            </div>
        </main>
    </div>
</div>

@push('customJs')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    const branchData = @json($cmsBranches);

    let locatorMap;
    let locatorMarkers = {};
    let selectedBranchId = null;
    let selectedCity = "Semua";
    let searchQuery = "";
    let openOnlyFilter = false;

    function getStoreStatus(openHourStr, closeHourStr) {
        const now = new Date();
        const currentMinutes = now.getHours() * 60 + now.getMinutes();

        const [openH, openM] = openHourStr.split(":").map(Number);
        const [closeH, closeM] = closeHourStr.split(":").map(Number);

        const openMinutes = openH * 60 + openM;
        const closeMinutes = closeH * 60 + closeM;

        const isOpen = currentMinutes >= openMinutes && currentMinutes < closeMinutes;
        return {
            isOpen,
            badgeText: isOpen ? "Buka Sekarang" : "Tutup",
            scheduleText: `${openHourStr} - ${closeHourStr} WIB`
        };
    }

    document.addEventListener("DOMContentLoaded", () => {
        initLocatorMap();
        renderCityFilters();
        renderBranches();
        setupLocatorListeners();
    });

    function initLocatorMap() {
        const mapEl = document.getElementById("branchLocatorMap");
        if (!mapEl) return;

        locatorMap = L.map("branchLocatorMap", {
            zoomControl: false,
            attributionControl: true
        }).setView([-2.5489, 118.0149], 5);

        L.control.zoom({ position: "topright" }).addTo(locatorMap);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a>'
        }).addTo(locatorMap);

        branchData.forEach(branch => {
            const marker = createCustomMarker(branch);
            marker.addTo(locatorMap);
            locatorMarkers[branch.id] = marker;
        });

        resetMapView();
    }

    function createCustomMarker(branch) {
        const iconHtml = `
            <div class="custom-branch-pin" id="pin-${branch.id}">
                <div class="pin-body">
                    <i class="fa-solid fa-store"></i>
                </div>
            </div>
        `;

        const customIcon = L.divIcon({
            className: 'custom-leaflet-div-icon',
            html: iconHtml,
            iconSize: [40, 40],
            iconAnchor: [20, 36],
            popupAnchor: [0, -32]
        });

        const marker = L.marker([branch.lat, branch.lng], { icon: customIcon });
        const status = getStoreStatus(branch.openHour, branch.closeHour);
        const googleMapsUrl = `https://www.google.com/maps/dir/?api=1&destination=${branch.lat},${branch.lng}`;

        const popupContent = `
            <div style="width: 260px; font-family: 'Plus Jakarta Sans', sans-serif; color: #1e293b; background: #ffffff;">
                <div style="background: linear-gradient(135deg, #d97706 0%, #b45309 100%); color: #ffffff; padding: 14px;">
                    <div style="display: flex; align-items: center; justify-content: space-between; font-size: 11px; margin-bottom: 4px;">
                        <span style="background: rgba(255,255,255,0.2); padding: 2px 8px; border-radius: 999px; font-weight: 600;">${branch.city}</span>
                        <span style="padding: 2px 8px; border-radius: 999px; font-weight: 700; background: ${status.isOpen ? '#10b981' : '#ef4444'}; color: #fff;">
                            ${status.badgeText}
                        </span>
                    </div>
                    <h4 style="font-weight: 700; font-size: 14px; margin: 4px 0 0 0; color: #ffffff;">${branch.name}</h4>
                </div>
                <div style="padding: 14px; font-size: 12px;">
                    <p style="color: #475569; margin: 0 0 8px 0; line-height: 1.45;"><i class="fa-solid fa-location-dot" style="color: #d97706; margin-right: 6px;"></i>${branch.address}</p>
                    <p style="color: #475569; margin: 0 0 12px 0;"><i class="fa-regular fa-clock" style="color: #d97706; margin-right: 6px;"></i>${status.scheduleText}</p>
                    <div style="display: flex; gap: 6px;">
                        <a href="${googleMapsUrl}" target="_blank" style="flex: 1; background: #0f172a; color: #ffffff; text-align: center; padding: 7px 10px; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 12px;">
                            <i class="fa-solid fa-diamond-turn-right"></i> Rute
                        </a>
                        <a href="https://api.whatsapp.com/send?phone=${branch.whatsapp}&text=Halo%20${encodeURIComponent(branch.name)},%20saya%20ingin%20bertanya..." target="_blank" style="background: #10b981; color: #ffffff; padding: 7px 12px; border-radius: 8px; text-decoration: none; font-size: 13px; display: flex; align-items: center; justify-content: center;" title="Chat WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        `;

        marker.bindPopup(popupContent);

        marker.on("click", () => {
            selectBranch(branch.id, false);
        });

        return marker;
    }

    function renderCityFilters() {
        const cities = ["Semua", ...new Set(branchData.map(b => b.city))];
        const container = document.getElementById("cityFilterContainer");
        if (!container) return;

        container.innerHTML = cities.map(city => `
            <button
                type="button"
                onclick="filterByCity('${city.replace(/'/g, "\\'")}')"
                class="locator-city-chip ${selectedCity === city ? 'active' : ''}"
            >
                ${city}
            </button>
        `).join("");
    }

    function getFilteredBranches() {
        return branchData.filter(branch => {
            const matchesCity = selectedCity === "Semua" || branch.city === selectedCity;
            const q = searchQuery.toLowerCase().trim();
            const matchesSearch = !q ||
                branch.name.toLowerCase().includes(q) ||
                branch.address.toLowerCase().includes(q) ||
                branch.city.toLowerCase().includes(q);

            const status = getStoreStatus(branch.openHour, branch.closeHour);
            const matchesOpen = !openOnlyFilter || status.isOpen;

            return matchesCity && matchesSearch && matchesOpen;
        });
    }

    function renderBranches() {
        const branchesList = document.getElementById("branchesList");
        if (!branchesList) return;
        const filtered = getFilteredBranches();

        const counterEl = document.getElementById("branchCounter");
        if (counterEl) counterEl.textContent = filtered.length;

        if (filtered.length === 0) {
            branchesList.innerHTML = `
                <div style="text-align: center; padding: 48px 16px;">
                    <div style="font-size: 28px; color: var(--text-muted); margin-bottom: 12px;">
                        <i class="fa-solid fa-store-slash"></i>
                    </div>
                    <h4 style="font-size: 15px; font-weight: 700; color: var(--text-main); margin-bottom: 4px;">Tidak ada cabang ditemukan</h4>
                    <p style="font-size: 12px; color: var(--text-muted); margin-bottom: 16px;">Coba ubah kata kunci pencarian atau sesuaikan pilihan filter wilayah.</p>
                    <button type="button" onclick="resetFilters()" class="btn btn-outline btn-sm">
                        Reset Semua Filter
                    </button>
                </div>
            `;
            return;
        }

        branchesList.innerHTML = filtered.map(branch => {
            const isSelected = branch.id === selectedBranchId;
            const status = getStoreStatus(branch.openHour, branch.closeHour);
            const googleMapsUrl = `https://www.google.com/maps/dir/?api=1&destination=${branch.lat},${branch.lng}`;

            return `
                <div
                    id="card-${branch.id}"
                    onclick="selectBranch(${branch.id}, true)"
                    class="locator-card ${isSelected ? 'selected' : ''}"
                >
                    <div class="locator-card-top">
                        <div>
                            <span class="locator-city-badge">${branch.city}</span>
                            <h3 class="locator-branch-name">${branch.name}</h3>
                        </div>
                        <span class="locator-status-pill ${status.isOpen ? 'open' : 'closed'}">
                            <i class="fa-solid fa-circle" style="font-size: 6px;"></i>
                            ${status.badgeText}
                        </span>
                    </div>

                    <p class="locator-address">
                        <i class="fa-solid fa-location-dot" style="color: var(--primary); margin-right: 6px;"></i>${branch.address}
                    </p>

                    <div class="locator-info-rows">
                        <div>
                            <i class="fa-regular fa-clock" style="margin-right: 6px; width: 14px; text-align: center;"></i>
                            <span>${status.scheduleText} (${branch.days})</span>
                        </div>
                        <div>
                            <i class="fa-solid fa-phone" style="margin-right: 6px; width: 14px; text-align: center;"></i>
                            <span>${branch.phone}</span>
                        </div>
                    </div>

                    <div class="locator-tags">
                        ${(branch.tags || []).map(t => `<span class="locator-tag">${t}</span>`).join('')}
                    </div>

                    <div class="locator-card-actions" onclick="event.stopPropagation()">
                        <button type="button" onclick="focusBranchOnMap(${branch.id})" class="locator-btn-map">
                            <i class="fa-solid fa-map-pin"></i>
                            <span>Lihat di Peta</span>
                        </button>

                        <a href="${googleMapsUrl}" target="_blank" rel="noopener" class="locator-btn-dir">
                            <i class="fa-solid fa-diamond-turn-right" style="color: var(--primary);"></i>
                            <span>Petunjuk Arah</span>
                        </a>

                        <a
                            href="https://api.whatsapp.com/send?phone=${branch.whatsapp}&text=Halo%20${encodeURIComponent(branch.name)},%20saya%20ingin%20bertanya..."
                            target="_blank"
                            rel="noopener"
                            title="Hubungi WhatsApp"
                            class="locator-btn-wa"
                        >
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            `;
        }).join("");
    }

    function selectBranch(id, panToMap = true) {
        selectedBranchId = id;
        const branch = branchData.find(b => b.id === id);
        if (!branch) return;

        document.querySelectorAll(".custom-branch-pin").forEach(el => el.classList.remove("active"));
        const activePin = document.getElementById(`pin-${id}`);
        if (activePin) activePin.classList.add("active");

        renderBranches();

        const targetCard = document.getElementById(`card-${id}`);
        if (targetCard) {
            targetCard.scrollIntoView({ behavior: "smooth", block: "nearest" });
        }

        if (panToMap && locatorMarkers[id] && locatorMap) {
            locatorMap.flyTo([branch.lat, branch.lng], 15, {
                animate: true,
                duration: 1.2
            });
            locatorMarkers[id].openPopup();
        }

        if (window.innerWidth <= 900 && panToMap) {
            showMobileMap();
        }
    }

    function focusBranchOnMap(id) {
        selectBranch(id, true);
    }

    function filterByCity(city) {
        selectedCity = city;
        renderCityFilters();
        renderBranches();
        adjustMapToFilteredBranches();
    }

    function adjustMapToFilteredBranches() {
        const filtered = getFilteredBranches();
        if (filtered.length > 0 && locatorMap) {
            const bounds = L.latLngBounds(filtered.map(b => [b.lat, b.lng]));
            locatorMap.fitBounds(bounds, { padding: [50, 50], maxZoom: 14 });
        }
    }

    function resetFilters() {
        selectedCity = "Semua";
        searchQuery = "";
        openOnlyFilter = false;
        const searchInput = document.getElementById("searchInput");
        const filterOpenOnly = document.getElementById("filterOpenOnly");
        const clearSearchBtn = document.getElementById("clearSearchBtn");
        if (searchInput) searchInput.value = "";
        if (filterOpenOnly) filterOpenOnly.checked = false;
        if (clearSearchBtn) clearSearchBtn.classList.add("hidden");
        renderCityFilters();
        renderBranches();
        resetMapView();
    }

    function resetMapView() {
        if (!locatorMap || branchData.length === 0) return;
        const bounds = L.latLngBounds(branchData.map(b => [b.lat, b.lng]));
        locatorMap.fitBounds(bounds, { padding: [50, 50], maxZoom: 13 });
    }

    function centerOnUserLocation() {
        if (!navigator.geolocation) {
            showToast("Geolocation tidak didukung pada browser Anda.");
            return;
        }

        showToast("Mencari lokasi Anda...");

        navigator.geolocation.getCurrentPosition(
            (position) => {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;

                let closestBranch = null;
                let minDistance = Infinity;

                branchData.forEach(branch => {
                    const dist = getDistanceInKm(userLat, userLng, branch.lat, branch.lng);
                    if (dist < minDistance) {
                        minDistance = dist;
                        closestBranch = branch;
                    }
                });

                if (locatorMap && closestBranch) {
                    locatorMap.flyTo([userLat, userLng], 12);

                    const userCircle = L.circleMarker([userLat, userLng], {
                        radius: 8,
                        fillColor: "#f59e0b",
                        color: "#ffffff",
                        weight: 3,
                        opacity: 1,
                        fillOpacity: 0.95
                    }).addTo(locatorMap);

                    userCircle.bindPopup(`<b>Lokasi Anda</b><br>Cabang terdekat: <b>${closestBranch.name}</b> (${minDistance.toFixed(1)} km)`).openPopup();

                    showToast(`Cabang terdekat: ${closestBranch.name} (~${minDistance.toFixed(1)} km)`);

                    setTimeout(() => {
                        selectBranch(closestBranch.id, true);
                    }, 1500);
                }
            },
            () => {
                showToast("Izin lokasi tidak diberikan atau gagal didapatkan.");
            }
        );
    }

    function getDistanceInKm(lat1, lon1, lat2, lon2) {
        const R = 6371;
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c;
    }

    function showToast(message) {
        const toast = document.getElementById("toastNotification");
        const msg = document.getElementById("toastMessage");
        if (!toast || !msg) return;
        msg.textContent = message;
        toast.classList.remove("hidden");
        setTimeout(() => {
            toast.classList.add("hidden");
        }, 3500);
    }

    function setupLocatorListeners() {
        const searchInput = document.getElementById("searchInput");
        const clearSearchBtn = document.getElementById("clearSearchBtn");
        const filterOpenOnly = document.getElementById("filterOpenOnly");

        if (searchInput) {
            searchInput.addEventListener("input", (e) => {
                searchQuery = e.target.value;
                if (clearSearchBtn) {
                    if (searchQuery.length > 0) {
                        clearSearchBtn.classList.remove("hidden");
                    } else {
                        clearSearchBtn.classList.add("hidden");
                    }
                }
                renderBranches();
                adjustMapToFilteredBranches();
            });
        }

        if (clearSearchBtn) {
            clearSearchBtn.addEventListener("click", () => {
                if (searchInput) searchInput.value = "";
                searchQuery = "";
                clearSearchBtn.classList.add("hidden");
                renderBranches();
                adjustMapToFilteredBranches();
            });
        }

        if (filterOpenOnly) {
            filterOpenOnly.addEventListener("change", (e) => {
                openOnlyFilter = e.target.checked;
                renderBranches();
                adjustMapToFilteredBranches();
            });
        }

        const mobileListBtn = document.getElementById("mobileViewListBtn");
        const mobileMapBtn = document.getElementById("mobileViewMapBtn");

        if (mobileListBtn && mobileMapBtn) {
            mobileListBtn.addEventListener("click", () => showMobileList());
            mobileMapBtn.addEventListener("click", () => showMobileMap());
        }
    }

    function showMobileList() {
        const sidebar = document.getElementById("sidebarPanel");
        const mapPanel = document.getElementById("mapPanel");
        const listBtn = document.getElementById("mobileViewListBtn");
        const mapBtn = document.getElementById("mobileViewMapBtn");

        if (sidebar) sidebar.classList.remove("hidden");
        if (mapPanel) mapPanel.classList.add("hidden");
        if (listBtn) listBtn.classList.add("active");
        if (mapBtn) mapBtn.classList.remove("active");
    }

    function showMobileMap() {
        const sidebar = document.getElementById("sidebarPanel");
        const mapPanel = document.getElementById("mapPanel");
        const listBtn = document.getElementById("mobileViewListBtn");
        const mapBtn = document.getElementById("mobileViewMapBtn");

        if (sidebar) sidebar.classList.add("hidden");
        if (mapPanel) mapPanel.classList.remove("hidden");
        if (mapBtn) mapBtn.classList.add("active");
        if (listBtn) listBtn.classList.remove("active");

        setTimeout(() => {
            if (locatorMap) locatorMap.invalidateSize();
        }, 120);
    }
</script>
@endpush

