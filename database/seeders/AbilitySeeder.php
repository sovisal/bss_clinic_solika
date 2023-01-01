<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\AbilityModule;
use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{

    public function run()
    {

        $crud = [ 'ViewAny', 'Create', 'Update', 'Delete', 'Restore', 'ForceDelete' ];

        $data = [
            'Role' => [
                ['category' => 'Other', 'name' => 'AssignRoleAbility', 'label' => 'Role Assign Ability']
            ],
            'User' => [
                ['category' => 'Other', 'name' => 'UpdateUserPassword', 'label' => 'User Update Password'],
                ['category' => 'Other', 'name' => 'AssignUserRole', 'label' => 'User Assign Role'],
                ['category' => 'Other', 'name' => 'AssignUserAbility', 'label' => 'User Assign Ability']
            ],
            'Patient' => [
                ['category' => 'Other', 'name' => 'PrintPatient', 'label' => 'Patient Print']
            ],
            'Labor' => [
                ['category' => 'Other', 'name' => 'PrintLaboratory', 'label' => 'Laboratory Print']
            ],
            'Echography' => [
                ['category' => 'Other', 'name' => 'PrintEchography', 'label' => 'Echography Print']
            ],
            'XRay' => [
                ['category' => 'Other', 'name' => 'PrintXRay', 'label' => 'XRay Print']
            ],
            'ECG' => [
                ['category' => 'Other', 'name' => 'PrintECG', 'label' => 'ECG Print']
            ],
            'Prescription' => [
                ['category' => 'Other', 'name' => 'PrintPrescription', 'label' => 'Prescription Print']
            ],
            'Invoice' => [
                ['category' => 'Other', 'name' => 'PrintInvoice', 'label' => 'Invoice Print']
            ],
            'Product' => [
                ['category' => 'Other', 'name' => 'PrintInvoice', 'label' => 'Invoice Print']
            ],
            'Consultation' => [],
            'Doctor' => [],
            'Service' => [],
            'LaborType' => [],
            'LaborItem' => [],
            'EchoType' => [],
            'ECGType' => [],
            'XRayType' => [],
            'Address' => [],
            'DataSection' => [],
            'ProductCategory' => [],
            'ProductType' => [],
            'ProductUnit' => [],
            'Supplier' => [],
            'StockAdjustment' => [],
            'StockBalance' => [],
            'StockOut' => [],
            'StockIn' => [],
            'StockAlert' => [],
        ];

        $index = 0;
        foreach ($data as $module => $abilities) {
            // AbilityModule::create
        }
    }
}
