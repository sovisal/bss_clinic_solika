<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientLinkables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_linkables', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('patient_id')->default(0);
			$table->unsignedBigInteger('pt_gender')->default(0);
            $table->integer('pt_age')->nullable();

            $table->unsignedBigInteger('user_id')->default(0);
            $table->tinyInteger('status')->default('0');
            $table->softDeletes();
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
        Schema::dropIfExists('patient_linkables');
    }
}
