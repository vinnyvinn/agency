<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProformasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proformas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('lead_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('approved_by')->nullable();
            $table->string('currency')->nullable();
            $table->integer('consignee_id');
            $table->integer('service_type_id')->nullable();
            $table->string('remittance')->default(0);
            $table->string('status');
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
        Schema::dropIfExists('proformas');
    }
}
