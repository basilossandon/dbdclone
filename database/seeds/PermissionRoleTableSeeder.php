<?php

use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Poblar la tabla permissions
      //factory(App\User::class, 5)->create();
      // Poblar la tabla roles
      //factory(App\Role::class, 3)->create();

      $roles = App\Role::all();

      App\Permission::all()->each(function ($permission) use ($roles){
        $permission->roles()->attach(
          $roles->random(rand(1,3))->pluck('id')->toArray()
        );
      });
    }
}
