<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkarBasicInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workar_basic_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('workerViewId')->nullable();
            $table->string('name',100);
            $table->tinyInteger('gender');
            $table->unsignedInteger('depertmentId');
            $table->text('image');
            $table->text('fringerPrint')->nullable();
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
        Schema::dropIfExists('workar_basic_infos');
    }
}
