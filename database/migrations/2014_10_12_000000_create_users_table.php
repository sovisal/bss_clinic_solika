<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('name')->nullable();
			$table->string('username')->unique();
			$table->string('password');
			$table->string('color')->nullable();
			$table->string('image')->nullable();
			$table->string('position')->nullable();
			$table->string('phone')->nullable();
			$table->string('address')->nullable();
			$table->unsignedBigInteger('doctor')->default(0);
			$table->boolean('gender')->default(false);
			$table->text('bio')->nullable();
			$table->boolean('isWebDev')->default(false);
			$table->boolean('is_suspended')->default(false);
            $table->rememberToken();
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
		Schema::dropIfExists('users');
	}
}
