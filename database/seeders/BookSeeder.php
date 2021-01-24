<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        foreach(range(1,20) as $index){
            DB::table('books')->insert([
                'naslov' => $faker->sentence(2),
                'ime_autora' => $faker->sentence(2),
                'izdavac' => $faker->sentence(1),
                'kategorija' =>$faker->sentence(1),
                'stampara' => $faker->sentence(2),
                'status' => 'SLOBODNA'
            ]);
        }
    }
}
