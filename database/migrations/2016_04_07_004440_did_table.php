<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lb_extension', function (Blueprint $table) {
            $table->dropForeign('lb_extension_did_extension_foreign');
            
        });
        Schema::table('lb_did', function (Blueprint $table) {
        $table->bigInteger('did')->change();
        });
        
        Schema::table('lb_extension', function(Blueprint $table){
            $table->bigInteger('did_extension')->change();
            $table->foreign('did_extension')->references('did')->on('lb_did');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lb_did', function (Blueprint $table) {
            //
        });
    }
}
