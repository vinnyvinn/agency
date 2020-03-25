
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVesselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vessels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->string('name');
            $table->string('imo_number')->nullable();
            $table->string('country')->nullable();
            $table->string('call_sign')->nullable();
            $table->string('loa')->nullable();
            $table->string('grt')->nullable();
            $table->string('eta')->nullable();
            $table->string('nrt')->nullable();
            $table->string('dwt')->nullable();
            $table->string('country_of_discharge')->nullable();
            $table->string('port_of_discharge')->nullable();
            $table->string('country_of_loading')->nullable();
            $table->string('port_of_loading')->nullable();
            $table->boolean('loading_type')->nullable()->default(0); //isinward
            $table->string('port_of_loading_code')->default('n/a')->nullable();
            $table->string('port_of_discharge_code')->default('n/a');
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
        Schema::dropIfExists('vessels');
    }
}
