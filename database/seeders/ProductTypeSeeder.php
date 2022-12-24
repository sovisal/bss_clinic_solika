<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory\ProductType;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		ProductType::insert([
			[
				'id' => 1,
				'name_kh' => 'Medicine',
				'name_en' => 'Medicine',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
		]);
    }
}
