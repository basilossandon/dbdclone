<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(VehiclesTableSeeder::class);
        $this->call(PackagesTableSeeder::class);
        $this->call(PassengersTableSeeder::class);
        $this->call(SeatsTableSeeder::class);
        $this->call(ReservationsTableSeeder::class);
        $this->call(TicketsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(CountriesRelatedTablesSeeder::class);
        $this->call(AirportsTableSeeder::class);
        $this->call(FlightsTableSeeder::class);
        $this->call(InsurancesTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(ReservationVehicleTableSeeder::class);
        $this->call(FlightSeatTableSeeder::class);
        $this->call(InsurancePassengerTableSeeder::class);
    }
}
