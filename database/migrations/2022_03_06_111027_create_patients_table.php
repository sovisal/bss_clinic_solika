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
            $table->string('type')->nullable(); // type can be : Normal, Maternity, ...
            $table->string('id_card_no')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('age')->nullable();
            $table->string('education')->nullable();
            $table->string('position')->nullable();
            $table->string('photo')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_position')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_position')->nullable();
            $table->string('house_no')->nullable();
            $table->string('street_no')->nullable();
            $table->string('postal_code')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->datetime('registered_at')->nullable();
            $table->foreignId('gender_id')->nullable()->constrained('data_parents');
            $table->foreignId('enterprise_id')->nullable()->constrained('data_parents');
            $table->foreignId('nationality_id')->nullable()->constrained('data_parents');
            $table->foreignId('marital_status_id')->nullable()->constrained('data_parents');
            $table->foreignId('blood_type_id')->nullable()->constrained('data_parents');
            $table->foreignId('address_id')->nullable()->constrained('address_linkables');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['age']);
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
