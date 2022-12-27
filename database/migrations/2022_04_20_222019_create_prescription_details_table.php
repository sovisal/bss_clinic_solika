<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prescription_id')->nullable();
            $table->unsignedBigInteger('medicine_id')->nullable();

            $table->string('price', 10)->default(0);
            $table->string('qty', 10)->default(0);
            $table->string('upd', 10)->default(0);
            $table->string('nod', 10)->default(0);
            $table->string('total', 10)->default(0);
            $table->foreignID('unit_id')->nullable();
            $table->string('usage_times')->default('');

            $table->unsignedBigInteger('usage_id')->nullable();
            $table->text('other')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('prescription_id')
                ->references('id')
                ->on('prescriptions')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('usage_id')
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
        Schema::dropIfExists('prescription_details');
    }
}
