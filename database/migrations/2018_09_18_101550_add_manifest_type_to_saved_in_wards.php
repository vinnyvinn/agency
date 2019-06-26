<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddManifestTypeToSavedInWards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saved_in_wards', function (Blueprint $table) {
            $table->boolean('toggle_type')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('saved_in_wards', function (Blueprint $table) {
            $table->dropColumn('toggle_type');
        });
    }
}
