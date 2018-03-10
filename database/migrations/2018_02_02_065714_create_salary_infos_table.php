<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('workerId');
            $table->unsignedSmallInteger('paymentType_id');
            $table->dateTime('salaryTo');
            $table->dateTime('salaryFrom');
            $table->unsignedSmallInteger('present');
            $table->unsignedSmallInteger('overtime');
            $table->unsignedInteger('basicSalary');
            $table->unsignedInteger('overtimeSalary');
            $table->unsignedInteger('totalSalary');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('salary_infos');
    }
}
