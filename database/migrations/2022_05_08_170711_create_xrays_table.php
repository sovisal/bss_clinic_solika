<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXraysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xrays', function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->nullable();
            $table->unsignedBigInteger('type')->default(0);

            $table->unsignedBigInteger('patient_id')->default(0);
            $table->unsignedBigInteger('doctor_id')->default(0);

            $table->unsignedBigInteger('requested_by')->default(0);
            $table->datetime('requested_at')->nullable();
            
            $table->unsignedBigInteger('payment_type')->default(0);
            $table->unsignedBigInteger('payment_status')->default(0);

            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('amount', 10)->default(0);
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
        Schema::dropIfExists('xrays');
    }
}
