<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerDetailsInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_details_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('workerId');
            $table->string('nationalId');
            $table->string('phoneNo',100);
            $table->string('email', 100);
            // Present Address
            $table->string('preHouseNo')->nullable();
            $table->string('preRoadNo')->nullable();
            $table->string('preVillage')->nullable();
            $table->string('preP_O');
            $table->string('preP_S');
            $table->string('preP_C');
            $table->string('preDistrict');
            $table->string('preCountry');
            // prmanent Address
            $table->string('parHouseNo')->nullable();
            $table->string('parRoadNo')->nullable();
            $table->string('parVillage')->nullable();
            $table->string('parP_O');
            $table->string('parP_S');
            $table->string('parP_C');
            $table->string('parDistrict');
            $table->string('parCountry');
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
        Schema::dropIfExists('worker_details_infos');
    }
}
