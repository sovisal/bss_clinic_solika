<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaborItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labor_items', function (Blueprint $table) {
            $table->id();

            $table->string('name_en')->nullable();
            $table->string('name_kh')->nullable();

            $table->string('min_range', 10)->nullable();
            $table->string('max_range', 10)->nullable();
            $table->string('unit', 50)->nullable();

            $table->unsignedBigInteger('type')->nullable();
            $table->integer('index')->default(9999);
            $table->text('other')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('type')
                ->references('id')
                ->on('labor_types')
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
        Schema::dropIfExists('labor_items');
    }
}
