<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $contacts = [];

        for ($i=0; $i <= 50; $i++) {
            $data['name'] = $faker->name;
            $data['phone'] = $faker->e164PhoneNumber;
            $data['email'] = $faker->email;
            $data['content'] = $faker->paragraph;
            $data['created_at'] = $faker->dateTime();
            $data['updated_at'] = $faker->dateTime();
            array_push($contacts, $data);
        }

        \DB::table('contacts')->insert($contacts);
    }
}
