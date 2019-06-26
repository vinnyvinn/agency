<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoyagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voyages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quotation_id');
            $table->string('voyage_no');
            $table->string('internal_voyage_no');
            $table->string('name');
            $table->string('service_code')->nullable();
            $table->string('final_destination')->nullable();
            $table->dateTime('eta')->nullable();
            $table->dateTime('vessel_arrived')->nullable();
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
        Schema::dropIfExists('voyages');
    }
}
