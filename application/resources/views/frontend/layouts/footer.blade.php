<!-- Footer -->
<footer class="footer-section">
    <div class="container footer-grid">
        <div class="footer-brand">
            <div class="footer-logo-brand">
                <img src="{{ url('serbamulia/assets/logo-white.png') }}" alt="{{ @$CONF->title ?? 'Serba Gadai' }}" class="brand-logo-img">
            </div>
            <p class="brand-desc">Serba Gadai memberikan solusi finansial cepat, aman, dan terpercaya khusus layanan gadai barang elektronik (Smartphone, Laptop, Kamera, TV, & Gadget) resmi di bawah pengawasan OJK.</p>
            <div class="ojk-logo-footer">
                <div class="ojk-seal">TERDAFTAR & DIAWASI OJK</div>
            </div>
        </div>
        
        <div class="footer-links-group">
            <h4 class="footer-title">Tautan Pintar</h4>
            <div class="footer-links">
                <a href="{{ route('home') }}">Beranda</a>
                <a href="{{ route('simulasi') }}">Simulasi Taksiran</a>
                <a href="{{ route('about') }}">Tentang Kami</a>
                <a href="{{ route('services') }}">Produk & Layanan</a>
                <a href="{{ route('promo') }}">Promo</a>
                <a href="{{ route('outlet') }}">Cabang</a>
                <a href="{{ route('career') }}">Karir</a>
                <a href="{{ route('article') }}">Artikel</a>
                <a href="{{ route('contact') }}">Hubungi Kami</a>
            </div>
        </div>

        <div class="footer-links-group">
            <h4 class="footer-title">Kantor Pusat</h4>
            <p class="footer-text">{{ !empty($CONF->address) ? $CONF->address : 'Kirana Three Office Tower, Lt. 15. Kelapa Gading, Jakarta Utara, DKI Jakarta 14240' }}</p>
            <p class="footer-text">Hubungi: {{ !empty($CONF->phone) ? $CONF->phone : '0811-8112-6771' }} (WhatsApp)</p>
            <p class="footer-text">Email: {{ !empty($CONF->email) ? $CONF->email : 'cs@gadaimulia.com' }}</p>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container bottom-row">
            <p>© {{ date('Y') }} {{ @$CONF->title ?? 'PT. Gadai Mulia Sejahtera' }}. Hak Cipta Dilindungi. Berizin & Diawasi oleh Otoritas Jasa Keuangan (OJK).</p>
            <div class="social-links">
                @if(!empty($CONF->facebook))
                    <a href="{{ $CONF->facebook }}" target="_blank" rel="noopener">Facebook</a>
                @endif
                @if(!empty($CONF->instagram))
                    <a href="{{ $CONF->instagram }}" target="_blank" rel="noopener">Instagram</a>
                @endif
                @if(!empty($CONF->email))
                    <a href="mailto:{{ $CONF->email }}">Email Us</a>
                @endif
            </div>
        </div>
    </div>
</footer>

@php
    $waNumber = preg_replace('/[^0-9]/', '', @$CONF->whatsapp ?: '6281181126771');
@endphp
<a href="https://api.whatsapp.com/send?phone={{ $waNumber }}&text=Halo%20Admin%20Saya%20Ingin%20Bertanya%20terkait%20{{ urlencode(@$CONF->title ?? 'Gadai Mulia') }}" target="_blank" rel="noopener" class="wa-floating-btn" aria-label="Chat WhatsApp">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2ZM12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.15 12.04 20.15C10.56 20.15 9.11 19.76 7.85 19L7.55 18.83L4.43 19.65L5.26 16.61L5.06 16.29C4.24 14.98 3.8 13.47 3.8 11.91C3.81 7.37 7.5 3.67 12.05 3.67ZM8.53 7.33C8.37 7.33 8.1 7.39 7.87 7.64C7.65 7.89 7 8.5 7 9.71C7 10.93 7.89 12.1 8 12.27C8.14 12.44 9.76 14.94 12.25 16.02C14.36 16.93 14.79 16.75 15.23 16.7C15.68 16.66 16.69 16.1 16.89 15.53C17.1 14.96 17.1 14.47 17.04 14.36C16.97 14.26 16.81 14.2 16.56 14.08C16.31 13.95 15.09 13.35 14.87 13.27C14.64 13.18 14.48 13.14 14.31 13.39C14.15 13.64 13.67 14.2 13.53 14.36C13.38 14.53 13.24 14.55 12.99 14.43C12.74 14.3 11.94 14.04 11 13.2C10.26 12.54 9.77 11.73 9.62 11.48C9.48 11.23 9.61 11.1 9.73 10.97C9.84 10.86 9.98 10.68 10.1 10.54C10.23 10.39 10.27 10.29 10.35 10.13C10.43 9.96 10.39 9.82 10.33 9.7C10.27 9.57 9.77 8.35 9.56 7.86C9.36 7.38 9.16 7.44 9.01 7.43C8.86 7.43 8.7 7.33 8.53 7.33Z"/>
    </svg>
</a>
