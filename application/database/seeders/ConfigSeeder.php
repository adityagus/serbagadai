<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('config')->insert([
            'title' => 'Madani Jaya',
            'logo' => 'config/logo.png',
            'logoSecond' => 'config/logo-back.png',
            'icon' => 'config/favicon.ico',
            'email' => 'madanijaya@gmail.com',
            'phone' => '081398298744',
            'address' => 'Jl. Kemakmuran No.1, Mekar Jaya, Kec. Sukmajaya, Kota Depok, Jawa Barat 16411',
            'about' => 'Kami dari MADANI JAYA yang bergerak di bidang Copy Center, Sablon, Digital, Penjilidan & Percetakan, Kami Berdomisili di Kota Depok. Dengan di dukung tenaga yang profesional dan pelayanan yang ramah,dan kerja yang cepat. dengan harga yang kompetitif dan hasil yang berkualitas dan kerahasiaan dokumen yang pasti aman. MADANI JAYA juga melayani via online dan barang bisa dikirim lewat Tiki atau Tiki JNE',
            'facebook' => 'http://www.facebook.com/madanidigitalprinting',
            'twitter' => 'http://www.twitter.com',
            'instagram' => 'https://www.instagram.com/madanidigitalprinting',
            'whatsapp' => '6281398298744',
        ]);
    }
}
