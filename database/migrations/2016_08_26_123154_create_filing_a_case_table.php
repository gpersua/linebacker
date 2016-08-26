<?php
/*****************************************************************************
 * Proyecto Linebacker
 * Fecha 26/08/2016
 * Programador Freddy Figueroa
 * Migracion de la Tabla Filing A Case
 * Modulo de Reclamos
 * **************************************************************************/
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilingACaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lb_filing_a_case', function (Blueprint $table)
        {
            $table->increments('id_filing_a_case');
            $table->integer('id_account')->unsigned();
            $table->integer('id_city')->unsigned();
            $table->string('street',255);
            $table->string('company_name',255);
            $table->string('telemakerting_service');
            $table->string('telemakerting_phone_number');
            $table->string('telemakerting_agent_supervisor');
            $table->date('date_of_call');
            $table->integer('linebacker_code');
            $table->integer('recorded_content_of_call');
            $table->mediumText('comments_adicional_info');
            $table->primary('id_filing_a_case');
            $table->foreign('id_account')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_city')->references('idlb_city')->on('lb_city')->onDelete('cascade');
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

            Schema::drop('lb_filing_a_case');

    }
}
