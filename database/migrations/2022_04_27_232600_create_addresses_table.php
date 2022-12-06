<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('_code', 10)->nullable();
            $table->string('_name_kh')->nullable();
            $table->string('_name_en')->nullable();
            $table->string('_type_kh')->nullable();
            $table->string('_type_en')->nullable();
            $table->string('_path_kh')->nullable();
            $table->string('_path_en')->nullable();
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
        Schema::dropIfExists('addresses');
    }
}
