<?php

use Illuminate\Database\Seeder;

class CountriesRelatedTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i = 1; $i < 51; $i++){
        $countryCode = App\Country::all()->random()->country_code;
        $countryId = App\Country::where('country_code', $countryCode)->first()->
        id;
        $faker = Faker\Factory::create('en_'.$countryCode);
        DB::table('cities')->insert([
          'city_name' => $faker->city,
          'city_code' => 'asd', // Esto falta resolver
          'country_id' => $countryId,
        ]);
      }
    }
}
