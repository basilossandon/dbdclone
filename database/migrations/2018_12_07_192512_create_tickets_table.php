<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seat_number')->nullablle();
            $table->char('seat_letter')->nullable();
            $table->timestamps();

            // Llaves foraneas para pasajero, paquete, asiento y reserva.
            $table->integer('passenger_id')->unsigned()->nullable()->index();
            $table->foreign('passenger_id')->references('id')->on('passengers')->onDelete('cascade');
            $table->integer('package_id')->unsigned()->nullable()->index();
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->integer('seat_id')->unsigned()->index();
            $table->foreign('seat_id')->references('id')->on('seats')->onDelete('cascade');
            $table->integer('reservation_id')->unsigned()->nullable()->index();
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
