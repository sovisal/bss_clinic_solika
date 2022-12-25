<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaborTypesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('labor_types', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->nullable();
            $table->string('name_kh')->nullable();
            $table->float('index')->default(999);
            $table->text('other')->nullable();
            $table->boolean('status')->default(true);
            $table->foreignID('parent_id')->nullable()->constrained('labor_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignID('user_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('labor_types');
    }
}
