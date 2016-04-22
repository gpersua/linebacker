<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLbContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lb_contacts', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('userAcc');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('email')->unique();
            $table->string('primary_phone');
            $table->string('second_phone');
            $table->string('third_phone');
            $table->foreign('userAcc')->references('userAcc')->on('lb_account');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE  `lb_contacts` DROP PRIMARY KEY , ADD PRIMARY KEY (  `id` ,  `primary_phone` );');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lb_contacts');
    }
}
