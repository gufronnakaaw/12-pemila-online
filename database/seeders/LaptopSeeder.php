<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaptopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('laptops')->insert([
            [
                'name_laptop' => 'laptop 6',
                'brand_laptop' => 'HP',
                'status' => 'unused',
                'img_laptop' => 'default-laptop.jpg',
                'created_at' => now(),
            ],
            [
                'name_laptop' => 'laptop 7',
                'brand_laptop' => 'HP',
                'status' => 'unused',
                'img_laptop' => 'default-laptop.jpg',
                'created_at' => now(),
            ],
            [
                'name_laptop' => 'laptop 8',
                'brand_laptop' => 'HP',
                'status' => 'unused',
                'img_laptop' => 'default-laptop.jpg',
                'created_at' => now(),
            ],
            [
                'name_laptop' => 'laptop 9',
                'brand_laptop' => 'HP',
                'status' => 'unused',
                'img_laptop' => 'default-laptop.jpg',
                'created_at' => now(),
            ],
            [
                'name_laptop' => 'laptop 10',
                'brand_laptop' => 'HP',
                'status' => 'unused',
                'img_laptop' => 'default-laptop.jpg',
                'created_at' => now(),
            ],
        ]);
    }
}
