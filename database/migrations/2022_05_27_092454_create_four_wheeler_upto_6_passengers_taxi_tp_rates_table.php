<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFourWheelerUpto6PassengersTaxiTpRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('four_wheeler_upto_6_passengers_taxi_tp_rates', function (Blueprint $table) {
           
            $table->id();
            $table->string('cc');
            $table->string('tp_rate');
            $table->string('rate_per_passanger');
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
        Schema::dropIfExists('four_wheeler_upto_6_passengers_taxi_tp_rates');
    }
}
