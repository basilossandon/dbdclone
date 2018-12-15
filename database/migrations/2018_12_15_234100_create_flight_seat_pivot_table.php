<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightSeatPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_seat', function (Blueprint $table) {
            $table->integer('seat_id')->unsigned()->index();
            $table->foreign('seat_id')->references('id')->on('seats')->onDelete('cascade');
            $table->integer('flight_id')->unsigned()->index();
            $table->foreign('flight_id')->references('id')->on('flights')->onDelete('cascade');
            $table->primary(['seat_id', 'flight_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flight_seat');
    }
}
