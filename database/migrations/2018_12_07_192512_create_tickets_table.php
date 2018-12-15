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
        Schema::create('Tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('seat_type');
            $table->integer('seat_number');
            $table->char('seat_letter');
            $table->timestamps();
            $table->integer('passenger_id')->unsigned()->index();
            $table->foreign('passenger_id')->references('id')->on('passengers')->onDelete('cascade');
            $table->integer('package_id')->unsigned()->index();
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
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
