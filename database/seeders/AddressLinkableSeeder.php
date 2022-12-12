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
        exec("mysql --user=".Config::get('database.connections.mysql.username')." --password=".Config::get('database.connections.mysql.password')." ".Config::get('database.connections.mysql.database')." < ". database_path('manual_sql/addresses.sql'));
    }
}
