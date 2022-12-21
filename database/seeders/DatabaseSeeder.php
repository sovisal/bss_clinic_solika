<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AbilitySeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            DataParentSeeder::class,
            LaborTypeSeeder::class,
            LaborItemSeeder::class,
            EchoTypeSeeder::class,
            XrayTypeSeeder::class,
            EcgTypeSeeder::class,
            SettingSeeder::class,
            DoctorSeeder::class,
            MedicineSeeder::class,
            PatientSeeder::class,
            ProductCategorySeeder::class,
            ProductTypeSeeder::class,
            ProductUnitSeeder::class,
            AddressLinkableSeeder::class,
        ]);
    }
}
