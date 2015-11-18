<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Deal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('deal', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('Clientname');
            $table->string('Eventname');
            $table->string('Dealdate');
            $table->string('Dealvalue');
            $table->string('Dealcurr');
            $table->string('ConSentdate');
            $table->string('ConRecdate');
            $table->timestamps();
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
         Schema::drop('deal');
    }
}
