<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('amount')->nullable(); //monto de factura
            $table->integer('number')->nullable(); //numero de factura
            $table->enum('status',[
                'accepted',
                'rejected',
                'to_pay',
                'paid'
            ])->nullable();
            $table->string('accepted_date')->nullable();
            $table->integer('project_id'); //relacion con proyecto
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
        Schema::dropIfExists('invoices');
    }
}
