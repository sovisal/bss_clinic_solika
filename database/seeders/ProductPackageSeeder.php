<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory\ProductPackage;

class ProductPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductPackage::insert([
            [
                'product_id' => 1,
                'product_unit_id' => 10,
                'qty' => 5,
                'user_id' => 1,
                'status' => 1,
            ],
            [
                'product_id' => 1,
                'product_unit_id' => 11,
                'qty' => 10,
                'user_id' => 1,
                'status' => 1,
            ],
        ]);
    }
}
