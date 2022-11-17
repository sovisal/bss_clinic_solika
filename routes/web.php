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

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
	Route::get('/', [HomeController::class, 'index'])->name('home');
	Route::get('/git_pull', [HomeController::class, 'git_pull'])->name('git_pull');

});

// Backup DB
Route::get('/db_backup', function () {
	$is_hosted = !in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1', 'localhost']);
	$dump = $is_hosted ? '/usr/bin/mysqldump' : 'C:\wamp64\bin\mysql\mysql5.7.26\bin\mysqldump'; // wamp server
	$cmd = $dump . ' -h ' . env('DB_HOST') . ' -u ' . env('DB_USERNAME') . (env('DB_PASSWORD') ? ' -p"' . env('DB_PASSWORD') . '"' : '') . ' --databases ' . env('DB_DATABASE');
	
	// Generate command
	$output = [];
	exec($cmd, $output);
	$output = implode("\n",$output);

	// Deposit file into safe places
	$file_name =  'db_' . env('DB_DATABASE') . '_' . date('Ymd-His') . '.sql';
	$path = date("Y") . '/' . date("F") . '/' . $file_name;
	Storage::disk('db_backup')->put($path, $output);
	Storage::disk('ftp_db_backup')->put($path, $output);

	// Inform to admin
	$msg = "=========Start Backup : ==========" . " \n ";
	$msg .= "DB : " . env('DB_DATABASE') . " \n ";
	$msg .= "Date : " . date('Y-M-d H:i:s') . " \n ";
	$msg .= "File : " . $file_name . " \n ";
	$msg .= "Size : " . Storage::disk('db_backup')->size($path) . " \n ";
	$msg .= "Status : success" . " \n ";
	$msg .= "============End================";
	file_get_contents('https://api.telegram.org/bot2031396303:AAHzdx7Onkfgj-dFkMjrilXIv34oueOJOsg/sendMessage?chat_id=@bssclientinfo&text=' . urlencode($msg));


});

require __DIR__.'/patient-route.php';
require __DIR__.'/prescription-route.php';
require __DIR__.'/para-clinic-route.php';
require __DIR__.'/user-route.php';
require __DIR__.'/setting-route.php';
require __DIR__.'/data-parent-route.php';
require __DIR__.'/labor-item-route.php';
require __DIR__.'/echo-type-route.php';
require __DIR__.'/xray-type-route.php';
require __DIR__.'/ecg-type-route.php';
require __DIR__.'/echography-route.php';
require __DIR__.'/xray-route.php';
require __DIR__.'/ecg-route.php';
require __DIR__.'/labor-route.php';
require __DIR__.'/invoice-route.php';
require __DIR__.'/service-route.php';