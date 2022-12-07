<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Medicine::insert([
			[
				'user_id' => 1,
				'name' => 'Paracetamol 500',
				'price' => '1',
				'usage_id' => 15,
				'description' => '',
				'user_id' => 1,
			],
			[
				'user_id' => 1,
				'name' => 'Aceptop 500mg',
				'price' => '1',
				'usage_id' => 15,
				'description' => '',
				'user_id' => 1,
			],
			[
				'user_id' => 1,
				'name' => 'Aloparinol 100mg',
				'price' => '1',
				'usage_id' => 15,
				'description' => '',
				'user_id' => 1,
			],
		]);
    }
}
