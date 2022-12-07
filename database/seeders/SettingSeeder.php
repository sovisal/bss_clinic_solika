<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Setting::firstOrCreate([
			'id' => 1,
			'user_id' => 1,
			'clinic_name_kh' => 'មន្ទីរសម្រាកព្យាបាល ស៊ុន ពិសិដ្ឋ',
			'clinic_name_en' => 'SUN PISETH CLINIC',
			'sign_name_kh' => 'ស៊ុន ពិសិដ្ឋ',
			'sign_name_en' => 'SUN PISETH',
			'phone' => '012 35 29 60 / 012 48 43 91 / 071 999 62 45',
			'address' => 'ភូមិអ្នកតាស្ទឹង ឃុំបឹងណាយ ស្រុកព្រៃឈរ ខេត្តកំពង់ចាម',
			'description' => 'ព្យាបាល៖ ជំងឺទូទៅ ទឹកនោមផ្អែម លើសសម្ពាធឈាម មនុស្សចាស់ កុមារ និងរោគស្រ្ដី វះកាត់តូច ថតអេកូរ សម្ភព <br/>
			ពិនិត្យឈាម ពិនិត្យកំហាប់ឆ្អឹង វ៉ាក់សាំងសាំ ការពារ ថ្លើមបេ មហារីករីមាត់ស្បូន ឆ្កែឆ្កួត',
		]);
	}
}
