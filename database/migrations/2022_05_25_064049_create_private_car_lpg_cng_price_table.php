<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivateCarLpgCngPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('private_car_lpg_cng_price', function (Blueprint $table) {
            $table->id();
            $table->enum('zone',['a','b']);
            $table->string('age');
            $table->bigInteger('cc')->length(20)->unsigned();
            $table->string('price');
            $table->foreign('cc')->references('id')->on('private_car_cc_tp_charges')->onDelete('cascade');
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
        Schema::dropIfExists('private_car_lpg_cng_price');
    }
}
