<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatFlightPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seat_flight_pivot', function (Blueprint $table) {
            $table->integer('seat_id')->unsigned()->index();
            $table->foreign('seat_id')->references('id')->on('seats')->onDelete('cascade');
            $table->integer('flight_id')->unsigned()->index();
            $table->foreign('flight_id')->references('id')->on('flights')->onDelete('cascade');
            $table->primary(['seat_id', 'flights_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seat_flight_pivot');
    }
}
