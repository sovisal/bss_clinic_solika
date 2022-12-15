<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class AddressLinkableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('SQL_PATH')) {
            $pwd = (env('DB_PASSWORD') ? ' -p"' . env('DB_PASSWORD') . '"' : '');
            exec(env('SQL_PATH') . " -h " . env('DB_HOST') . " -u " . env('DB_USERNAME') . $pwd . " " . env('DB_DATABASE') . " < " . database_path('manual_sql/addresses.sql'));
        }
    }
}
