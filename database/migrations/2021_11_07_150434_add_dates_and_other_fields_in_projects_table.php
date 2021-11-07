<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDatesAndOtherFieldsInProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->date('adjudication_date')->nullable(); //Fecha Adjudicacion
            $table->date('to_engineer_date')->nullable(); //Fecha entrega a Ingeniero
            $table->integer('engineer_user_id')->nullable(); //id usuario ingeniero (lista select)
            $table->string('approval_link',200)->nullable(); // Link de aprobacion
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            //
        });
    }
}
