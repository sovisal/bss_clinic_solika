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

            $table->unsignedBigInteger('user_id')->default(0);
            $table->tinyInteger('status')->default('0');
            $table->softDeletes();
            $table->timestamps();
            
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
        Schema::dropIfExists('addresses');
    }
}
