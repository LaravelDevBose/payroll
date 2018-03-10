<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepertmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depertments', function (Blueprint $table){
            $table->increments('id');
            $table->string('deptName');
            $table->string('deptCode');
            $table->unsignedInteger('workingTime');
            $table->tinyInteger('publicationStatus');
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
        Schema::dropIfExists('depertments');
    }
}
