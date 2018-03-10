<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerPaymentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_payment_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('workerId');
            $table->unsignedInteger('paymentType'); 
            $table->unsignedInteger('amount');
            $table->unsignedInteger('overtimeAmount');
            $table->string('accountNumber')->nullable();
            $table->unsignedInteger('timeLimit');
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
        Schema::dropIfExists('worker_payment_infos');
    }
}
