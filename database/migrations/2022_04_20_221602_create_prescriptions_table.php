<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->nullable();
            $table->unsignedBigInteger('patient_id')->default(0);
            
            $table->unsignedBigInteger('requested_by')->default(0);
            $table->datetime('requested_at')->nullable();
            
            $table->datetime('analysis_at')->nullable();
            $table->unsignedBigInteger('doctor_id')->default(0);

            $table->text('diagnosis')->nullable();
            $table->text('attribute')->nullable();
            $table->text('other')->nullable();
            
            $table->unsignedBigInteger('user_id')->default(0);
            $table->tinyInteger('status')->default('0');
            $table->softDeletes();
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
        Schema::dropIfExists('prescriptions');
    }
}
