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
        $date = date('Y/m/d H:i:s');
        DB::table('seats')->insert([
            'seat_type' => 'Economy',
            'price_modifier' => 1.0,
            'created_at' => $date,
            'updated_at' => $date,
          ]);
        DB::table('seats')->insert([
            'seat_type' => 'First Class',
            'price_modifier' => 1.2,
            'created_at' => $date,
            'updated_at' => $date,
          ]);
        DB::table('seats')->insert([
            'seat_type' => 'Business Class',
            'price_modifier' => 1.4,
            'created_at' => $date,
            'updated_at' => $date,
          ]);
    }
}
