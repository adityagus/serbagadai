<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Throwable;

class TaksiranService
{
    /**
     * Daftar Kategori Khusus Elektronik
     */
    public static function getCategories(): array
    {
        return [
            [
                'id' => 'all',
                'name' => 'Semua Jenis Elektronik',
                'icon' => 'grid'
            ],
            [
                'id' => 'smartphone',
                'name' => 'Smartphone & Tablet',
                'icon' => 'smartphone',
                'desc' => 'iPhone, Samsung Galaxy, iPad, Xiaomi, Oppo, Vivo, dll.'
            ],
            [
                'id' => 'laptop',
                'name' => 'Laptop & Komputer',
                'icon' => 'laptop',
                'desc' => 'MacBook, Asus ROG/ZenBook, Lenovo Legion, HP, Acer, dll.'
            ],
            [
                'id' => 'kamera',
                'name' => 'Kamera & Lensa',
                'icon' => 'camera',
                'desc' => 'Sony Alpha, Canon EOS, Fujifilm, Nikon Mirrorless & DSLR.'
            ],
            [
                'id' => 'tv_audio',
                'name' => 'Smart TV & Audio',
                'icon' => 'tv',
                'desc' => 'Smart TV LED/OLED Samsung/LG, Speaker Marshall, JBL, Soundbar.'
            ],
            [
                'id' => 'gadget',
                'name' => 'Gadget & Konsol Game',
                'icon' => 'gamepad',
                'desc' => 'PlayStation 5, Nintendo Switch, Apple Watch, Drone DJI.'
            ],
        ];
    }

    /**
     * Hitung Biaya Administrasi (Tanpa Biaya Admin = 0)
     */
    public static function calculateAdminFee(float $pinjaman): float
    {
        return 0;
    }

        public static function getElectronicsCatalog(): array
    {
        return [
            // SMARTPHONE & TABLET
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 16 Pro Max 1TB', 'base_price' => 27500000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 16 Pro Max 512GB', 'base_price' => 24500000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 16 Pro Max 256GB', 'base_price' => 22000000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 16 Pro 256GB', 'base_price' => 19500000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 16 Pro 128GB', 'base_price' => 17500000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 16 Plus 128GB', 'base_price' => 15000000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 16 128GB', 'base_price' => 13500000],

            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 15 Pro Max 512GB', 'base_price' => 19000000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 15 Pro Max 256GB', 'base_price' => 17000000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 15 Pro 128GB', 'base_price' => 14000000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 15 Plus 128GB', 'base_price' => 12500000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 15 128GB', 'base_price' => 11000000],

            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 14 Pro Max 256GB', 'base_price' => 14500000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 14 Pro Max 128GB', 'base_price' => 13200000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 14 Pro 128GB', 'base_price' => 11800000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 14 128GB', 'base_price' => 9000000],

            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 13 Pro Max 128GB', 'base_price' => 10500000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 13 Pro 128GB', 'base_price' => 9200000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 13 128GB', 'base_price' => 7800000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 12 Pro Max 128GB', 'base_price' => 7900000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 12 128GB', 'base_price' => 5800000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 11 128GB', 'base_price' => 4500000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPhone 11 64GB', 'base_price' => 3800000],

            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPad Pro 13" M4 256GB WiFi', 'base_price' => 18000000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPad Pro 11" M4 256GB WiFi', 'base_price' => 14500000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPad Air 11" M2 128GB WiFi', 'base_price' => 9000000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPad Air 5 M1 64GB WiFi', 'base_price' => 6800000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPad 10th Gen 64GB WiFi', 'base_price' => 4600000],
            ['category' => 'smartphone', 'brand' => 'Apple', 'name' => 'iPad Mini 6 64GB WiFi', 'base_price' => 5200000],

            ['category' => 'smartphone', 'brand' => 'Samsung', 'name' => 'Samsung Galaxy S24 Ultra 512GB', 'base_price' => 17500000],
            ['category' => 'smartphone', 'brand' => 'Samsung', 'name' => 'Samsung Galaxy S24 Ultra 256GB', 'base_price' => 15500000],
            ['category' => 'smartphone', 'brand' => 'Samsung', 'name' => 'Samsung Galaxy S24+ 256GB', 'base_price' => 12000000],
            ['category' => 'smartphone', 'brand' => 'Samsung', 'name' => 'Samsung Galaxy S24 256GB', 'base_price' => 10000000],
            ['category' => 'smartphone', 'brand' => 'Samsung', 'name' => 'Samsung Galaxy Z Fold 6 256GB', 'base_price' => 20000000],
            ['category' => 'smartphone', 'brand' => 'Samsung', 'name' => 'Samsung Galaxy Z Flip 6 256GB', 'base_price' => 12500000],
            ['category' => 'smartphone', 'brand' => 'Samsung', 'name' => 'Samsung Galaxy S23 Ultra 256GB', 'base_price' => 11800000],
            ['category' => 'smartphone', 'brand' => 'Samsung', 'name' => 'Samsung Galaxy S23 128GB', 'base_price' => 7500000],
            ['category' => 'smartphone', 'brand' => 'Samsung', 'name' => 'Samsung Galaxy A55 5G 256GB', 'base_price' => 4500000],
            ['category' => 'smartphone', 'brand' => 'Samsung', 'name' => 'Samsung Galaxy A54 5G 256GB', 'base_price' => 3700000],
            ['category' => 'smartphone', 'brand' => 'Samsung', 'name' => 'Samsung Galaxy Tab S9 Ultra', 'base_price' => 14000000],
            ['category' => 'smartphone', 'brand' => 'Samsung', 'name' => 'Samsung Galaxy Tab S9 FE', 'base_price' => 5200000],

            ['category' => 'smartphone', 'brand' => 'Xiaomi', 'name' => 'Xiaomi 14 512GB', 'base_price' => 9500000],
            ['category' => 'smartphone', 'brand' => 'Xiaomi', 'name' => 'Xiaomi 13T 256GB', 'base_price' => 4800000],
            ['category' => 'smartphone', 'brand' => 'Xiaomi', 'name' => 'POCO F6 512GB', 'base_price' => 4500000],
            ['category' => 'smartphone', 'brand' => 'Xiaomi', 'name' => 'Redmi Note 13 Pro+ 5G 512GB', 'base_price' => 4200000],

            ['category' => 'smartphone', 'brand' => 'Oppo', 'name' => 'Oppo Find N3 Flip', 'base_price' => 8800000],
            ['category' => 'smartphone', 'brand' => 'Oppo', 'name' => 'Oppo Reno 12 Pro 5G 512GB', 'base_price' => 6200000],
            ['category' => 'smartphone', 'brand' => 'Vivo', 'name' => 'Vivo X100 Pro 512GB', 'base_price' => 11500000],
            ['category' => 'smartphone', 'brand' => 'Vivo', 'name' => 'Vivo V30 Pro 512GB', 'base_price' => 5000000],

            // LAPTOP & KOMPUTER
            ['category' => 'laptop', 'brand' => 'Apple', 'name' => 'MacBook Pro 16" M3 Max 36GB/1TB', 'base_price' => 42000000],
            ['category' => 'laptop', 'brand' => 'Apple', 'name' => 'MacBook Pro 14" M3 Pro 18GB/512GB', 'base_price' => 26000000],
            ['category' => 'laptop', 'brand' => 'Apple', 'name' => 'MacBook Pro 14" M3 8GB/512GB', 'base_price' => 19500000],
            ['category' => 'laptop', 'brand' => 'Apple', 'name' => 'MacBook Air 15" M3 8GB/256GB', 'base_price' => 15500000],
            ['category' => 'laptop', 'brand' => 'Apple', 'name' => 'MacBook Air 13" M3 8GB/256GB', 'base_price' => 14000000],
            ['category' => 'laptop', 'brand' => 'Apple', 'name' => 'MacBook Air 13" M2 8GB/256GB', 'base_price' => 11500000],
            ['category' => 'laptop', 'brand' => 'Apple', 'name' => 'MacBook Air 13" M1 8GB/256GB', 'base_price' => 8200000],
            ['category' => 'laptop', 'brand' => 'Apple', 'name' => 'MacBook Pro 13" M2 8GB/256GB', 'base_price' => 12500000],
            ['category' => 'laptop', 'brand' => 'Apple', 'name' => 'MacBook Pro 13" M1 8GB/256GB', 'base_price' => 9500000],

            ['category' => 'laptop', 'brand' => 'Asus', 'name' => 'Asus ROG Zephyrus G16 (RTX 4070)', 'base_price' => 26000000],
            ['category' => 'laptop', 'brand' => 'Asus', 'name' => 'Asus ROG Strix G16 (RTX 4060)', 'base_price' => 18500000],
            ['category' => 'laptop', 'brand' => 'Asus', 'name' => 'Asus TUF Gaming A15 (RTX 4060)', 'base_price' => 14000000],
            ['category' => 'laptop', 'brand' => 'Asus', 'name' => 'Asus TUF Gaming F15 (RTX 3050)', 'base_price' => 9000000],
            ['category' => 'laptop', 'brand' => 'Asus', 'name' => 'Asus ZenBook 14 OLED (Core Ultra 7)', 'base_price' => 15000000],
            ['category' => 'laptop', 'brand' => 'Asus', 'name' => 'Asus VivoBook 14 i5 Gen 12', 'base_price' => 5800000],

            ['category' => 'laptop', 'brand' => 'Lenovo', 'name' => 'Lenovo Legion Pro 5 (RTX 4070)', 'base_price' => 23000000],
            ['category' => 'laptop', 'brand' => 'Lenovo', 'name' => 'Lenovo Legion 5 (RTX 4060)', 'base_price' => 16500000],
            ['category' => 'laptop', 'brand' => 'Lenovo', 'name' => 'Lenovo LOQ 15 (RTX 4050)', 'base_price' => 11000000],
            ['category' => 'laptop', 'brand' => 'Lenovo', 'name' => 'Lenovo ThinkPad X1 Carbon Gen 11', 'base_price' => 19000000],
            ['category' => 'laptop', 'brand' => 'Lenovo', 'name' => 'Lenovo IdeaPad Slim 3 i5 Gen 12', 'base_price' => 5500000],

            ['category' => 'laptop', 'brand' => 'Acer', 'name' => 'Acer Predator Helios 16 (RTX 4070)', 'base_price' => 21000000],
            ['category' => 'laptop', 'brand' => 'Acer', 'name' => 'Acer Nitro V 15 (RTX 4050)', 'base_price' => 10500000],
            ['category' => 'laptop', 'brand' => 'Acer', 'name' => 'Acer Swift Go 14 OLED', 'base_price' => 9500000],

            ['category' => 'laptop', 'brand' => 'HP', 'name' => 'HP Omen 16 (RTX 4060)', 'base_price' => 16000000],
            ['category' => 'laptop', 'brand' => 'HP', 'name' => 'HP Victus 15 (RTX 3050)', 'base_price' => 8800000],
            ['category' => 'laptop', 'brand' => 'HP', 'name' => 'HP Pavilion 14 i5 Gen 12', 'base_price' => 6200000],

            // KAMERA & LENSA
            ['category' => 'kamera', 'brand' => 'Sony', 'name' => 'Sony Alpha A7 IV (Body Only)', 'base_price' => 26500000],
            ['category' => 'kamera', 'brand' => 'Sony', 'name' => 'Sony Alpha A7 III (Body Only)', 'base_price' => 16000000],
            ['category' => 'kamera', 'brand' => 'Sony', 'name' => 'Sony Alpha A7C II (Body Only)', 'base_price' => 25000000],
            ['category' => 'kamera', 'brand' => 'Sony', 'name' => 'Sony Alpha A6700 (Body Only)', 'base_price' => 17500000],
            ['category' => 'kamera', 'brand' => 'Sony', 'name' => 'Sony Alpha A6400 + Kit 16-50mm', 'base_price' => 9800000],
            ['category' => 'kamera', 'brand' => 'Sony', 'name' => 'Sony ZV-E10 + Kit 16-50mm', 'base_price' => 7800000],
            ['category' => 'kamera', 'brand' => 'Sony', 'name' => 'Lensa Sony FE 24-70mm f/2.8 GM II', 'base_price' => 24000000],

            ['category' => 'kamera', 'brand' => 'Canon', 'name' => 'Canon EOS R6 Mark II (Body Only)', 'base_price' => 28000000],
            ['category' => 'kamera', 'brand' => 'Canon', 'name' => 'Canon EOS R8 (Body Only)', 'base_price' => 16500000],
            ['category' => 'kamera', 'brand' => 'Canon', 'name' => 'Canon EOS R50 + Kit 18-45mm', 'base_price' => 8500000],
            ['category' => 'kamera', 'brand' => 'Canon', 'name' => 'Canon EOS 90D + Kit 18-135mm', 'base_price' => 11000000],

            ['category' => 'kamera', 'brand' => 'Fujifilm', 'name' => 'Fujifilm X-T5 (Body Only)', 'base_price' => 22000000],
            ['category' => 'kamera', 'brand' => 'Fujifilm', 'name' => 'Fujifilm X100VI', 'base_price' => 27000000],
            ['category' => 'kamera', 'brand' => 'Fujifilm', 'name' => 'Fujifilm X-S20 (Body Only)', 'base_price' => 16000000],
            ['category' => 'kamera', 'brand' => 'Fujifilm', 'name' => 'Fujifilm X-T30 II + Kit 15-45mm', 'base_price' => 11500000],

            // SMART TV & AUDIO
            ['category' => 'tv_audio', 'brand' => 'Samsung', 'name' => 'Samsung Smart TV Neo QLED 65" 4K (QN85D)', 'base_price' => 18000000],
            ['category' => 'tv_audio', 'brand' => 'Samsung', 'name' => 'Samsung Smart TV OLED 55" 4K (S90D)', 'base_price' => 16500000],
            ['category' => 'tv_audio', 'brand' => 'Samsung', 'name' => 'Samsung Smart TV QLED 55" 4K (Q60D)', 'base_price' => 8000000],
            ['category' => 'tv_audio', 'brand' => 'Samsung', 'name' => 'Samsung Smart TV UHD 50" 4K (DU7000)', 'base_price' => 4500000],
            ['category' => 'tv_audio', 'brand' => 'Samsung', 'name' => 'Samsung Smart TV 43" Full HD T6500', 'base_price' => 2800000],

            ['category' => 'tv_audio', 'brand' => 'LG', 'name' => 'LG OLED evo C3 55" 4K', 'base_price' => 16000000],
            ['category' => 'tv_audio', 'brand' => 'LG', 'name' => 'LG QNED 55" 4K Smart TV', 'base_price' => 7500000],
            ['category' => 'tv_audio', 'brand' => 'LG', 'name' => 'LG UHD 43" 4K Smart TV UR7500', 'base_price' => 3600000],

            ['category' => 'tv_audio', 'brand' => 'Marshall', 'name' => 'Marshall Stanmore III Bluetooth Speaker', 'base_price' => 4800000],
            ['category' => 'tv_audio', 'brand' => 'Marshall', 'name' => 'Marshall Acton III Bluetooth Speaker', 'base_price' => 3600000],
            ['category' => 'tv_audio', 'brand' => 'Marshall', 'name' => 'Marshall Emberton II Portable Speaker', 'base_price' => 2100000],
            ['category' => 'tv_audio', 'brand' => 'JBL', 'name' => 'JBL PartyBox 310 Portable Speaker', 'base_price' => 6500000],
            ['category' => 'tv_audio', 'brand' => 'JBL', 'name' => 'JBL Boombox 3 Bluetooth Speaker', 'base_price' => 5200000],

            // GADGET & KONSOL GAME
            ['category' => 'gadget', 'brand' => 'Sony', 'name' => 'Sony PlayStation 5 Slim Disc Edition', 'base_price' => 7200000],
            ['category' => 'gadget', 'brand' => 'Sony', 'name' => 'Sony PlayStation 5 Slim Digital Edition', 'base_price' => 6200000],
            ['category' => 'gadget', 'brand' => 'Sony', 'name' => 'Sony PlayStation 5 Fat Disc Edition', 'base_price' => 5800000],
            ['category' => 'gadget', 'brand' => 'Sony', 'name' => 'PlayStation Portal Remote Player', 'base_price' => 3000000],
            ['category' => 'gadget', 'brand' => 'Sony', 'name' => 'PlayStation VR2 Horizon Bundle', 'base_price' => 6500000],

            ['category' => 'gadget', 'brand' => 'Nintendo', 'name' => 'Nintendo Switch OLED Model', 'base_price' => 3800000],
            ['category' => 'gadget', 'brand' => 'Nintendo', 'name' => 'Nintendo Switch V2 Neon/Grey', 'base_price' => 2600000],
            ['category' => 'gadget', 'brand' => 'Nintendo', 'name' => 'Nintendo Switch Lite', 'base_price' => 1700000],

            ['category' => 'gadget', 'brand' => 'Valve', 'name' => 'Steam Deck OLED 512GB', 'base_price' => 7800000],
            ['category' => 'gadget', 'brand' => 'Asus', 'name' => 'Asus ROG Ally Z1 Extreme 512GB', 'base_price' => 7500000],

            ['category' => 'gadget', 'brand' => 'Apple', 'name' => 'Apple Watch Ultra 2 Titanium 49mm', 'base_price' => 11000000],
            ['category' => 'gadget', 'brand' => 'Apple', 'name' => 'Apple Watch Series 9 45mm GPS', 'base_price' => 5400000],
            ['category' => 'gadget', 'brand' => 'Apple', 'name' => 'Apple Watch SE 2 44mm GPS', 'base_price' => 3200000],

            ['category' => 'gadget', 'brand' => 'DJI', 'name' => 'DJI Mini 4 Pro Fly More Combo Plus (RC 2)', 'base_price' => 13500000],
            ['category' => 'gadget', 'brand' => 'DJI', 'name' => 'DJI Mini 3 Pro Fly More Combo', 'base_price' => 8800000],
            ['category' => 'gadget', 'brand' => 'DJI', 'name' => 'DJI Osmo Pocket 3 Creator Combo', 'base_price' => 7800000],
            ['category' => 'gadget', 'brand' => 'DJI', 'name' => 'DJI Action 4 Standard Combo', 'base_price' => 4200000],
        ];
    }
    
    /**
     * Hitung Estimasi Rentang Nilai Taksiran & Pencairan (Grade Terendah 40% s/d Tertinggi 100% dari STLE)
     */
    public static function calculateGradeBreakdown(float $basePrice): array
    {
        $minPencairan = round($basePrice * 0.40);
        $maxPencairan = round($basePrice * 1.00);

        $range = [
            'taksir_min' => $minPencairan,
            'taksir_max' => $maxPencairan,
            'pinjaman_min' => $minPencairan,
            'pinjaman_max' => $maxPencairan,
            'pencairan_min' => $minPencairan,
            'pencairan_max' => $maxPencairan,
            'admin_min' => 0,
            'admin_max' => 0,

            'taksir_range_fmt' => 'Rp ' . number_format($minPencairan, 0, ',', '.') . ' - Rp ' . number_format($maxPencairan, 0, ',', '.'),
            'pinjaman_range_fmt' => 'Rp ' . number_format($minPencairan, 0, ',', '.') . ' - Rp ' . number_format($maxPencairan, 0, ',', '.'),
            'pencairan_range_fmt' => 'Rp ' . number_format($minPencairan, 0, ',', '.') . ' - Rp ' . number_format($maxPencairan, 0, ',', '.'),
            'admin_range_fmt' => 'Rp 0',
        ];

        return [
            'range' => $range,
        ];
    }

    /**
     * Search Elektronik dari Database db2 (db_gadaimulia) atau Fallback Catalog
     */
    public static function search(string $category = '', string $keyword = '', string $code = '', int $limit = 12): array
    {
        $keyword = trim($keyword);
        $code = trim($code);

        // 1. Coba query dari Database db2 (product.collateral_item_details & collateral_item_prices)
        $dbResults = self::searchFromDb2($category, $keyword, $code, $limit);
        if (!empty($dbResults)) {
            return $dbResults;
        }

        // 2. Fallback: Filter dari Master Catalog Lokal
        return self::searchFromCatalog($category, $keyword, $code, $limit);
    }

    /**
     * Query data barang elektronik langsung dari db2 (db_gadaimulia)
     */
    protected static function searchFromDb2(string $category, string $keyword, string $code = '', int $limit = 12): array
    {
        $categoryMap = [
            'smartphone' => ['HANDPHONE', 'HANDPHONE-001', 'TABLET', 'TABLET-001'],
            'laptop'     => ['LAPTOP', 'PC-ALL-IN-ONE'],
            'kamera'     => ['KAMERA'],
            'tv_audio'   => ['TELEVISI'],
            'gadget'     => ['KONSOL', 'SMART WATCH', 'DRONE'],
        ];

        $allElectronicCodes = ['HANDPHONE', 'HANDPHONE-001', 'TABLET', 'TABLET-001', 'LAPTOP', 'PC-ALL-IN-ONE', 'TELEVISI', 'KAMERA', 'KONSOL', 'SMART WATCH', 'DRONE'];

        try {
            $db2 = DB::connection('db2');

            // Model Modern: product.collateral_item_details
            $query = $db2->table('product.collateral_item_details as d')
                ->join('product.collateral_items as c', 'c.collateral_items_id', '=', 'd.collateral_item_id')
                ->leftJoin('product.collateral_item_prices as p', function ($join) {
                    $join->on('p.collateral_item_detail_id', '=', 'd.collateral_item_detail_id')
                         ->where('p.is_active', true)
                         ->where('p.price', '>', 100000);
                });

            if (!empty($category) && isset($categoryMap[$category])) {
                $query->whereIn('c.code', $categoryMap[$category]);
            } else {
                $query->whereIn('c.code', $allElectronicCodes);
            }

            if (!empty($code)) {
                $query->where(function ($q) use ($code, $keyword) {
                    $q->where('d.code', $code);
                    if (!empty($keyword)) {
                        $q->orWhere('d.name', 'ILIKE', '%' . $keyword . '%');
                    }
                });
                $query->orderByRaw("CASE WHEN d.code = ? THEN 0 ELSE 1 END", [$code]);
            } elseif (!empty($keyword)) {
                $query->where('d.name', 'ILIKE', '%' . $keyword . '%');
            }

            $rows = $query->selectRaw('
                d.collateral_item_detail_id,
                d.code,
                d.name,
                c.name as category_name,
                c.code as category_code,
                MIN(p.price) as min_price,
                MAX(p.price) as max_price,
                AVG(p.price) as avg_price
            ')
            ->groupBy('d.collateral_item_detail_id', 'd.code', 'd.name', 'c.name', 'c.code')
            ->orderBy('d.name', 'ASC')
            ->limit($limit)
            ->get();

            if ($rows->isNotEmpty()) {
                $list = [];
                foreach ($rows as $row) {
                    $stle = (float) $row->max_price;
                    if ($stle <= 100000) {
                        $stle = (float) $row->min_price;
                    }
                    if ($stle <= 100000) {
                        $stle = 5000000;
                    }

                    // Grade paling rendah 40% dan paling tinggi 100% dari harga STLE, tanpa biaya admin
                    $minPencairan = round($stle * 0.40);
                    $maxPencairan = round($stle * 1.00);

                    $range = [
                        'taksir_min' => $minPencairan,
                        'taksir_max' => $maxPencairan,
                        'pinjaman_min' => $minPencairan,
                        'pinjaman_max' => $maxPencairan,
                        'pencairan_min' => $minPencairan,
                        'pencairan_max' => $maxPencairan,
                        'admin_min' => 0,
                        'admin_max' => 0,

                        'taksir_range_fmt' => 'Rp ' . number_format($minPencairan, 0, ',', '.') . ' - Rp ' . number_format($maxPencairan, 0, ',', '.'),
                        'pinjaman_range_fmt' => 'Rp ' . number_format($minPencairan, 0, ',', '.') . ' - Rp ' . number_format($maxPencairan, 0, ',', '.'),
                        'pencairan_range_fmt' => 'Rp ' . number_format($minPencairan, 0, ',', '.') . ' - Rp ' . number_format($maxPencairan, 0, ',', '.'),
                        'admin_range_fmt' => 'Rp 0',
                    ];

                    $list[] = [
                        'code' => $row->code ?: strtoupper(substr(md5($row->name), 0, 8)),
                        'name' => $row->name,
                        'brand' => $row->category_name ?: 'Elektronik',
                        'category' => $category ?: 'electronics',
                        'base_price' => $stle,
                        'base_price_fmt' => 'Rp ' . number_format($stle, 0, ',', '.'),
                        'breakdown' => [
                            'range' => $range,
                        ],
                    ];
                }

                return $list;
            }
        } catch (Throwable $e) {
            // DB2 error / timeout, proceed to fallback
        }

        // Coba model lama (tblbarang) jika ada
        try {
            $db2 = DB::connection('db2');
            $legacyQuery = $db2->table('tblbarang as b')
                ->join('tblbarang_detail as bd', 'bd.fk_barang', '=', 'b.kd_barang')
                ->where('b.barang_active', 'true')
                ->where('bd.fk_wilayah', '2');

            if (!empty($code)) {
                $legacyQuery->where('b.kd_barang', $code);
            } elseif (!empty($keyword)) {
                $legacyQuery->where('b.nm_barang', 'ILIKE', '%' . $keyword . '%');
            }

            $legacyRows = $legacyQuery->select('b.kd_barang', 'b.nm_barang', 'bd.harga')->limit($limit)->get();
            if ($legacyRows->isNotEmpty()) {
                $list = [];
                foreach ($legacyRows as $r) {
                    $basePrice = (float) $r->harga;
                    if ($basePrice <= 0) continue;

                    $breakdown = self::calculateGradeBreakdown($basePrice);
                    $list[] = [
                        'code' => $r->kd_barang,
                        'name' => $r->nm_barang,
                        'brand' => 'Elektronik',
                        'category' => $category ?: 'electronics',
                        'base_price' => $basePrice,
                        'base_price_fmt' => 'Rp ' . number_format($basePrice, 0, ',', '.'),
                        'breakdown' => $breakdown,
                    ];
                }
                if (!empty($list)) return $list;
            }
        } catch (Throwable $e) {
            // Ignore
        }

        return [];
    }

    /**
     * Search fallback dari katalog lokal
     */
    protected static function searchFromCatalog(string $category, string $keyword, string $code = '', int $limit = 12): array
    {
        $catalog = self::getElectronicsCatalog();
        $results = [];
        $lowerKw = strtolower($keyword);
        $upperCode = strtoupper($code);

        foreach ($catalog as $item) {
            if (!empty($category) && $category !== 'all' && $item['category'] !== $category) {
                continue;
            }

            $itemCode = strtoupper(substr(md5($item['name']), 0, 8));

            if (!empty($upperCode) && $itemCode === $upperCode) {
                $breakdown = self::calculateGradeBreakdown($item['base_price']);
                return [[
                    'code' => $itemCode,
                    'name' => $item['name'],
                    'brand' => $item['brand'],
                    'category' => $item['category'],
                    'base_price' => $item['base_price'],
                    'base_price_fmt' => 'Rp ' . number_format($item['base_price'], 0, ',', '.'),
                    'breakdown' => $breakdown,
                ]];
            }

            if (!empty($lowerKw)) {
                $itemName = strtolower($item['name']);
                $itemBrand = strtolower($item['brand']);
                if (!str_contains($itemName, $lowerKw) && !str_contains($itemBrand, $lowerKw)) {
                    continue;
                }
            }

            $breakdown = self::calculateGradeBreakdown($item['base_price']);

            $results[] = [
                'code' => $itemCode,
                'name' => $item['name'],
                'brand' => $item['brand'],
                'category' => $item['category'],
                'base_price' => $item['base_price'],
                'base_price_fmt' => 'Rp ' . number_format($item['base_price'], 0, ',', '.'),
                'breakdown' => $breakdown,
            ];

            if (count($results) >= $limit) {
                break;
            }
        }

        return $results;
    }
}

