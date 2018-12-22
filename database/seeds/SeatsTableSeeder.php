<?php

use Illuminate\Database\Seeder;

class SeatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seats')->insert([
            'seat_type' => 'Economy',
            'price_modifier' => 1.0,
          ]);
        DB::table('seats')->insert([
            'seat_type' => 'Premium economy',
            'price_modifier' => 1.2,
          ]);
        DB::table('seats')->insert([
            'seat_type' => 'Premium business',
            'price_modifier' => 1.4,
          ]);
    }
}
