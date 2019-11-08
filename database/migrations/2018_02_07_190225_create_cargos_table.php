<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('lead_id');
            $table->integer('quotation_id');
            $table->integer('good_type_id');
            $table->string('manifest_number');
            $table->string('shipping_type');
            $table->string('description')->nullable();
            $table->string('type')->nullable();
            $table->string('bl_no')->nullable();
            $table->string('seal_no')->nullallable();
            $table->string('hs_no')->nullallable();
            $table->string('container_id')->nullable();
            $table->string('case_qty')->nullable();
            $table->string('t_net_weight')->nullable();
            $table->string('volume')->nullable();
            $table->string('container_size')->nullable();
            $table->string('load_status')->nullable();
            $table->string('t_gross_weight')->nullable();
            $table->string('package')->nullable();
            $table->string('weight');
            $table->string('total_package')->nullable();
            $table->string('discharge_rate');
            $table->text('shipper')->nullable();
            $table->text('shipping_line')->nullable();
            $table->text('notifying_address')->nullable();
            $table->text('remarks')->nullable();
            $table->string('edo')->default(0);
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
        Schema::dropIfExists('cargos');
    }
}
