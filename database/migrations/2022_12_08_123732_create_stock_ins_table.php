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

            $table->date('date')->nullable();
            $table->date('exp_date')->nullable();
            $table->string('reciept_no')->nullable();

            $table->foreignID('supplier_id')->nullable()->constrain()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignID('product_id')->nullable()->constrain()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignID('unit_id')->nullable()->constrain('product_units')->onUpdate('cascade')->onDelete('cascade');

            $table->float('remain')->default(0);
            $table->float('price')->default(0);
            $table->float('qty')->default(0);

            $table->foreignID('user_id')->nullable()->constrain()->onUpdate('cascade')->onDelete('cascade');
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
