<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwoWheelerEvBasicRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('two_wheeler_ev_basic_rates', function (Blueprint $table) {
            $table->id();
            $table->enum('zone',['a','b']);
            $table->bigInteger('kilowatt')->length(20)->unsigned();
            $table->string('vehicle_basic_rate');
            $table->foreign('kilowatt')->references('id')->on('two_wheeler_ev_kw_tp_rates')->onDelete('cascade');
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
        Schema::dropIfExists('two_wheeler_ev_basic_rates');
    }
}
