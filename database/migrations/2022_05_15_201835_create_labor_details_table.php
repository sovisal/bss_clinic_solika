<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaborDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labor_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('labor_id')->nullable();
            $table->unsignedBigInteger('labor_item_id')->nullable();
            $table->string('value', 10)->default('0');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('labor_id')
                ->references('id')
                ->on('laboratories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('labor_item_id')
                ->references('id')
                ->on('labor_items')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('labor_details');
    }
}
