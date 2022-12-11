<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;
use App\Models\DataParent;
use App\Models\User;

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
                'phone' => '011 801 802',
                'email' => 'sampletest@gmail.com',
                'status' => 1,
                'user_id' => User::all()->random()->id,
                'created_at' => now(),
            ],
            [
                'gender_id' => DataParent::where('type', 'gender')->get()->random()->id,
                'name_kh' => 'Doctor 2',
                'name_en' => 'Doctor 2',
                'phone' => '011 801 803',
                'email' => 'sampletest1@gmail.com',
                'status' => 1,
                'user_id' => User::all()->random()->id,
                'created_at' => now(),
            ],
            [
                'gender_id' => DataParent::where('type', 'gender')->get()->random()->id,
                'name_kh' => 'Doctor 3',
                'name_en' => 'Doctor 3',
                'phone' => '011 801 803',
                'email' => 'sampletest3@gmail.com',
                'status' => 1,
                'user_id' => User::all()->random()->id,
                'created_at' => now(),
            ],
        ]);
    }
}
