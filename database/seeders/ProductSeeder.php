<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            [
                'code' => 'PR-000001',
                'name_kh' => 'Paracetamol 500mg',
                'name_en' => 'Paracetamol 500mg',
                'cost' => 2,
                'price' => 5,
                'type_id' => 1,
                'unit_id' => 3,
                'category_id' => 2,
                'user_id' => 1,
                'status' => 1,
            ],
            [
                'code' => 'PR-000002',
                'name_kh' => 'Aceptop 500mg',
                'name_en' => 'Aceptop 500mg',
                'cost' => 3,
                'price' => 4,
                'type_id' => 1,
                'unit_id' => 3,
                'category_id' => 2,
                'user_id' => 1,
                'status' => 1,
            ],
            [
                'code' => 'PR-000003',
                'name_kh' => 'Aloparinol 100mg',
                'name_en' => 'Aloparinol 100mg',
                'cost' => 1,
                'price' => 3,
                'type_id' => 1,
                'unit_id' => 3,
                'category_id' => 2,
                'user_id' => 1,
                'status' => 1,
            ],
        ]);
    }
}
