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
				'name_kh' => 'Liquid',
				'name_en' => 'Liquid',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'Tablet',
				'name_en' => 'Tablet',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'Capsules',
				'name_en' => 'Capsules',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'Topical medicines',
				'name_en' => 'Topical medicines',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'Suppositories',
				'name_en' => 'Suppositories',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'Drops',
				'name_en' => 'Drops',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'Inhalers',
				'name_en' => 'Inhalers',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'Injections',
				'name_en' => 'Injections',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'Implants or patches',
				'name_en' => 'Implants or patches',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
		]);
    }
}
