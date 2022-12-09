<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class LaborTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('labor_types')->insert([
            [
                'name_en' => 'BACTERIOLOGIE',
                'name_kh' => 'BACTERIOLOGIE',
                'index' => 1,
                'status' => 1,
            ],
            [
                'name_en' => 'BIOCHIMIE',
                'name_kh' => 'BIOCHIMIE',
                'index' => 2,
                'status' => 1,
            ],
            [
                'name_en' => 'dematology',
                'name_kh' => 'dematology',
                'index' => 3,
                'status' => 1,
            ],
            [
                'name_en' => '- skin',
                'name_kh' => '- skin',
                'index' => 4,
                'status' => 1,
            ],
            [
                'name_en' => 'HEMATOLOGIE',
                'name_kh' => 'HEMATOLOGIE',
                'index' => 5,
                'status' => 1,
            ],
            [
                'name_en' => '- FORMULE LEUCOCYTAIRE:',
                'name_kh' => '- FORMULE LEUCOCYTAIRE:',
                'index' => 6,
                'status' => 1,
            ],
            [
                'name_en' => '- HbA1C',
                'name_kh' => '- HbA1C',
                'index' => 7,
                'status' => 1,
            ],
            [
                'name_en' => '- NUMERATION GLOBULAIRI:',
                'name_kh' => '- NUMERATION GLOBULAIRI:',
                'index' => 8,
                'status' => 1,
            ],
            [
                'name_en' => 'SELLE',
                'name_kh' => 'SELLE',
                'index' => 9,
                'status' => 1,
            ],
            [
                'name_en' => 'SEROLOGIES',
                'name_kh' => 'SEROLOGIES',
                'index' => 10,
                'status' => 1,
            ],
            [
                'name_en' => '- DIAGNOSTIC DE TREPONEMATOSES',
                'name_kh' => '- DIAGNOSTIC DE TREPONEMATOSES',
                'index' => 11,
                'status' => 1,
            ],
            [
                'name_en' => '- REACTION DE WALER ROSE',
                'name_kh' => '- REACTION DE WALER ROSE',
                'index' => 12,
                'status' => 1,
            ],
            [
                'name_en' => '- Serodiagnostic de widal (salmonelloses)',
                'name_kh' => '- Serodiagnostic de widal (salmonelloses)',
                'index' => 13,
                'status' => 1,
            ],
            [
                'name_en' => '- SEROLOGIE DE H.I.V. 1 / 2 ',
                'name_kh' => '- SEROLOGIE DE H.I.V. 1 / 2 ',
                'index' => 14,
                'status' => 1,
            ],
            [
                'name_en' => "- SEROLOGIE DE L'HEPATITE B,C",
                'name_kh' => "- SEROLOGIE DE L'HEPATITE B,C",
                'index' => 15,
                'status' => 1,
            ],
            [
                'name_en' => '- SEROLOGIE DES INFECTIONS A STREPTOCOQUE',
                'name_kh' => '- SEROLOGIE DES INFECTIONS A STREPTOCOQUE',
                'index' => 16,
                'status' => 1,
            ],
            [
                'name_en' => '- Serology de Helicobacter pylori ',
                'name_kh' => '- Serology de Helicobacter pylori ',
                'index' => 17,
                'status' => 1,
            ],
            [
                'name_en' => '- TEST DE LATEX POUR DETECTION PROTEIN C (CRP)',
                'name_kh' => '- TEST DE LATEX POUR DETECTION PROTEIN C (CRP)',
                'index' => 18,
                'status' => 1,
            ],
            [
                'name_en' => 'URINARIES ANALYSES',
                'name_kh' => 'URINARIES ANALYSES',
                'index' => 19,
                'status' => 1,
            ],

            // --------------Add new---------------
            [
                'name_en' => 'IONOGRAME',
                'name_kh' => 'IONOGRAME',
                'index' => 8.5,
                'status' => 1,
            ],
            [
                'name_en' => 'BIOCHEMISTRY',
                'name_kh' => 'BIOCHEMISTRY',
                'index' => 2.1,
                'status' => 1,
            ],
            [
                'name_en' => 'Hemogram',
                'name_kh' => 'Hemogram',
                'index' => 8.1,
                'status' => 1,
            ],
        ]);
    }
}
