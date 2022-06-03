<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivateCarEvBasicRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('private_car_ev_basic_rates', function (Blueprint $table) {
            $table->id();
            $table->enum('zone',['a','b']);
            $table->string('age');
            $table->bigInteger('kw')->length(20)->unsigned();
            $table->string('vehicle_basic_rate');
            $table->foreign('kw')->references('id')->on('private_car_ev_kw_tp_rates')->onDelete('cascade');
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
        Schema::dropIfExists('private_car_ev_basic_rates');
    }
}
