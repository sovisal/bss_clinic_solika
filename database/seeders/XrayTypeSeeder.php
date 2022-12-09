<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class XrayTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('xray_types')->insert([
            [
                'name_en' => 'XRay',
                'name_kh' => 'XRay',
                'index' => 1
            ]
        ]);
    }
}
