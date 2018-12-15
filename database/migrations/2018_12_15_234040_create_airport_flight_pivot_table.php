<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirportFlightPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airport_flight', function (Blueprint $table) {
            $table->integer('flight_id')->unsigned()->index();
            $table->foreign('flight_id')->references('id')->on('flights')->onDelete('cascade');
            $table->integer('airport_origin_id')->unsigned()->index();
            $table->foreign('airport_origin_id')->references('id')->on('airports')->onDelete('cascade');
            $table->integer('airport_destination_id')->unsigned()->index();
            $table->foreign('airport_destination_id')->references('id')->on('airports')->onDelete('cascade');
            
            $table->primary(['flight_id', 'airport_origin_id', 'airport_destination_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airport_flight');
    }
}
