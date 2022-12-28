<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_outs', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable(); // type can be : Invoice, Prescription, Stockout

            $table->date('date')->nullable();
            $table->string('document_no')->nullable();

            $table->foreignID('product_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignID('unit_id')->nullable()->constrained('product_units')->onUpdate('cascade')->onDelete('cascade');
            $table->float('price')->default(0);
            $table->float('qty_based')->default(0); // Based QTY = qty caculate with product package =the sum of stock_out_details > qty
            $table->float('qty')->default(0); // QTY of package
            $table->float('total')->default(0);
            $table->text('note')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();

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
        Schema::dropIfExists('stock_outs');
    }
}
