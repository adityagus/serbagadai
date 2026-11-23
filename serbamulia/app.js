// Global state
let currentTab = 'elektronik';
let currentSlide = 0;

// Elements
const tabEmas = document.getElementById('tab-emas');
const tabElektronik = document.getElementById('tab-elektronik');
const formEmas = document.getElementById('form-emas');
const formElektronik = document.getElementById('form-elektronik');

const emasKaratSelect = document.getElementById('emas-karat');
const emasBeratRange = document.getElementById('emas-berat');
const goldWeightTxt = document.getElementById('gold-weight-txt');

const elektronikJenisSelect = document.getElementById('elektronik-jenis');
const elektronikKondisiSelect = document.getElementById('elektronik-kondisi');
const elektronikHargaRange = document.getElementById('elektronik-harga');
const priceTxt = document.getElementById('price-txt');

const taksiranPinjamanEl = document.getElementById('taksiran-pinjaman');
const sewaModalEl = document.getElementById('sewa-modal');
const biayaAdminEl = document.getElementById('biaya-admin');
const waSubmitBtn = document.getElementById('wa-submit-btn');

// Gold price mapping per gram depending on karat purity
const GOLD_PRICES = {
    '24': 1250000, // 24 Karat (LM)
    '22': 1100000, // 22 Karat
    '18': 900000,  // 18 Karat
    '16': 750000   // 16 Karat
};

// Electronics type factors
const ELECTRONIC_FACTORS = {
    'smartphone': 0.55,
    'laptop': 0.50,
    'camera': 0.60,
    'tv': 0.45,
    'gadget': 0.50
};

function getWaPhone() {
    return window.GADAI_WA_PHONE || '6281181126771';
}

// Formats number to IDR currency style
function formatIDR(amount) {
    return 'Rp ' + amount.toLocaleString('id-ID');
}

// Switch between tabs
function switchTab(tab) {
    if (!tabEmas || !tabElektronik || !formEmas || !formElektronik) return;
    currentTab = tab;
    if (tab === 'emas') {
        tabEmas.classList.add('active');
        tabElektronik.classList.remove('active');
        formEmas.classList.remove('hidden');
        formElektronik.classList.add('hidden');
        calculateGold();
    } else {
        tabEmas.classList.remove('active');
        tabElektronik.classList.add('active');
        formEmas.classList.add('hidden');
        formElektronik.classList.remove('hidden');
        calculateElectronics();
    }
}

// Update value text on slider drag
function updateRangeText(id, val) {
    const el = document.getElementById(id);
    if (el) el.innerText = val;
}

// Update Price range text specifically
function updatePriceText(val) {
    if (priceTxt) priceTxt.innerText = Number(val).toLocaleString('id-ID');
}

// Calculate Admin Fee based on loan amount
function getAdminFee(loan) {
    if (loan <= 1000000) return 10000;
    if (loan <= 5000000) return 25000;
    if (loan <= 10000000) return 35000;
    return 50000;
}

// Calculate Gold Loan values
function calculateGold() {
    if (!emasKaratSelect || !emasBeratRange || !taksiranPinjamanEl || !sewaModalEl || !biayaAdminEl || !waSubmitBtn) return;
    const karat = emasKaratSelect.value;
    const berat = parseFloat(emasBeratRange.value);
    
    const pricePerGram = GOLD_PRICES[karat] || 750000;
    const goldValue = pricePerGram * berat;
    
    // Loan amount is 90% of gold value (Loan to Value)
    const loanAmount = Math.floor(goldValue * 0.90);
    
    // Sewa modal is 1.15% per 15 days
    const sewaModal = Math.floor(loanAmount * 0.0115);
    const adminFee = getAdminFee(loanAmount);
    
    // Update DOM
    taksiranPinjamanEl.innerText = formatIDR(loanAmount);
    sewaModalEl.innerText = formatIDR(sewaModal);
    biayaAdminEl.innerText = formatIDR(adminFee);
    
    // Update WA Link
    const textMsg = `Halo Admin Gadai Mulia, saya ingin bertanya / berkonsultasi mengenai simulasi Gadai Emas dengan detail:\n- Jenis: Emas ${karat} Karat\n- Berat: ${berat} gram\n- Taksiran Pinjaman: ${formatIDR(loanAmount)}\nMohon info persyaratannya.`;
    waSubmitBtn.href = `https://api.whatsapp.com/send?phone=${getWaPhone()}&text=${encodeURIComponent(textMsg)}`;
}

// Calculate Electronics Loan values
function calculateElectronics() {
    if (!elektronikJenisSelect || !elektronikKondisiSelect || !elektronikHargaRange || !taksiranPinjamanEl || !sewaModalEl || !biayaAdminEl || !waSubmitBtn) return;
    const jenis = elektronikJenisSelect.value;
    const kondisiFactor = parseFloat(elektronikKondisiSelect.value);
    const hargaBeli = parseFloat(elektronikHargaRange.value);
    
    const jenisFactor = ELECTRONIC_FACTORS[jenis] || 0.50;
    
    // Estimated current resale value
    const marketValue = hargaBeli * jenisFactor * kondisiFactor;
    
    // Loan amount is 70% of estimated resale value (Loan to Value for electronics)
    const loanAmount = Math.floor(marketValue * 0.70);
    
    // Sewa modal is 1.50% per 15 days (slightly higher for electronics due to depreciation)
    const sewaModal = Math.floor(loanAmount * 0.0150);
    const adminFee = getAdminFee(loanAmount);
    
    // Update DOM
    taksiranPinjamanEl.innerText = formatIDR(loanAmount);
    sewaModalEl.innerText = formatIDR(sewaModal);
    biayaAdminEl.innerText = formatIDR(adminFee);
    
    // Map human readable text for WA
    const jenisName = elektronikJenisSelect.options[elektronikJenisSelect.selectedIndex].text;
    const kondisiName = elektronikKondisiSelect.options[elektronikKondisiSelect.selectedIndex].text;
    
    // Update WA Link
    const textMsg = `Halo Admin Gadai Mulia, saya ingin bertanya / berkonsultasi mengenai simulasi Gadai Elektronik dengan detail:\n- Barang: ${jenisName}\n- Kondisi: ${kondisiName}\n- Estimasi Harga Beli: ${formatIDR(hargaBeli)}\n- Taksiran Pinjaman: ${formatIDR(loanAmount)}\nMohon info persyaratannya.`;
    waSubmitBtn.href = `https://api.whatsapp.com/send?phone=${getWaPhone()}&text=${encodeURIComponent(textMsg)}`;
}

// Testimonials Slider logic
const testiContainer = document.getElementById('testi-container');

function slideTesti(direction) {
    if (!testiContainer) return;
    const totalSlides = testiContainer.children.length;
    if (totalSlides <= 1) return;

    if (direction === 'next') {
        currentSlide = (currentSlide + 1) % totalSlides;
    } else {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    }
    const offset = currentSlide * -100;
    testiContainer.style.transform = `translateX(${offset}%)`;
}

// Auto slider for testimonials every 6 seconds
if (testiContainer && testiContainer.children.length > 1) {
    setInterval(() => {
        slideTesti('next');
    }, 6000);
}

// Initialize calculations
window.addEventListener('DOMContentLoaded', () => {
    calculateElectronics();
});

// ==========================================================================
// Modern Scroll Reveal Animations (IntersectionObserver)
// ==========================================================================
function initScrollAnimations() {
    // Check if user prefers reduced motion
    if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.querySelectorAll('[data-aos], .scroll-reveal').forEach(el => {
            el.classList.add('aos-animate', 'is-revealed');
        });
        return;
    }

    // Auto-discover and mark key elements across pages if not explicitly tagged
    const autoTargets = [
        { selector: '.trust-banner', animation: 'fade-up', delay: 100 },
        { selector: '.benefit-content', animation: 'fade-up', delay: 100 },
        { selector: '.benefit-card', animation: 'fade-up', stagger: 120 },
        { selector: '.cnaf-product-header', animation: 'fade-up', delay: 100 },
        { selector: '.cnaf-product-card', animation: 'fade-up', stagger: 120 },
        { selector: '.section-header-center', animation: 'fade-up', delay: 100 },
        { selector: '.product-card', animation: 'fade-up', stagger: 120 },
        { selector: '.why-text-side', animation: 'fade-right', delay: 100 },
        { selector: '.why-image-side', animation: 'fade-left', delay: 150 },
        { selector: '.feature-card', animation: 'fade-up', stagger: 100 },
        { selector: '.cnaf-testi-header', animation: 'fade-up', delay: 100 },
        { selector: '.cnaf-testi-wrapper', animation: 'fade-up', delay: 150 },
        { selector: '.locator-shell', animation: 'fade-up', delay: 100 },
        { selector: '.subhero-section', animation: 'fade-up', delay: 80 },
        { selector: '.o-card', animation: 'fade-up', stagger: 80 }
    ];

    autoTargets.forEach(group => {
        const elements = document.querySelectorAll(group.selector);
        elements.forEach((el, index) => {
            if (!el.hasAttribute('data-aos') && !el.classList.contains('scroll-reveal')) {
                el.setAttribute('data-aos', group.animation);
                const delay = group.stagger ? Math.min(index * group.stagger + 100, 600) : (group.delay || 100);
                el.setAttribute('data-aos-delay', delay);
            }
        });
    });

    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -40px 0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                target.classList.add('aos-animate', 'is-revealed');
                obs.unobserve(target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('[data-aos], .scroll-reveal').forEach(el => {
        observer.observe(el);
    });
}

// Attach listener
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initScrollAnimations);
} else {
    initScrollAnimations();
}
