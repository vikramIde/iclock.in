<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Targetassign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targetassign', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('Employeeid');
            $table->string('Eventname');
            $table->string('Targetvalue');
            $table->string('Currency');
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
          Schema::drop('targetassign');
    }
}
