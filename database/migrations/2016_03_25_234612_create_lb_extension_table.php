<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLbExtensionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lb_extension', function (Blueprint $table) {
            $table->integer('did_extension');
            $table->integer('extension');
            $table->string('server_url');
            $table->string('userAcc');
            $table->primary('did_extension');
            $table->foreign('userAcc')->references('userAcc')->on('lb_account');
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
        Schema::drop('lb_extension');
    }
}
