<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoices', function (Blueprint $table) {
			$table->id();
			$table->datetime('inv_date')->nullable();
			$table->string('code', 50)->nullable();
			$table->unsignedBigInteger('doctor_id')->default(0);
			$table->unsignedBigInteger('patient_id')->default(0);
			$table->unsignedBigInteger('address_id')->default(0);
			$table->string('exchange_rate', 10)->default('0');
			$table->string('total', 10)->default('0');
			$table->text('remark')->nullable();
            
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
		Schema::dropIfExists('invoices');
	}
}
