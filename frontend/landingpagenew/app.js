// Global state
let currentTab = 'emas';
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
    'tv': 0.45
};

// Formats number to IDR currency style
function formatIDR(amount) {
    return 'Rp ' + amount.toLocaleString('id-ID');
}

// Switch between tabs
function switchTab(tab) {
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
    document.getElementById(id).innerText = val;
}

// Update Price range text specifically
function updatePriceText(val) {
    priceTxt.innerText = Number(val).toLocaleString('id-ID');
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
    waSubmitBtn.href = `https://api.whatsapp.com/send?phone=6281181126771&text=${encodeURIComponent(textMsg)}`;
}

// Calculate Electronics Loan values
function calculateElectronics() {
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
    waSubmitBtn.href = `https://api.whatsapp.com/send?phone=6281181126771&text=${encodeURIComponent(textMsg)}`;
}

// Testimonials Slider logic
const testiContainer = document.getElementById('testi-container');
const totalSlides = 3; // Static number of cards

function slideTesti(direction) {
    if (direction === 'next') {
        currentSlide = (currentSlide + 1) % totalSlides;
    } else {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    }
    const offset = currentSlide * -100;
    testiContainer.style.transform = `translateX(${offset}%)`;
}

// Auto slider for testimonials every 6 seconds
setInterval(() => {
    slideTesti('next');
}, 6000);

// Initialize calculations
window.onload = () => {
    calculateGold();
};
