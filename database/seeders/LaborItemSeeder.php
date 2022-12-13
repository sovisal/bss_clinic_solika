<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaborItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::insert("INSERT INTO `labor_items` (`id`, `name_en`, `name_kh`, `min_range`, `max_range`, `unit`, `type_id`, `status`, `index`, `other`, `created_at`, `updated_at`, `user_id`) VALUES
        (1, 'Leucocytes', 'Leucocytes', '100', '200', '10<sup>3</sup>3/uL', 1, 1, 1, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', NULL, '2022-11-29 14:57:42', 1),
        (2, 'Hématies', 'Hématies', '10', '20', '10<sup>6</sup>6/uL', 1, 1, 2, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', NULL, '2022-11-29 14:57:42', 1),
        (3, 'Polynucléaire neutrophile', 'Polynucléaire neutrophile', '1', '100', '%', 4, 1, 25, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', NULL, '2022-11-29 14:57:42', 1),
        (4, 'Crachat (Recherche BK)', 'Crachat (Recherche BK)', '0', '0', '0', 1, 1, 3, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:35:02', '2022-11-29 14:57:42', 1),
        (5, 'Glycemie', 'Glycemie', '0', '0', '0', 2, 1, 4, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:35:33', '2022-11-29 14:57:42', 1),
        (6, 'Calcemie', 'Calcemie', '0', '0', '0', 2, 1, 5, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:35:54', '2022-11-29 14:57:42', 1),
        (7, 'Uree sanguine', 'Uree sanguine', '0', '0', '0', 2, 1, 6, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:36:16', '2022-11-29 14:57:42', 1),
        (8, 'Transaminase (ASAT/GOT)', 'Transaminase (ASAT/GOT)', '0', '0', '0', 2, 1, 7, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:36:31', '2022-11-29 14:57:42', 1),
        (9, 'Cholesterol', 'Cholesterol', '0', '0', '0', 2, 1, 8, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:36:44', '2022-11-29 14:57:42', 1),
        (10, 'Creatinine', 'Creatinine', '0', '0', '0', 2, 1, 9, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:36:55', '2022-11-29 14:57:42', 1),
        (11, 'Transaminase (ALAT/GPT)', 'Transaminase (ALAT/GPT)', '0', '0', '0', 2, 1, 10, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:37:07', '2022-11-29 14:57:42', 1),
        (12, 'Triglyceride', 'Triglyceride', '0', '0', '0', 2, 1, 11, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:37:18', '2022-11-29 14:57:42', 1),
        (13, 'Acide urique', 'Acide urique', '0', '0', '0', 2, 1, 12, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:37:32', '2022-11-29 14:57:42', 1),
        (14, 'Groupage Sanguine (ABO)', 'Groupage Sanguine (ABO)', '0', '0', '0', 5, 1, 13, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:38:14', '2022-11-29 14:57:42', 1),
        (15, 'Malaria', 'Malaria', '0', '0', '0', 5, 1, 14, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:38:26', '2022-11-29 14:57:42', 1),
        (16, 'HbA1c', 'HbA1c', '0', '0', '0', 5, 1, 15, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:38:39', '2022-11-29 14:57:42', 1),
        (17, 'Polynucléaire neutrophile', 'Polynucléaire neutrophile', '0', '0', '0', 6, 1, 26, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:39:20', '2022-11-29 14:57:42', 1),
        (18, 'Polynucléaire éosinophile', 'Polynucléaire éosinophile', '0', '0', '0', 6, 1, 27, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:39:32', '2022-11-29 14:57:42', 1),
        (19, 'Lymphocytes', 'Lymphocytes', '0', '0', '0', 6, 1, 28, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:39:44', '2022-11-29 14:57:42', 1),
        (20, 'Monocytes', 'Monocytes', '0', '0', '0', 6, 1, 29, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:39:55', '2022-11-29 14:57:42', 1),
        (21, 'polynucléaire basophile', 'polynucléaire basophile', '0', '0', '0', 6, 1, 30, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:40:08', '2022-11-29 14:57:42', 1),
        (22, 'plaquettes', 'plaquettes', '0', '0', '0', 8, 1, 31, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:40:27', '2022-11-29 14:57:42', 1),
        (23, 'Hématies', 'Hématies', '0', '0', '0', 8, 1, 32, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:40:40', '2022-11-29 14:57:42', 1),
        (24, 'Hématocrite', 'Hématocrite', '0', '0', '0', 8, 1, 33, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:40:53', '2022-11-29 14:57:42', 1),
        (25, 'Leucocytes', 'Leucocytes', '0', '0', '0', 8, 1, 34, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:41:04', '2022-11-29 14:57:42', 1),
        (26, 'Hémoglobine', 'Hémoglobine', '0', '0', '0', 8, 1, 35, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:41:17', '2022-11-29 14:57:42', 1),
        (27, 'Aspect', 'Aspect', '0', '0', '0', 9, 1, 16, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:42:58', '2022-11-29 14:57:42', 1),
        (28, 'Antibody anti-Helicobacter pylori ( IgM.)( Ig M)', 'Antibody anti-Helicobacter pylori ( IgM.)( Ig M)', '0', '0', '0', 17, 1, 36, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:45:30', '2022-11-29 14:57:42', 1),
        (29, 'Antigen O: salmonella Typhi', 'Antigen O: salmonella Typhi', '0', '0', '0', 13, 1, 37, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:48:19', '2022-11-29 14:57:42', 1),
        (30, 'Antigen H: salmonella Typhi', 'Antigen H: salmonella Typhi', '0', '0', '0', 13, 1, 38, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:48:37', '2022-11-29 14:57:42', 1),
        (31, 'ASLO antistreptolysine”o”', 'ASLO antistreptolysine”o”', '0', '0', '0', 16, 1, 39, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:50:27', '2022-11-29 14:57:42', 1),
        (32, 'Rheumatoid Factor (taux d’agglutination)', 'Rheumatoid Factor (taux d’agglutination)', '0', '0', '0', 12, 1, 40, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:50:49', '2022-11-29 14:57:42', 1),
        (33, 'CRP(tauxd’agglutination)', 'CRP(tauxd’agglutination)', '0', '0', '0', 18, 1, 41, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:51:06', '2022-11-29 14:57:42', 1),
        (34, 'Recherche Antigen HBs', 'Recherche Antigen HBs', '0', '0', '0', 15, 1, 42, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:52:02', '2022-11-29 14:57:42', 1),
        (35, 'Recherche Antibody HBs', 'Recherche Antibody HBs', '0', '0', '0', 15, 1, 43, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:52:17', '2022-11-29 14:57:42', 1),
        (36, 'Recherche Antibody HCV', 'Recherche Antibody HCV', '0', '0', '0', 15, 1, 44, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:52:36', '2022-11-29 14:57:42', 1),
        (37, 'T.P.H.A (Hem agglutination)', 'T.P.H.A (Hem agglutination)', '0', '0', '0', 11, 1, 45, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:55:46', '2022-11-29 14:57:42', 1),
        (38, 'VDRL', 'VDRL', '0', '0', '0', 11, 1, 46, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:56:03', '2022-11-29 14:57:42', 1),
        (39, 'H.I.V', 'H.I.V', '0', '0', '0', 14, 1, 47, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:56:50', '2022-11-29 14:57:42', 1),
        (40, 'pH', 'pH', '0', '0', '0', 19, 1, 17, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:57:25', '2022-11-29 14:57:42', 1),
        (41, 'Leu', 'Leu', '0', '0', '0', 19, 1, 18, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:57:37', '2022-11-29 14:57:42', 1),
        (42, 'Ase', 'Ase', '0', '0', '0', 19, 1, 19, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:57:51', '2022-11-29 14:57:42', 1),
        (43, 'Glucose', 'Glucose', '0', '0', '0', 19, 1, 20, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:58:02', '2022-11-29 14:57:42', 1),
        (44, 'Nit', 'Nit', '0', '0', '0', 19, 1, 21, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:58:14', '2022-11-29 14:57:42', 1),
        (45, 'Pregnancy', 'Pregnancy', '0', '0', '0', 19, 1, 22, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:58:25', '2022-11-29 14:57:42', 1),
        (46, 'Albumin', 'Albumin', '0', '0', '0', 19, 1, 23, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:58:38', '2022-11-29 14:57:42', 1),
        (47, 'Ket', 'Ket', '0', '0', '0', 19, 1, 24, 'OUT_RANGE_COLOR_RED, NEGATIVE_COLOR_RED', '2022-06-09 16:58:50', '2022-11-29 14:57:42', 1)");
    }
}
