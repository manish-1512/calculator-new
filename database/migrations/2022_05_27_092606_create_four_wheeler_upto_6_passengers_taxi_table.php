<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFourWheelerUpto6PassengersTaxiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('four_wheeler_upto_6_passengers_taxi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('policy_id')->length(20)->unsigned();
            $table->enum('zone',['a','b']);
            $table->string('age');
            $table->bigInteger('cc')->length(20)->unsigned();
            $table->string('vehicle_basic_rate');
            $table->foreign('policy_id')->references('id')->on('policies')->onDelete('cascade');
            $table->foreign('cc')->references('id')->on('four_wheeler_upto_6_passengers_taxi_tp_rates')->onDelete('cascade');
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
        Schema::dropIfExists('four_wheeler_upto_6_passengers_taxi');
    }
}
