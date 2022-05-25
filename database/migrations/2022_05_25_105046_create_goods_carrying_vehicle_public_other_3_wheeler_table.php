<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsCarryingVehiclePublicOther3WheelerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_carrying_vehicle_public_other_3_wheeler', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('policy_id')->length(20)->unsigned();
            $table->enum('zone',['a','b','c']);
            $table->string('age');
            $table->string('vehicle_basic_rate');
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
        Schema::dropIfExists('goods_carrying_vehicle_public_other_3_wheeler');
    }
}
