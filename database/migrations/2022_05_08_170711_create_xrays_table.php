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
            $table->unsignedBigInteger('type')->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();

            $table->unsignedBigInteger('requested_by')->nullable();
            $table->datetime('requested_at')->nullable();
            
            $table->datetime('analysis_at')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            
            $table->string('amount', 10)->default(0);
            $table->string('exchange_rate', 10)->default(0);
            $table->unsignedBigInteger('payment_type')->nullable();
            $table->unsignedBigInteger('payment_status')->nullable();

            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();

            $table->text('attribute')->nullable();
            $table->text('other')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('type')
                ->references('id')
                ->on('xray_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('patient_id')
                ->references('id')
                ->on('patients')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('address_id')
                ->references('id')
                ->on('address_linkables')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('requested_by')
                ->references('id')
                ->on('doctors')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('doctor_id')
                ->references('id')
                ->on('doctors')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('payment_type')
                ->references('id')
                ->on('data_parents')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('payment_status')
                ->references('id')
                ->on('data_parents')
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
        Schema::dropIfExists('xrays');
    }
}
