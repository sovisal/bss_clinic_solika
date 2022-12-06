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
            $table->unsignedBigInteger('invoice_id')->default(0);
            $table->string('qty', 10)->default('0');
            $table->string('price', 10)->default('0');
            $table->string('total', 10)->default('0');
            $table->text('description');

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
        Schema::dropIfExists('invoice_items');
    }
}
