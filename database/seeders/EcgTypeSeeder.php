<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EcgTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ecg_types')->insert([
            [
                'name_en' => 'ECG',
                'name_kh' => 'ECG',
                'index' => 1,
                'status' => 1,
                'user_id' => 1,
            ],
        ]);
    }
}
