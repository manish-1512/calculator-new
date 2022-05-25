<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivateCarCcTpCharges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('private_car_cc_tp_charges', function (Blueprint $table) {
            $table->id();
            $table->string('cc');
            $table->string('tp_one_year');
            $table->string('tp_three_year');
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
        Schema::dropIfExists('private_car_cc_tp_charges');
    }
}
