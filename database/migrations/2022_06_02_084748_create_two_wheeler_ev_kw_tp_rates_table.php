<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwoWheelerEvKwTpRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('two_wheeler_ev_kw_tp_rates', function (Blueprint $table) {
            $table->id();
            $table->string('kw');
            $table->string('tp_one_year');
            $table->string('tp_five_year');
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
        Schema::dropIfExists('two_wheeler_ev_kw_tp_rates');
    }
}
