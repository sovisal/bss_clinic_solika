<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\XrayType;
use App\Models\User;

class XrayTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        XrayType::insert([
            [
                'name_en' => 'XRay',
                'name_kh' => 'XRay',
                'index' => 1,
                'status' => 1,
                'user_id' => 1,
            ]
        ]);
    }
}
