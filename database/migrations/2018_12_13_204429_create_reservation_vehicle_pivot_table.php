<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class App\ extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_vehicle', function (Blueprint $table) {
            $table->integer('reservation_id')->unsigned()->index();
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            $table->integer('vehicle_id')->unsigned()->index();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->primary(['reservation_id', 'vehicle_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reservation_vehicle');
    }
}
