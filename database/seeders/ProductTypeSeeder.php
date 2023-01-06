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
				'description' => 'Products with this type will use in prescription and invoice.',
				'status' => 1,
				'user_id' => 1,
			],
		]);
    }
}
