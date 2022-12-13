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
        (1, 'BACTERIOLOGIE', 'BACTERIOLOGIE', 1, 1, NULL, NULL, NULL, '2022-11-29 14:38:59', 1),
        (2, 'BIOCHIMIE', 'BIOCHIMIE', 2, 1, NULL, NULL, NULL, '2022-11-29 14:38:59', 1),
        (3, 'dematology', 'dematology', 3, 1, NULL, NULL, NULL, '2022-11-29 14:38:59', 1),
        (4, '- skin', '- skin', 11, 1, '3', NULL, NULL, '2022-11-29 15:01:21', 1),
        (5, 'HEMATOLOGIE', 'HEMATOLOGIE', 4, 1, NULL, NULL, NULL, '2022-11-29 15:01:21', 1),
        (6, '- FORMULE LEUCOCYTAIRE:', '- FORMULE LEUCOCYTAIRE:', 12, 1, '5', NULL, NULL, '2022-11-29 15:01:21', 1),
        (7, '- HbA1C', '- HbA1C', 13, 1, '5', NULL, NULL, '2022-11-29 15:01:21', 1),
        (8, '- NUMERATION GLOBULAIRI:', '- NUMERATION GLOBULAIRI:', 14, 1, '5', NULL, NULL, '2022-11-29 15:01:21', 1),
        (9, 'SELLE', 'SELLE', 7, 1, NULL, NULL, NULL, '2022-11-29 15:01:21', 1),
        (10, 'SEROLOGIES', 'SEROLOGIES', 9, 1, NULL, NULL, NULL, '2022-11-29 15:01:21', 1),
        (11, '- DIAGNOSTIC DE TREPONEMATOSES', '- DIAGNOSTIC DE TREPONEMATOSES', 15, 1, '10', NULL, NULL, '2022-11-29 15:01:21', 1),
        (12, '- REACTION DE WALER ROSE', '- REACTION DE WALER ROSE', 16, 1, '10', NULL, NULL, '2022-11-29 15:01:21', 1),
        (13, '- Serodiagnostic de widal (salmonelloses)', '- Serodiagnostic de widal (salmonelloses)', 17, 1, '10', NULL, NULL, '2022-11-29 15:01:21', 1),
        (14, '- SEROLOGIE DE H.I.V. 1 / 2 ', '- SEROLOGIE DE H.I.V. 1 / 2 ', 18, 1, '10', NULL, NULL, '2022-11-29 15:01:21', 1),
        (15, '- SEROLOGIE DE L\'HEPATITE B,C', '- SEROLOGIE DE L\'HEPATITE B,C', 19, 1, '10', NULL, NULL, '2022-11-29 15:01:21', 1),
        (16, '- SEROLOGIE DES INFECTIONS A STREPTOCOQUE', '- SEROLOGIE DES INFECTIONS A STREPTOCOQUE', 20, 1, '10', NULL, NULL, '2022-11-29 15:01:21', 1),
        (17, '- Serology de Helicobacter pylori ', '- Serology de Helicobacter pylori ', 21, 1, '10', NULL, NULL, '2022-11-29 14:38:59', 1),
        (18, '- TEST DE LATEX POUR DETECTION PROTEIN C (CRP)', '- TEST DE LATEX POUR DETECTION PROTEIN C (CRP)', 22, 1, '10', NULL, NULL, '2022-11-29 14:38:59', 1),
        (19, 'URINARIES ANALYSES', 'URINARIES ANALYSES', 5, 1, NULL, NULL, NULL, '2022-11-29 15:01:21', 1)");
    }
}
