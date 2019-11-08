<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quotation_id');
            $table->integer('tariff_id');
            $table->text('description');
            $table->string('tax_code');
            $table->string('type')->default('pda');
            $table->string('tax_description');
            $table->string('tax_id');
            $table->string('stk_id');
            $table->string('tax_amount');
            $table->string('grt_loa');
            $table->string('rate');
            $table->string('agency_sp');
            $table->string('units');
            $table->string('tax');
            $table->string('total');
            $table->string('buying_price')->nullable()->default(0);
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
        Schema::dropIfExists('quotation_services');
    }
}
