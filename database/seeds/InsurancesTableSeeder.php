<?php

use Illuminate\Database\Seeder;

class InsurancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y/m/d H:i:s');
        DB::table('insurances')->insert([
            'insurance_type' => 'Niño',
            'insurance_price' => 15000,
            'created_at' => $date,
            'updated_at' => $date,
          ]);

        DB::table('insurances')->insert([
            'insurance_type' => 'Adulto',
            'insurance_price' => 25000,
            'created_at' => $date,
            'updated_at' => $date,
          ]);

        DB::table('insurances')->insert([
            'insurance_type' => 'Adulto mayor',
            'insurance_price' => 25000,
            'created_at' => $date,
            'updated_at' => $date,
          ]);
    }
}
