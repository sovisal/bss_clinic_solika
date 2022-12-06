<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

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
				'name_kh' => 'ស៊ុន ពិសិដ្ឋ',
				'name_en' => 'SUN PISETH',
				'user_id' => 1,
				'created_at' => now(),
			],
			[
				'name_kh' => 'Doctor 2',
				'name_en' => 'Doctor 2',
				'user_id' => 1,
				'created_at' => now(),
			],
			[
				'name_kh' => 'Doctor 3',
				'name_en' => 'Doctor 3',
				'user_id' => 1,
				'created_at' => now(),
			],
		]);
	}
}
