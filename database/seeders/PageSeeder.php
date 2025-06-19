<?php

namespace Database\Seeders;

use App\Util\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('pages')->insert([
            'types' => Constant::PAGES_TYPES_HOME,
            'content'=> json_encode(new \stdClass()),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        \DB::table('pages')->insert([
            'types' => Constant::PAGES_TYPES_ABOUT,
            'content'=> json_encode(new \stdClass()),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        \DB::table('pages')->insert([
            'types' => Constant::PAGES_TYPES_PRODUCT,
            'content'=> json_encode(new \stdClass()),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        \DB::table('pages')->insert([
            'types' => Constant::PAGES_TYPES_CAREER,
            'content'=> json_encode(new \stdClass()),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
