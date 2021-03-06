<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('client_id');
            $table->integer('project_id')->nullable();
            $table->integer('approved_by')->nullable();
            $table->integer('vessel_id')->nullable();
            $table->string('internal_ref')->nullable();
            $table->string('crm_ref')->nullable();
            $table->integer('service_type_id')->nullable();
            $table->string('remittance')->default(0);
            $table->string('file_number')->nullable();
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
        Schema::dropIfExists('quotations');
    }
}
