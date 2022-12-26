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
            $table->string('type')->nullable(); // type can be : begin and stockin

            $table->date('date')->nullable();
            $table->foreignID('supplier_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignID('product_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignID('unit_id')->nullable()->constrained('product_units')->onUpdate('cascade')->onDelete('cascade');
            $table->float('price')->default(0);
            $table->float('qty')->default(0);
            $table->float('total')->default(0);
            $table->date('exp_date')->nullable();
            $table->string('reciept_no')->nullable();
            
            $table->float('qty_based')->default(0); // Base QTY = qty caculate with product package
            $table->float('qty_used')->default(0);  // Used QTY = the sum of table stock_outs > qty
            $table->float('qty_remain')->default(0);  // Remain QTY = qty_based - qty_used

            $table->foreignID('user_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
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
