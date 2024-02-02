<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Sikayet;


class SikayetTableSeeder extends Seeder
{
    public function run()
    {
        // Use Faker to generate random data
        $faker = Faker::create();

        // Insert 100 random records
        for ($i = 0; $i < 100; $i++) {
            try {
                Sikayet::create([
                    'sikayetci' => $faker->numberBetween(1, 3),
                    'operator_id' => $faker->numberBetween(1, 3),
                    'movzu' => $faker->sentence,
                    'metn' => $faker->paragraph,
                    'fayllar' => $faker->word . '.txt',
                ]);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
    }
}
