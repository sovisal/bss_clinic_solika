<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_ins', function (Blueprint $table) {
            $table->id();

            $table->date('date')->nullalbe();
            $table->date('exp_date')->nullalbe();
            $table->string('reciept_no')->nullalbe();

            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();

            $table->float('price')->default(0);
            $table->float('qty')->default(0);

            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('stock_ins');
    }
}
