<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsurancePassengerPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_passenger', function (Blueprint $table) {
            $table->integer('insurance_id')->unsigned()->index();
            $table->foreign('insurance_id')->references('id')->on('insurances')->onDelete('cascade');
            $table->integer('passenger_id')->unsigned()->index();
            $table->foreign('passenger_id')->references('id')->on('passengers')->onDelete('cascade');
            $table->integer('flight_id')->unsigned();
            $table->foreign('flight_id')->references('id')->on('flights')->onDelete('cascade');
            $table->primary(['insurance_id', 'passenger_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('insurance_passenger');
    }
}
