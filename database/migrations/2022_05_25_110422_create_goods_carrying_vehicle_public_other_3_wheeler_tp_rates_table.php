<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsCarryingVehiclePublicOther3WheelerTpRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_carrying_vehicle_public_other_3_wheeler_tp_rates', function (Blueprint $table) {
            $table->id();
            $table->string('kilogram');
            $table->string('tp_rate');
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
        Schema::dropIfExists('goods_carrying_vehicle_public_other_3_wheeler_tp_rates');
    }
}
