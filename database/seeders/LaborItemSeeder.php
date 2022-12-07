<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class LaborItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('labor_items')->insert([
            [
                'user_id' => 1,
                'name_en' => 'Leucocytes',
                'name_kh' => 'Leucocytes',
                'min_range' => '100',
                'max_range' => '200',
                'unit' => '10<sup>3</sup>3/uL',
                'type' => 1
            ],
            [
                'user_id' => 1,
                'name_en' => 'Hématies',
                'name_kh' => 'Hématies',
                'min_range' => '10',
                'max_range' => '20',
                'unit' => '10<sup>6</sup>6/uL',
                'type' => 1
            ],
            [
                'user_id' => 1,
                'name_en' => 'Polynucléaire neutrophile',
                'name_kh' => 'Polynucléaire neutrophile',
                'min_range' => '1',
                'max_range' => '100',
                'unit' => '%',
                'type' => 2
            ],
        ]);
    }
}
