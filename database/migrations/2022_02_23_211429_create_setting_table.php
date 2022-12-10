<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->id();
            $table->string('clinic_name_kh')->nullable();
            $table->string('clinic_name_en')->nullable();
            $table->string('sign_name_kh')->nullable();
            $table->string('sign_name_en')->nullable();

            $table->string('logo')->default('logo.png');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('setting');
    }
}
