<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersVehicleInsertTrigger extends Migration
{
   public function up()
   {
          DB::unprepared('
          CREATE OR REPLACE FUNCTION insertRegisterVehicles()
          RETURNS trigger AS
          $BODY$
          BEGIN
            INSERT INTO registers(created_at,updated_at,user_id, modified_table_name, modification)
            VALUES(now(), null, NEW.id,\'vehicles_table\', \'INSERT\');
            RETURN NEW;
          END
          $BODY$
          LANGUAGE plpgsql;
          ');

          DB::unprepared('
          CREATE TRIGGER TR_register AFTER INSERT ON vehicles FOR EACH ROW
          EXECUTE PROCEDURE insertRegisterVehicles();
          ');
   }

   public function down()
   {
    DB::unprepared('DROP TRIGGER TR_register');
   }
}
