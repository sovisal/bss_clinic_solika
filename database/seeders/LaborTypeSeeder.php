<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaborTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::insert("INSERT INTO `labor_types` (`id`, `name_en`, `name_kh`, `index`, `status`, `parent_id`, `other`, `created_at`, `updated_at`, `user_id`) VALUES
            (1, 'BACTERIOLOGIE', 'BACTERIOLOGIE', 1.00, 1, NULL, NULL, NULL, NULL, 1),
            (2, 'BIOCHIMIE', 'BIOCHIMIE', 2.00, 1, NULL, NULL, NULL, NULL, 1),
            (3, 'dematology', 'dematology', 3.00, 1, NULL, NULL, NULL, NULL, 1),
            (4, '- skin', '- skin', 4.00, 1, '3', NULL, NULL, NULL, 1),
            (5, 'HEMATOLOGIE', 'HEMATOLOGIE', 5.00, 1, NULL, NULL, NULL, NULL, 1),
            (6, '- FORMULE LEUCOCYTAIRE:', '- FORMULE LEUCOCYTAIRE:', 6.00, 1, '5', NULL, NULL, NULL, 1),
            (7, '- HbA1C', '- HbA1C', 7.00, 1, '5', NULL, NULL, NULL, 1),
            (8, '- NUMERATION GLOBULAIRI:', '- NUMERATION GLOBULAIRI:', 8.00, 1, '5', NULL, NULL, NULL, 1),
            (9, 'SELLE', 'SELLE', 9.00, 1, NULL, NULL, NULL, NULL, 1),
            (10, 'SEROLOGIES', 'SEROLOGIES', 10.00, 1, NULL, NULL, NULL, NULL, 1),
            (11, '- DIAGNOSTIC DE TREPONEMATOSES', '- DIAGNOSTIC DE TREPONEMATOSES', 11.00, 1, '10', NULL, NULL, NULL, 1),
            (12, '- REACTION DE WALER ROSE', '- REACTION DE WALER ROSE', 12.00, 1, '10', NULL, NULL, NULL, 1),
            (13, '- Serodiagnostic de widal (salmonelloses)', '- Serodiagnostic de widal (salmonelloses)', 13.00, 1, '10', NULL, NULL, NULL, 1),
            (14, '- SEROLOGIE DE H.I.V. 1 / 2 ', '- SEROLOGIE DE H.I.V. 1 / 2 ', 14.00, 1, '10', NULL, NULL, NULL, 1),
            (15, '- SEROLOGIE DE L\'HEPATITE B,C', '- SEROLOGIE DE L\'HEPATITE B,C', 15.00, 1, '10', NULL, NULL, NULL, 1),
            (16, '- SEROLOGIE DES INFECTIONS A STREPTOCOQUE', '- SEROLOGIE DES INFECTIONS A STREPTOCOQUE', 16.00, 1, '10', NULL, NULL, NULL, 1),
            (17, '- Serology de Helicobacter pylori ', '- Serology de Helicobacter pylori ', 17.00, 1, '10', NULL, NULL, NULL, 1),
            (18, '- TEST DE LATEX POUR DETECTION PROTEIN C (CRP)', '- TEST DE LATEX POUR DETECTION PROTEIN C (CRP)', 18.00, 1, '10', NULL, NULL, NULL, 1),
            (19, 'URINARIES ANALYSES', 'URINARIES ANALYSES', 19.00, 1, NULL, NULL, NULL, NULL, 1),
            (20, 'IONOGRAME', 'IONOGRAME', 8.50, 1, NULL, NULL, NULL, NULL, 1),
            (21, 'BIOCHEMISTRY', 'BIOCHEMISTRY', 2.10, 1, NULL, NULL, NULL, NULL, 1),
            (22, 'Hemogram', 'Hemogram', 8.10, 1, NULL, NULL, NULL, NULL, 1),
            (23, 'THYROID FUNCTION', 'THYROID FUNCTION', 9.10, 1, NULL, NULL, '2022-11-28 23:53:59', '2022-11-28 23:53:59', 1),
            (24, 'TUMOR MARKERS', 'TUMOR MARKERS', 9.20, 1, NULL, NULL, NULL, NULL, 1),
            (25, 'STOOL/SPUTUM', 'STOOL/SPUTUM', 9.30, 1, NULL, NULL, '2022-11-28 23:55:09', '2022-11-28 23:55:09', 1),
            (26, 'URINE', 'URINE', 9.40, 1, NULL, NULL, '2022-11-28 23:55:09', '2022-11-28 23:55:09', 1),
            (27, 'CULTURE', 'CULTURE', 9.50, 1, NULL, NULL, '2022-11-28 23:55:09', '2022-11-28 23:55:09', 1)");
    }
}
