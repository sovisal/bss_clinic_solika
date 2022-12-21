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
				'name_kh' => 'Type 1',
				'name_en' => 'Type 1',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'Type 2',
				'name_en' => 'Type 2',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'Type 3',
				'name_en' => 'Type 3',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
		]);
    }
}
