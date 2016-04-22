<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLbCountry extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('lb_country', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idlb_country');
            $table->string('name', 100);
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
        Schema::drop('lb_country');
    }
}
