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

            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('gender')->nullable();
            $table->integer('age')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('patient_id')
                ->references('id')
                ->on('patients')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('gender')
                ->references('id')
                ->on('data_parents')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
