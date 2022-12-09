<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;
use App\Models\DataParent;

class DoctorSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Doctor::insert([
			[
				'gender_id' => DataParent::where('type', 'gender')->get()->random()->id,
				'name_kh' => 'ស៊ុន ពិសិដ្ឋ',
				'name_en' => 'SUN PISETH',
				'created_at' => now(),
			],
			[
				'gender_id' => DataParent::where('type', 'gender')->get()->random()->id,
				'name_kh' => 'Doctor 2',
				'name_en' => 'Doctor 2',
				'created_at' => now(),
			],
			[
				'gender_id' => DataParent::where('type', 'gender')->get()->random()->id,
				'name_kh' => 'Doctor 3',
				'name_en' => 'Doctor 3',
				'created_at' => now(),
			],
		]);
	}
}
