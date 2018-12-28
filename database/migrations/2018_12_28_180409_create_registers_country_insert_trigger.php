<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersCountryInsertTrigger extends Migration
{
   public function up()
   {
          DB::unprepared('
          CREATE OR REPLACE FUNCTION insertRegisterCountry()
          RETURNS trigger AS
          $BODY$
          BEGIN
            INSERT INTO registers(created_at,updated_at,user_id, modified_table_name, modification)
            VALUES(now(), null, NEW.id,\'countries_table\', \'INSERT\');
            RETURN NEW;
          END
          $BODY$
          LANGUAGE plpgsql;
          ');

          DB::unprepared('
          CREATE TRIGGER TR_register AFTER INSERT ON countries FOR EACH ROW
          EXECUTE PROCEDURE insertRegisterCountry();
          ');
   }

   public function down()
   {
    DB::unprepared('DROP TRIGGER TR_register');
   }
}
