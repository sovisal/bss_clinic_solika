<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->nullable();
            $table->string('name_kh')->nullable();
            $table->string('description')->nullable();
            $table->string('logo')->nullable();
            
            $table->string('contact_name')->nullable();
            $table->string('contact_number')->nullable();
            
            $table->unsignedBigInteger('category_id')->default(0);
            $table->unsignedBigInteger('address_id')->default(0);
            $table->unsignedBigInteger('type_id')->default(0);

            $table->string('other')->nullable();
            $table->string('payment_info')->nullable();
            $table->string('ap_amount')->nullable();
      
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
        Schema::dropIfExists('suppliers');
    }
}
