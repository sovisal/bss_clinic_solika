<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory\ProductUnit;

class ProductUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		ProductUnit::insert([
			[
				'name_kh' => 'កេស',
				'name_en' => 'Case',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'ប្រអប់',
				'name_en' => 'Box',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'បន្ទះ',
				'name_en' => 'បន្ទះ',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'អំពូល',
				'name_en' => 'អំពូល',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'ដប',
				'name_en' => 'ដប',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
			[
				'name_kh' => 'ប្លោក',
				'name_en' => 'ប្លោក',
				'description' => '',
				'status' => 1,
				'user_id' => 1,
			],
		]);
    }
}
