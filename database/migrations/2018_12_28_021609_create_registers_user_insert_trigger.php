<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersUserInsertTrigger extends Migration
{
   public function up()
   {
          DB::unprepared('
          CREATE OR REPLACE FUNCTION insertRegister()
          RETURNS trigger AS
          $BODY$
          BEGIN
            INSERT INTO registers(id,created_at,updated_at,user_id, modified_table_name, modification)
            VALUES(NEW.id, now(), null, NEW.user_id,\'users_table\', \'INSERT\');
            RETURN NEW;
          END
          $BODY$
          LANGUAGE plpgsql;
          ');

          DB::unprepared('
          CREATE TRIGGER TR_register AFTER INSERT ON users FOR EACH ROW
          EXECUTE PROCEDURE insertRegister();
          ');
   }

   public function down()
   {
    DB::unprepared('DROP TRIGGER TR_register');
   }
}
