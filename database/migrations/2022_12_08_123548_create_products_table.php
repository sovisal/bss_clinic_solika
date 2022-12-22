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
            $table->float('cost')->default(0);
            $table->float('price')->default(0);
            $table->string('image')->nullable();

            $table->float('qty_begin')->default(0);
            $table->float('qty_alert')->default(0);
            $table->float('qty_in')->default(0);
            $table->float('qty_out')->default(0);
            $table->float('qty_remain')->default(0);

            $table->unsignedBigInteger('type_id')->nullable()->constrained('product_types');
            $table->unsignedBigInteger('unit_id')->nullable()->constrained('product_units');
            $table->unsignedBigInteger('category_id')->nullable()->constrained('product_categories');

            $table->unsignedBigInteger('user_id')->nullable()->constrained();
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
