<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $date = date('Y/m/d H:i:s');
      DB::table('roles')->insert([
          'role_name' => 'User',
          'role_description' => 'Acceso limitado a ver y comprar servicios',
          'created_at' => $date,
          'updated_at' => $date,
      ]);

      DB::table('roles')->insert([
          'role_name' => 'User manager',
          'role_description' => 'Permite agregar, eliminar y editar información
          de los usuarios registrados',
          'created_at' => $date,
          'updated_at' => $date,
      ]);

      DB::table('roles')->insert([
          'role_name' => 'Vendor manager',
          'role_description' => 'Puede añadir y quitar registros relacionados a
          ventas de servicios (vuelos, hoteles, automóviles, paquetes)',
          'created_at' => $date,
          'updated_at' => $date,
      ]);

      DB::table('roles')->insert([
          'role_name' => 'Administrator',
          'role_description' => 'Acceso completo a la información. Puede realizar
          modificaciones de todo tipo',
          'created_at' => $date,
          'updated_at' => $date,'created_at' => $date,
          'updated_at' => $date,
      ]);
    }
}
