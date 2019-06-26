<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillOfLandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_of_landings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vessel_id');
            $table->integer('voyage_id')->nullable();
            $table->integer('quote_id')->nullable();
            $table->integer('service_type_id')->nullable();
            $table->integer('Client_id')->nullable();
            $table->integer('cargo_id')->nullable();
            $table->string('code_name')->nullable();
            $table->string('stage')->nullable();
            $table->dateTime('laytime_start')->nullable();
            $table->string('time_allowed')->nullable();
            $table->string('seal_number')->nullable();
            $table->string('berth_number')->nullable();
            $table->string('place_of_receipt')->nullable();
            $table->dateTime('date_of_loading')->nullable();
            $table->string('number_of_crane')->nullable();
            $table->string('sof_status')->default(0);
            $table->string('status')->default(0);
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
        Schema::dropIfExists('bill_of_landings');
    }
}
