<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            $table->string('name_kh')->nullable();
            $table->string('name_en')->nullable();
            $table->string('id_card_no')->nullable();
            $table->unsignedBigInteger('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->date('date_of_birth')->nullable();
            $table->integer('age')->nullable();
            $table->string('education')->nullable();
            $table->string('enterprise')->nullable();
            $table->string('position')->nullable();
            $table->string('nationality')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('photo')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_position')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_position')->nullable();
            $table->string('house_no')->nullable();
            $table->string('street_no')->nullable();
            $table->string('zip_code')->nullable();

            $table->unsignedBigInteger('address_id')->nullable();
            $table->datetime('registered_at')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('gender')
                ->references('id')
                ->on('data_parents')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('address_id')
                ->references('id')
                ->on('address_linkables')
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
        Schema::dropIfExists('patients');
    }
}
