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
        Schema::create('payment_method_receipt', function (Blueprint $table) {
            $table->integer('payment_method_id')->unsigned()->index();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
            $table->integer('receipt_id')->unsigned()->index();
            $table->foreign('receipt_id')->references('id')->on('receipts')->onDelete('cascade');
            $table->primary(['payment_method_id', 'receipt_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payment_method_receipt');
    }
}
