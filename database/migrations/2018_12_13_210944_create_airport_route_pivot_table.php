<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirportRoutePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airport_route', function (Blueprint $table) {
            $table->integer('airport_id')->unsigned()->index();
            $table->foreign('airport_id')->references('id')->on('airports')->onDelete('cascade');
            $table->integer('route_id')->unsigned()->index();
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
            $table->primary(['airport_id', 'route_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('airport_route');
    }
}
