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
			'clinic_name_kh' => 'មន្ទីរសម្រាកព្យាបាល វិបុល ច័ន្រ្ទ សិរីមង្គល',
			'clinic_name_en' => 'VIBOL CHAN SEREY MUNGKUL CLINIC',
			'sign_name_kh' => 'វិបុល ច័ន្រ្ទ សិរីមង្គល',
			'sign_name_en' => 'VIBOL CHAN SEREY MUNGKUL',
			'phone' => '012 xxx xxx / 012 xx xx xx / 071 xxx xx xx',
			'address' => 'ភូមិអ្នកតាស្ទឹង ឃុំបឹងណាយ ស្រុកព្រៃឈរ ខេត្តកំពង់ចាម',
			'description' => 'ព្យាបាល៖ ជំងឺទូទៅ ទឹកនោមផ្អែម លើសសម្ពាធឈាម មនុស្សចាស់ កុមារ និងរោគស្រ្ដី វះកាត់តូច ថតអេកូរ សម្ភព <br/>
			ពិនិត្យឈាម ពិនិត្យកំហាប់ឆ្អឹង វ៉ាក់សាំង ការពារ ថ្លើមបេ មហារីករីមាត់ស្បូន ឆ្កែឆ្កួត',
			'user_id' => 1,
		]);
	}
}
