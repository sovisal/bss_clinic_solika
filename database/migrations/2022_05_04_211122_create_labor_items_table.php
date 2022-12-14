<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaborItemsTable extends Migration
{
    /**
     * Run the migrations.
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
            $table->double('index')->default(999);
            $table->text('other')->nullable();
            $table->boolean('status')->default(true);
            $table->foreignID('type_id')->constrain('labor_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignID('user_id')->nullable()->constrain()->onUpdate('cascade')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('labor_items');
    }
}
