<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLbCity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('lb_city', function (Blueprint $table) {
            $table->engine = 'InnoDB';
	    $table->increments('idlb_city');
            $table->integer('zip_code');
            $table->string('name', 100);
            $table->integer('idlb_state')->unsigned();
            $table->string('initials',2);
            $table->foreign('idlb_state')->references('idlb_state')->on('lb_state');
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
        Schema::drop('lb_city');
    }
}
