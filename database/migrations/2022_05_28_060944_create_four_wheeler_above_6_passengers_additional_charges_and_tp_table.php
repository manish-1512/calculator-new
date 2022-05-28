<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFourWheelerAbove6PassengersAdditionalChargesAndTpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('four_wheeler_above_6_passengers_additional_charges_and_tp', function (Blueprint $table) {
            $table->id();
            $table->string('passenger');
            $table->string('additional_charges');
            $table->string('school_bus_tp');
            $table->string('school_bus_per_person');
            $table->string('other_bus_tp');
            $table->string('other_bus_per_person');
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
        Schema::dropIfExists('four_wheeler_above_6_passengers_additional_charges_and_tp');
    }
}
