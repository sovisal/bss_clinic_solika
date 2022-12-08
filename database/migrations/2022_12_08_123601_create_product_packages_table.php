<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->default(0);
            $table->unsignedBigInteger('product_unit_id')->default(0);
            
            $table->float('base_qty')->default(1);
            $table->float('qty')->default(0);
            $table->float('price')->default(0);
            $table->float('code')->default(0);
             
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
        Schema::dropIfExists('product_packages');
    }
}
