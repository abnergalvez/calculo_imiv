<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('entry_number')->nullable();
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->integer('commune_id')->nullable(); //tabla comuna
            $table->date('entry_date');
            $table->date('limit_re_entry_date')->nullable();
            $table->date('re_entry_date')->nullable();
            $table->string('status')->nullable();// registered, in_evaluation, re_entered, acepted, rejected
            $table->string('entry_doc_path')->nullable();
            $table->string('re_entry_doc_path')->nullable();

            $table->integer('customer_id')->nullable(); //cliente
            $table->integer('type_project_id'); // tipo proyecto

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
        Schema::dropIfExists('projects');
    }
}
