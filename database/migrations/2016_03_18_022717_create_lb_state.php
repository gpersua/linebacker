<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLbState extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lb_state', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idlb_state');
            $table->string('name', 100);
            $table->string('initials',2);
            $table->integer('idlb_country')->unsigned();
            $table->foreign('idlb_country')->references('idlb_country')->on('lb_country');
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
        Schema::drop('lb_state');
    }
}
