<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonString = file_get_contents(storage_path('app/public/province.json'));
        $datas = json_decode($jsonString, true);

        foreach ($datas as $data){
            $province = new Province();
            $province->id = $data['id'];
            $province->name = $data['name'];
            $province->save();
        }
    }
}
