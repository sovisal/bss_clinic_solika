<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DataParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('data_parents')->insert([
            [
                'status' => 1,
                'title_en' => 'Male',
                'title_kh' => 'Male',
                'type' => 'gender',
            ],
            [
                'status' => 1,
                'title_en' => 'Female',
                'title_kh' => 'Female',
                'type' => 'gender',
            ],
            [
                'status' => 1,
                'title_en' => 'Other',
                'title_kh' => 'Other',
                'type' => 'gender',
            ],
        ]);
        DB::table('data_parents')->insert([
            [
                'status' => 1,
                'title_en' => 'Cambodian',
                'title_kh' => 'Cambodian',
                'type' => 'nationality',
            ],
            [
                'status' => 1,
                'title_en' => 'English',
                'title_kh' => 'English',
                'type' => 'nationality',
            ],
            [
                'status' => 1,
                'title_en' => 'Chinese',
                'title_kh' => 'Chinese',
                'type' => 'nationality',
            ],
            [
                'status' => 1,
                'title_en' => 'Other',
                'title_kh' => 'Other',
                'type' => 'nationality',
            ],
        ]);
        DB::table('data_parents')->insert([
            [
                'status' => 1,
                'title_en' => 'Single',
                'title_kh' => 'Single',
                'type' => 'marital_status',
            ],
            [
                'status' => 1,
                'title_en' => 'Married',
                'title_kh' => 'Married',
                'type' => 'marital_status',
            ],
            [
                'status' => 1,
                'title_en' => 'Separated',
                'title_kh' => 'Separated',
                'type' => 'marital_status',
            ],
            [
                'status' => 1,
                'title_en' => 'Devorced',
                'title_kh' => 'Devorced',
                'type' => 'marital_status',
            ],

            [
                'status' => 1,
                'title_en' => 'O+',
                'title_kh' => 'O+',
                'type' => 'blood_type',
            ],
            [
                'status' => 1,
                'title_en' => 'A',
                'title_kh' => 'A',
                'type' => 'blood_type',
            ],
            [
                'status' => 1,
                'title_en' => 'B',
                'title_kh' => 'B',
                'type' => 'blood_type',
            ],
            [
                'status' => 1,
                'title_en' => 'AB',
                'title_kh' => 'AB',
                'type' => 'blood_type',
            ],

            [
                'status' => 1,
                'title_en' => 'General',
                'title_kh' => 'General',
                'type' => 'enterprise',
            ],
            [
                'status' => 1,
                'title_en' => 'Staff',
                'title_kh' => 'Staff',
                'type' => 'enterprise',
            ],
            [
                'status' => 1,
                'title_en' => 'Teacher',
                'title_kh' => 'Teacher',
                'type' => 'enterprise',
            ],
            [
                'status' => 1,
                'title_en' => 'Worker',
                'title_kh' => 'Worker',
                'type' => 'enterprise',
            ],
            [
                'status' => 1,
                'title_en' => 'Government',
                'title_kh' => 'Government',
                'type' => 'enterprise',
            ],

            [
                'status' => 1,
                'title_en' => 'General',
                'title_kh' => 'General',
                'type' => 'payment_type',
            ],
            [
                'status' => 1,
                'title_en' => 'Cash',
                'title_kh' => 'Cash',
                'type' => 'payment_type',
            ],
            [
                'status' => 1,
                'title_en' => 'Bank',
                'title_kh' => 'Bank',
                'type' => 'payment_type',
            ],

            [
                'status' => 1,
                'title_en' => 'Unpaid',
                'title_kh' => 'Unpaid',
                'type' => 'payment_status',
            ],
            [
                'status' => 1,
                'title_en' => 'Paid',
                'title_kh' => 'Paid',
                'type' => 'payment_status',
            ],


            [
                'status' => 1,
                'title_en' => '?????????',
                'title_kh' => '?????????',
                'type' => 'comsumption',
            ],
            [
                'status' => 1,
                'title_en' => '????????????',
                'title_kh' => '????????????',
                'type' => 'comsumption',
            ],
            [
                'status' => 1,
                'title_en' => '???????????????',
                'title_kh' => '???????????????',
                'type' => 'comsumption',
            ],
            [
                'status' => 1,
                'title_en' => '?????????',
                'title_kh' => '?????????',
                'type' => 'comsumption',
            ],
            [
                'status' => 1,
                'title_en' => '????????????????????????',
                'title_kh' => '????????????????????????',
                'type' => 'comsumption',
            ],
            [
                'status' => 1,
                'title_en' => '??????????????????????????????',
                'title_kh' => '??????????????????????????????',
                'type' => 'comsumption',
            ],
            [
                'status' => 1,
                'title_en' => '?????????????????????????????????',
                'title_kh' => '?????????????????????????????????',
                'type' => 'comsumption',
            ],
            [
                'status' => 1,
                'title_en' => '???????????????',
                'title_kh' => '???????????????',
                'type' => 'comsumption',
            ],

            [
                'status' => 1,
                'title_en' => '???????????????',
                'title_kh' => '???????????????',
                'type' => 'time_usage',
            ],
            [
                'status' => 1,
                'title_en' => '????????????',
                'title_kh' => '????????????',
                'type' => 'time_usage',
            ],
            [
                'status' => 1,
                'title_en' => '???????????????',
                'title_kh' => '???????????????',
                'type' => 'time_usage',
            ],
            [
                'status' => 1,
                'title_en' => '?????????',
                'title_kh' => '?????????',
                'type' => 'time_usage',
            ],

            [
                'status' => 1,
                'title_en' => 'Active',
                'title_kh' => 'Active',
                'type' => 'status',
            ],
            [
                'status' => 1,
                'title_en' => 'Disabled',
                'title_kh' => 'Disabled',
                'type' => 'status',
            ]
        ]);

        DB::table('data_parents')->insert([
            [
                'status' => 1,
                'title_en' => '????????????????????????????????????????????????',
                'title_kh' => '????????????????????????????????????????????????',
                'type' => 'evalutaion_category',
                'id' => 10001,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => '?????????????????? ???????????????	',
                'title_kh' => '?????????????????? ???????????????	',
                'type' => 'evalutaion_category',
                'id' => 10002,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => '???????????????????????????',
                'title_kh' => '???????????????????????????',
                'type' => 'evalutaion_category',
                'id' => 10003,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => '?????????????????????????????????',
                'title_kh' => '?????????????????????????????????',
                'type' => 'evalutaion_category',
                'id' => 10004,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => '?????????????????????????????????????????????????????????',
                'title_kh' => '?????????????????????????????????????????????????????????',
                'type' => 'evalutaion_category',
                'id' => 10005,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => '????????????????????????????????????????????????????????????',
                'title_kh' => '????????????????????????????????????????????????????????????',
                'type' => 'evalutaion_category',
                'id' => 10006,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => '??????????????????????????????',
                'title_kh' => '??????????????????????????????',
                'type' => 'evalutaion_category',
                'id' => 10007,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => '???????????????????????????????????????????????????????????????',
                'title_kh' => '???????????????????????????????????????????????????????????????',
                'type' => 'evalutaion_category',
                'id' => 10008,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => '?????????????????????????????????????????????????????????????????????',
                'title_kh' => '?????????????????????????????????????????????????????????????????????',
                'type' => 'evalutaion_category',
                'id' => 10009,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'skin diseas',
                'title_kh' => 'skin diseas',
                'type' => 'evalutaion_category',
                'id' => 10010,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => '???????????????????????????',
                'title_kh' => '???????????????????????????',
                'type' => 'evalutaion_category',
                'id' => 10011,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Allergie et immunologie',
                'title_kh' => 'Allergie et immunologie',
                'type' => 'evalutaion_category',
                'id' => 10012,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Cardio-vascular disease',
                'title_kh' => 'Cardio-vascular disease',
                'type' => 'evalutaion_category',
                'id' => 10013,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Chir P??diatrie',
                'title_kh' => 'Chir P??diatrie',
                'type' => 'evalutaion_category',
                'id' => 10014,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Chirurgie/ Neurologie',
                'title_kh' => 'Chirurgie/ Neurologie',
                'type' => 'evalutaion_category',
                'id' => 10015,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Chirurgie/Thoracique',
                'title_kh' => 'Chirurgie/Thoracique',
                'type' => 'evalutaion_category',
                'id' => 10016,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Chirurgie/Traumatologie',
                'title_kh' => 'Chirurgie/Traumatologie',
                'type' => 'evalutaion_category',
                'id' => 10017,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Chirurgie/Urologie',
                'title_kh' => 'Chirurgie/Urologie',
                'type' => 'evalutaion_category',
                'id' => 10018,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Chirurgie/Vis??rale',
                'title_kh' => 'Chirurgie/Vis??rale',
                'type' => 'evalutaion_category',
                'id' => 10019,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Dermatology',
                'title_kh' => 'Dermatology',
                'type' => 'evalutaion_category',
                'id' => 10020,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Ear Nose Throat',
                'title_kh' => 'Ear Nose Throat',
                'type' => 'evalutaion_category',
                'id' => 10021,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Endocrinologie',
                'title_kh' => 'Endocrinologie',
                'type' => 'evalutaion_category',
                'id' => 1021,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Gastro-Entero-Hematology',
                'title_kh' => 'Gastro-Entero-Hematology',
                'type' => 'evalutaion_category',
                'id' => 10022,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'General disease',
                'title_kh' => 'General disease',
                'type' => 'evalutaion_category',
                'id' => 10023,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'General surgery',
                'title_kh' => 'General surgery',
                'type' => 'evalutaion_category',
                'id' => 10024,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Gynecology/Obstetric',
                'title_kh' => 'Gynecology/Obstetric',
                'type' => 'evalutaion_category',
                'id' => 10025,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'H??matologie',
                'title_kh' => 'H??matologie',
                'type' => 'evalutaion_category',
                'id' => 10026,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Infection disease',
                'title_kh' => 'Infection disease',
                'type' => 'evalutaion_category',
                'id' => 10027,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Internal Medicine',
                'title_kh' => 'Internal Medicine',
                'type' => 'evalutaion_category',
                'id' => 10028,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Musculoskeletal',
                'title_kh' => 'Musculoskeletal',
                'type' => 'evalutaion_category',
                'id' => 10029,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'N??onatologie',
                'title_kh' => 'N??onatologie',
                'type' => 'evalutaion_category',
                'id' => 10030,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'N??phrologie',
                'title_kh' => 'N??phrologie',
                'type' => 'evalutaion_category',
                'id' => 10031,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Neurologie',
                'title_kh' => 'Neurologie',
                'type' => 'evalutaion_category',
                'id' => 10032,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Oncology',
                'title_kh' => 'Oncology',
                'type' => 'evalutaion_category',
                'id' => 10033,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Ophthalmology',
                'title_kh' => 'Ophthalmology',
                'type' => 'evalutaion_category',
                'id' => 10034,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Parasitology',
                'title_kh' => 'Parasitology',
                'type' => 'evalutaion_category',
                'id' => 10035,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Parasitose',
                'title_kh' => 'Parasitose',
                'type' => 'evalutaion_category',
                'id' => 10036,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'P??diatrie/Cardiologie',
                'title_kh' => 'P??diatrie/Cardiologie',
                'type' => 'evalutaion_category',
                'id' => 10037,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'P??diatrie/Dermatologie',
                'title_kh' => 'P??diatrie/Dermatologie',
                'type' => 'evalutaion_category',
                'id' => 10038,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'P??diatrie/Endocrinologie',
                'title_kh' => 'P??diatrie/Endocrinologie',
                'type' => 'evalutaion_category',
                'id' => 10039,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'P??diatrie/Gasto-ent??rologie',
                'title_kh' => 'P??diatrie/Gasto-ent??rologie',
                'type' => 'evalutaion_category',
                'id' => 10040,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'P??diatrie/H??matologie',
                'title_kh' => 'P??diatrie/H??matologie',
                'type' => 'evalutaion_category',
                'id' => 10041,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'P??diatrie/H??patologie',
                'title_kh' => 'P??diatrie/H??patologie',
                'type' => 'evalutaion_category',
                'id' => 10042,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'P??diatrie/Infectieux en p??diatrie',
                'title_kh' => 'P??diatrie/Infectieux en p??diatrie',
                'type' => 'evalutaion_category',
                'id' => 10043,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'P??diatrie/N??phrologie',
                'title_kh' => 'P??diatrie/N??phrologie',
                'type' => 'evalutaion_category',
                'id' => 10044,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'P??diatrie/Neurologie',
                'title_kh' => 'P??diatrie/Neurologie',
                'type' => 'evalutaion_category',
                'id' => 10045,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'P??diatrie/Ophtalmologie',
                'title_kh' => 'P??diatrie/Ophtalmologie',
                'type' => 'evalutaion_category',
                'id' => 10046,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'P??diatrie/Psycose',
                'title_kh' => 'P??diatrie/Psycose',
                'type' => 'evalutaion_category',
                'id' => 10047,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Pneumologie',
                'title_kh' => 'Pneumologie',
                'type' => 'evalutaion_category',
                'id' => 10048,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Psychology',
                'title_kh' => 'Psychology',
                'type' => 'evalutaion_category',
                'id' => 10049,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Reproductive health',
                'title_kh' => 'Reproductive health',
                'type' => 'evalutaion_category',
                'id' => 10050,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Rhumatologie',
                'title_kh' => 'Rhumatologie',
                'type' => 'evalutaion_category',
                'id' => 10051,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Specially surgery',
                'title_kh' => 'Specially surgery',
                'type' => 'evalutaion_category',
                'id' => 10052,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Stomatologies',
                'title_kh' => 'Stomatologies',
                'type' => 'evalutaion_category',
                'id' => 10053,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Symptom-Cardiovasculaire',
                'title_kh' => 'Symptom-Cardiovasculaire',
                'type' => 'evalutaion_category',
                'id' => 10054,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Symptome chir',
                'title_kh' => 'Symptome chir',
                'type' => 'evalutaion_category',
                'id' => 10055,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Symptom-Gastro-intestinal',
                'title_kh' => 'Symptom-Gastro-intestinal',
                'type' => 'evalutaion_category',
                'id' => 10056,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Symptom-General',
                'title_kh' => 'Symptom-General',
                'type' => 'evalutaion_category',
                'id' => 10057,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Symptom-Neurologique/Psychologico',
                'title_kh' => 'Symptom-Neurologique/Psychologico',
                'type' => 'evalutaion_category',
                'id' => 10058,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Symptom-Obst??trique / Gynaecological',
                'title_kh' => 'Symptom-Obst??trique / Gynaecological',
                'type' => 'evalutaion_category',
                'id' => 10059,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Symptom-Oculaire',
                'title_kh' => 'Symptom-Oculaire',
                'type' => 'evalutaion_category',
                'id' => 10060,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Symptom-Pulmonaire',
                'title_kh' => 'Symptom-Pulmonaire',
                'type' => 'evalutaion_category',
                'id' => 10061,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Symptom-Structures cutan??es',
                'title_kh' => 'Symptom-Structures cutan??es',
                'type' => 'evalutaion_category',
                'id' => 10062,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Symptom-Urologique',
                'title_kh' => 'Symptom-Urologique',
                'type' => 'evalutaion_category',
                'id' => 10063,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Symptyome/n??phrologie',
                'title_kh' => 'Symptyome/n??phrologie',
                'type' => 'evalutaion_category',
                'id' => 10064,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Symtome Neurologie',
                'title_kh' => 'Symtome Neurologie',
                'type' => 'evalutaion_category',
                'id' => 10065,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Symtome Rhumatologie',
                'title_kh' => 'Symtome Rhumatologie',
                'type' => 'evalutaion_category',
                'id' => 10066,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Symtomp/endo',
                'title_kh' => 'Symtomp/endo',
                'type' => 'evalutaion_category',
                'id' => 10067,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Traumatologie',
                'title_kh' => 'Traumatologie',
                'type' => 'evalutaion_category',
                'id' => 10068,
                'parent_id' => 0
            ],
            [
                'status' => 1,
                'title_en' => 'Urology',
                'title_kh' => 'Urology',
                'type' => 'evalutaion_category',
                'id' => 10069,
                'parent_id' => 0
            ],


            [
                'status' => 1,
                'title_en' => 'Diarrhea',
                'title_kh' => 'Diarrhea',
                'type' => 'indication_disease',
                'id' => 11001,
                'parent_id' => 10027
            ],
            [
                'status' => 1,
                'title_en' => 'Dysenterie amibienne',
                'title_kh' => 'Dysenterie amibienne',
                'type' => 'indication_disease',
                'id' => 11002,
                'parent_id' => 10027
            ],
            [
                'status' => 1,
                'title_en' => 'Cirrhoses',
                'title_kh' => 'Cirrhoses',
                'type' => 'indication_disease',
                'id' => 11003,
                'parent_id' => 10042
            ],
        ]);
    }
}
