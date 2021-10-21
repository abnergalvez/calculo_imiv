<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFillsToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            //ingreso  
            
            //observaciones
            $table->date('limit_observation_date')->nullable(); //luego del ingreso
            $table->date('observation_date')->nullable();

            //reingreso

            //estado final
            $table->date('limit_final_status_date')->nullable(); //luego del re-ingreso
            $table->date('final_status_date')->nullable(); //accepted o rejected

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
