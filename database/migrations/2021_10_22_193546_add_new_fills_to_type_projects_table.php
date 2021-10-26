<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFillsToTypeProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('type_projects', function (Blueprint $table) {
            $table->integer('re_entry_days_limit')->nullable()->change();
            $table->integer('observation_days_limit')->nullable();
            $table->integer('final_status_days_limit')->nullable();
            $table->integer('budget_entry_days_limit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('type_projects', function (Blueprint $table) {
            //
        });
    }
}
