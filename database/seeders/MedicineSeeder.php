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
				'name' => 'Paracetamol 500',
				'price' => '1',
				'usage_id' => 15,
				'description' => '',
			],
			[
				'name' => 'Aceptop 500mg',
				'price' => '1',
				'usage_id' => 15,
				'description' => '',
			],
			[
				'name' => 'Aloparinol 100mg',
				'price' => '1',
				'usage_id' => 15,
				'description' => '',
			],
		]);
    }
}
