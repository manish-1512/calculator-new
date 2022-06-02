<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivateCarEvKwTpRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('private_car_ev_kw_tp_rates', function (Blueprint $table) {
            $table->id();
            $table->string('kw');
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
        Schema::dropIfExists('private_car_ev_kw_tp_rates');
    }
}
