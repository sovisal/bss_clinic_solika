<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClassicModeToPrescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prescription_details', function (Blueprint $table) {
            $table->tinyInteger('mode')->default('2'); // 1-Classic, 2-Modern
            $table->float('no_morning')->default('0');
            $table->float('no_afternoon')->default('0');
            $table->float('no_evening')->default('0');
            $table->float('no_night')->default('0');
            // Total = (no_morning + no_afternoon + no_evening + no_night) * nod
        });
    }

    /**
     * Reverse the migrations.  
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prescription_details', function (Blueprint $table) {
            $table->dropColumn('mode');
            $table->dropColumn('no_morning');
            $table->dropColumn('no_afternoon');
            $table->dropColumn('no_evening');
            $table->dropColumn('no_night');
        });
    }
}
