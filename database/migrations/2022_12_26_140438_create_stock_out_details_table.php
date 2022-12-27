<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockOutDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_out_details', function (Blueprint $table) {
            // $table->id();
			$table->primary(['stock_out_id', 'stock_in_id']);

            $table->foreignID('stock_out_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignID('stock_in_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->float('qty')->default(0);

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
        Schema::dropIfExists('stock_out_details');
    }
}
