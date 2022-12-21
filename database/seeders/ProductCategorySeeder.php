<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		ProductCategory::insert([
			[
				'name_kh' => 'Category 1',
				'name_en' => 'Category 1',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'Category 2',
				'name_en' => 'Category 2',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'Category 3',
				'name_en' => 'Category 3',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
		]);
    }
}
