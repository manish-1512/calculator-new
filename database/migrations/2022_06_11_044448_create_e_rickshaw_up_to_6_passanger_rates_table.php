<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateERickshawUpTo6PassangerRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_rickshaw_up_to_6_passanger_rates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('policy_id')->length(20)->unsigned();
            $table->enum('zone',['a','b','c']);
            $table->string('age');
            $table->string('vehicle_basic_rate');
            $table->string('vehicle_tp_rate');
            $table->string('per_passengers_rate');
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
        Schema::dropIfExists('e_rickshaw_up_to_6_passanger_rates');
    }
}
