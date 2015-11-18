<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class Payments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        //
        Schema::create('Payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->unsigned();
            $table->string('adjust_mode');
            $table->string('adjust_amount');
            $table->string('date');
            $table->string('recieved_amount');
            $table->string('refno');
            $table->timestamps();
        });

        Schema::table('Payments', function($table) {
           $table->foreign('invoice_id')->references('id')->on('event_invoice');
       });
    }




    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
         Schema::drop('Payments');
    }
}
