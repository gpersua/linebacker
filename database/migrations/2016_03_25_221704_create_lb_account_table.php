<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLbAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lb_account', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('userAcc');
            $table->integer('id_membership')->unsigned();
            $table->integer('id_city')->unsigned();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->date('birthday');
            $table->string('phone_number');
            $table->string('second_phone');
            $table->primary('userAcc');
            $table->foreign('id')->references('id')->on('lb_users');
            $table->foreign('id_membership')->references('idlb_membership')->on('lb_membership');
            $table->foreign('id_city')->references('idlb_city')->on('lb_city');
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
        Schema::drop('lb_account');
    }
}
