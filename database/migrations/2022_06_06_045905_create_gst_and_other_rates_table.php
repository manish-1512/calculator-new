<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGstAndOtherRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gst_and_other_rates', function (Blueprint $table) {
            $table->id();
            $table->string('gst_on_basic_liability')->default(0)->nullable();
            $table->string('gst_on_rest_of_other')->default(0)->nullable();
            $table->string('imt_23')->default(0)->nullable();
            $table->string('lpg_cng_percentage')->default(0)->nullable();
            $table->string('lpg_cng_additional_on_tp')->default(0)->nullable();
            $table->string('electrical_percentage')->default(0)->nullable();
            $table->foreign('id')->references('id')->on('policies')->onDelete('cascade'); 
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
        Schema::dropIfExists('gst_and_other_rates');
    }
}
