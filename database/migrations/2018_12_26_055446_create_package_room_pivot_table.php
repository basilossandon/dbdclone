<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageRoomPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_room', function (Blueprint $table) {
          $table->integer('package_id')->unsigned();
          $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
          $table->integer('room_id')->unsigned();
          $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
          $table->primary(['package_id', 'room_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_room');
    }
}
