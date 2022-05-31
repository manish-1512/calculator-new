<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiscSpecialVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('misc_special_vehicles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('policy_id')->length(20)->unsigned();
            $table->enum('zone',['a','b','c']);
            $table->string('age');
            $table->string('vehicle_basic_rate');
            $table->string('tp_other_misc_vehicle');
            $table->string('tp_agriculture_6hp');
            $table->foreign('policy_id')->references('id')->on('policies')->onDelete('cascade');
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
        Schema::dropIfExists('misc_special_vehicles');
    }
}
