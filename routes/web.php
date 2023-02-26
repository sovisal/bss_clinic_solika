<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/git_pull', [HomeController::class, 'git_pull'])->name('git_pull');
});

// Backup DB
Route::get('/db_backup', function () {
    if (env('SQL_DUMP_PATH')) {

        $cmd = env('SQL_DUMP_PATH') . ' -h ' . env('DB_HOST') . ' -u ' . env('DB_USERNAME') . (env('DB_PASSWORD') ? ' -p"' . env('DB_PASSWORD') . '"' : '') . ' --databases ' . env('DB_DATABASE');

        // Generate command
        $output = [];
        exec($cmd, $output);
        $output = implode("\n", $output);


        // Deposit file into safe places
        $file_name =  'db_' . env('DB_DATABASE') . '_' . date('Ymd-His') . '.sql';
        $path = date("Y") . '/' . date("F") . '/' . $file_name;
        Storage::disk('db_backup')->put($path, $output);
        Storage::disk('ftp_db_backup')->put($path, $output);


        // Inform to admin
        if (env('TELEGRAM_TOKEN') && env('TELEGRAM_CART_ID')) {
            $size = Storage::disk('db_backup')->size($path);
            $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            $power = $size > 0 ? floor(log($size, 1024)) : 0;
            $file_size = number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];

            $msg = "=========" . date('Y-M-d H:i:s') . "==========" . " \n ";
            $msg .= "DB : " . env('DB_DATABASE') . " \n ";
            $msg .= "File : " . $file_name . " \n ";
            $msg .= "Size : " . $file_size . " | Status : success" . " \n ";
            $msg .= "============End=====================";
            file_get_contents("https://api.telegram.org/bot" . env('TELEGRAM_TOKEN') . "/sendMessage?chat_id=@" . env('TELEGRAM_CART_ID') . "&text=" . urlencode($msg));
        }
    }
});

require __DIR__ . '/patient-route.php';
require __DIR__ . '/maternity-route.php';
require __DIR__ . '/prescription-route.php';
require __DIR__ . '/user-route.php';
require __DIR__ . '/setting-route.php';
require __DIR__ . '/echography-route.php';
require __DIR__ . '/xray-route.php';
require __DIR__ . '/ecg-route.php';
require __DIR__ . '/labor-route.php';
require __DIR__ . '/invoice-route.php';
require __DIR__ . '/service-route.php';
require __DIR__ . '/product-route.php';
require __DIR__ . '/inventory-route.php';
