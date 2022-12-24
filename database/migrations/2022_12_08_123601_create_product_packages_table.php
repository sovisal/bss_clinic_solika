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
            $table->foreignID('product_id')->nullable()->constrained('products');
            $table->foreignID('product_unit_id')->nullable()->constrained('product_units');

            $table->float('base_qty')->default(1);
            $table->float('qty')->default(0);
            $table->float('price')->default(0);
            $table->string('code')->nullable();

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
        Schema::dropIfExists('product_packages');
    }
}
