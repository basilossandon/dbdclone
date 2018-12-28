<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersInsertTrigger extends Migration
{
   public function up()
   {
          DB::unprepared('
          CREATE TRIGGER TR_register BEFORE INSERT ON users FOR EACH ROW
          BEGIN
            INSERT INTO register(register_id, modified_table_name, modification) VALUES(NEW.id, users, \'INSERT\');
          END
          ');
   }

   public function down()
   {
    DB::unprepared('DROP TRIGGER TR_register');
   }
}
