<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

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
                'user_id' => 1,
                'name_en' => 'ECG',
                'name_kh' => 'ECG',
                'index' => 1
            ]
        ]);
    }
}
