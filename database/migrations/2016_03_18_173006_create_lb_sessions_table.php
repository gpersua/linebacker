<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLbSessionsTable extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lb_sessions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id', 255);
            $table->text('payload');
            $table->integer('last_activity');
            //$table->string('user_id', 255)->nullable();
            //$table->string('ip_address', 255);
            //$table->string('user_agent', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lb_sessions');
    }
}
