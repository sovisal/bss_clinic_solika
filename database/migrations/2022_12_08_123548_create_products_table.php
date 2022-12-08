<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_kh')->nullable();
            $table->string('cost', 10)->default('0');
            $table->string('price', 10)->default('0');
            $table->string('image', 10)->default('0');

            $table->float('qty_alert')->default(0);
            $table->float('qty_in')->default(0);
            $table->float('qty_out')->default(0);
            $table->float('qty_remain')->default(0);

            $table->unsignedBigInteger('unit_id')->default('0');
            $table->unsignedBigInteger('category_id')->default('0');

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
        Schema::dropIfExists('products');
    }
}
