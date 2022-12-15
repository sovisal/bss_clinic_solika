<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->datetime('inv_date')->nullable();
            $table->string('code', 50)->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();

            $table->string('amount', 10)->default('0');
            $table->string('exchange_rate', 10)->default('0');
            $table->unsignedBigInteger('payment_type')->nullable();
            $table->tinyInteger('payment_status')->default(0);

            $table->string('total', 10)->default('0');
            $table->text('remark')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('patient_id')
                ->references('id')
                ->on('patient_linkables')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('address_id')
                ->references('id')
                ->on('address_linkables')
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
        Schema::dropIfExists('invoices');
    }
}
