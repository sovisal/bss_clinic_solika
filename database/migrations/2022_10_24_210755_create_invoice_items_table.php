<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->string('service_name', 100)->nullable();
            $table->string('service_type', 50)->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();

            $table->string('qty', 10)->default('0');
            $table->string('price', 10)->default('0');
            $table->string('total', 10)->default('0');
            $table->string('exchange_rate', 10)->default('0');
            
            $table->text('description');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('invoice_id')
                ->references('id')
                ->on('invoices')
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
        Schema::dropIfExists('invoice_items');
    }
}
