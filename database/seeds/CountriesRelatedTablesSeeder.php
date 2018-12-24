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
          'country_code' => $countryCode,
          'country_id' => $countryId,
        ]);
        // Crear 5 hoteles por pais
        for ($j=1 ; $j<6 ; $j++){
          DB::table('hotels')->insert([
            'hotel_name' => $faker->unique()->word,
            'hotel_address' => $faker->unique()->address,
            'hotel_stars' =>$faker->numberBetween($min=1, $max=5),
            'city_id' => App\City::where('country_code', $countryCode)->get()
            ->random()->id,
          ]);
        }
      }
    }
}
