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

            $table->date('date')->nullable();
            $table->string('document_no')->nullable();
            
            $table->unsignedBigInteger('stock_in_id')->default(0);
            $table->unsignedBigInteger('type_id')->default(0);
            
            $table->unsignedBigInteger('product_id')->default(0);
            $table->unsignedBigInteger('unit_id')->default(0);
            
            $table->float('price')->default(0);
            $table->float('qty')->default(0);

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
        Schema::dropIfExists('stock_outs');
    }
}
