<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\AbilityModule;
use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        AbilityModule::insert([
            [ 'id' => 1, 'module' => 'Role'],
            [ 'id' => 2, 'module' => 'User'],
            [ 'id' => 3, 'module' => 'Patient'],
            [ 'id' => 4, 'module' => 'Consultation'],
            [ 'id' => 5, 'module' => 'Doctor'],
            [ 'id' => 6, 'module' => 'Labor'],
            [ 'id' => 7, 'module' => 'Echography'],
            [ 'id' => 8, 'module' => 'XRay'],
            [ 'id' => 9, 'module' => 'ECG'],
            [ 'id' => 10, 'module' => 'LaborType'],
            [ 'id' => 11, 'module' => 'LaborItem'],
            [ 'id' => 12, 'module' => 'ParaClinic'],
            [ 'id' => 13, 'module' => 'Prescription'],
            [ 'id' => 14, 'module' => 'Medicine'],
            [ 'id' => 15, 'module' => 'Invoice'],
            [ 'id' => 16, 'module' => 'Service'],
            [ 'id' => 17, 'module' => 'Product'],
            [ 'id' => 18, 'module' => 'ProductCategory'],
            [ 'id' => 19, 'module' => 'ProductType'],
            [ 'id' => 20, 'module' => 'ProductUnit'],
            [ 'id' => 21, 'module' => 'ProductPackage'],
        ]);

        Ability::insert([
            ['ability_module_id' => '21', 'category' => 'ViewAny', 'name' => 'ViewAnyProductPackage', 'label' => 'ProductPackage View List'],
            ['ability_module_id' => '21', 'category' => 'Create', 'name' => 'CreateProductPackage', 'label' => 'ProductPackage Create'],
            ['ability_module_id' => '21', 'category' => 'Update', 'name' => 'UpdateProductPackage', 'label' => 'ProductPackage Update'],
            ['ability_module_id' => '21', 'category' => 'Delete', 'name' => 'DeleteProductPackage', 'label' => 'ProductPackage Delete'],
            
            ['ability_module_id' => '20', 'category' => 'ViewAny', 'name' => 'ViewAnyProductUnit', 'label' => 'ProductUnit View List'],
            ['ability_module_id' => '20', 'category' => 'Create', 'name' => 'CreateProductUnit', 'label' => 'ProductUnit Create'],
            ['ability_module_id' => '20', 'category' => 'Update', 'name' => 'UpdateProductUnit', 'label' => 'ProductUnit Update'],
            ['ability_module_id' => '20', 'category' => 'Delete', 'name' => 'DeleteProductUnit', 'label' => 'ProductUnit Delete'],
            
            ['ability_module_id' => '19', 'category' => 'ViewAny', 'name' => 'ViewAnyProductType', 'label' => 'ProductType View List'],
            ['ability_module_id' => '19', 'category' => 'Create', 'name' => 'CreateProductType', 'label' => 'ProductType Create'],
            ['ability_module_id' => '19', 'category' => 'Update', 'name' => 'UpdateProductType', 'label' => 'ProductType Update'],
            ['ability_module_id' => '19', 'category' => 'Delete', 'name' => 'DeleteProductType', 'label' => 'ProductType Delete'],
            
            ['ability_module_id' => '18', 'category' => 'ViewAny', 'name' => 'ViewAnyProductCategory', 'label' => 'ProductCategory View List'],
            ['ability_module_id' => '18', 'category' => 'Create', 'name' => 'CreateProductCategory', 'label' => 'ProductCategory Create'],
            ['ability_module_id' => '18', 'category' => 'Update', 'name' => 'UpdateProductCategory', 'label' => 'ProductCategory Update'],
            ['ability_module_id' => '18', 'category' => 'Delete', 'name' => 'DeleteProductCategory', 'label' => 'ProductCategory Delete'],

            ['ability_module_id' => '17', 'category' => 'ViewAny', 'name' => 'ViewAnyProduct', 'label' => 'Product View List'],
            ['ability_module_id' => '17', 'category' => 'Create', 'name' => 'CreateProduct', 'label' => 'Product Create'],
            ['ability_module_id' => '17', 'category' => 'Update', 'name' => 'UpdateProduct', 'label' => 'Product Update'],
            ['ability_module_id' => '17', 'category' => 'Delete', 'name' => 'DeleteProduct', 'label' => 'Product Delete'],

            ['ability_module_id' => '16', 'category' => 'ViewAny', 'name' => 'ViewAnyService', 'label' => 'Service View List'],
            ['ability_module_id' => '16', 'category' => 'Create', 'name' => 'CreateService', 'label' => 'Service Create'],
            ['ability_module_id' => '16', 'category' => 'Update', 'name' => 'UpdateService', 'label' => 'Service Update'],
            ['ability_module_id' => '16', 'category' => 'Delete', 'name' => 'DeleteService', 'label' => 'Service Delete'],

            ['ability_module_id' => '15', 'category' => 'ViewAny', 'name' => 'ViewAnyInvoice', 'label' => 'Invoice View List'],
            ['ability_module_id' => '15', 'category' => 'Create', 'name' => 'CreateInvoice', 'label' => 'Invoice Create'],
            ['ability_module_id' => '15', 'category' => 'Update', 'name' => 'UpdateInvoice', 'label' => 'Invoice Update'],
            ['ability_module_id' => '15', 'category' => 'Delete', 'name' => 'DeleteInvoice', 'label' => 'Invoice Delete'],

            ['ability_module_id' => '14', 'category' => 'ViewAny', 'name' => 'ViewAnyMedicine', 'label' => 'Medicine View List'],
            ['ability_module_id' => '14', 'category' => 'Create', 'name' => 'CreateMedicine', 'label' => 'Medicine Create'],
            ['ability_module_id' => '14', 'category' => 'Update', 'name' => 'UpdateMedicine', 'label' => 'Medicine Update'],
            ['ability_module_id' => '14', 'category' => 'Delete', 'name' => 'DeleteMedicine', 'label' => 'Medicine Delete'],

            ['ability_module_id' => '13', 'category' => 'ViewAny', 'name' => 'ViewAnyPrescription', 'label' => 'Prescription View List'],
            ['ability_module_id' => '13', 'category' => 'Create', 'name' => 'CreatePrescription', 'label' => 'Prescription Create'],
            ['ability_module_id' => '13', 'category' => 'Update', 'name' => 'UpdatePrescription', 'label' => 'Prescription Update'],
            ['ability_module_id' => '13', 'category' => 'Delete', 'name' => 'DeletePrescription', 'label' => 'Prescription Delete'],

            ['ability_module_id' => '12', 'category' => 'ViewAny', 'name' => 'ViewAnyParaClinic', 'label' => 'ParaClinic View List'],
            ['ability_module_id' => '12', 'category' => 'Create', 'name' => 'CreateParaClinic', 'label' => 'ParaClinic Create'],
            ['ability_module_id' => '12', 'category' => 'Update', 'name' => 'UpdateParaClinic', 'label' => 'ParaClinic Update'],
            ['ability_module_id' => '12', 'category' => 'Delete', 'name' => 'DeleteParaClinic', 'label' => 'ParaClinic Delete'],

            ['ability_module_id' => '11', 'category' => 'ViewAny', 'name' => 'ViewAnyLaborItem', 'label' => 'LaborItem View List'],
            ['ability_module_id' => '11', 'category' => 'Create', 'name' => 'CreateLaborItem', 'label' => 'LaborItem Create'],
            ['ability_module_id' => '11', 'category' => 'Update', 'name' => 'UpdateLaborItem', 'label' => 'LaborItem Update'],
            ['ability_module_id' => '11', 'category' => 'Delete', 'name' => 'DeleteLaborItem', 'label' => 'LaborItem Delete'],

            ['ability_module_id' => '10', 'category' => 'ViewAny', 'name' => 'ViewAnyLaborType', 'label' => 'LaborType View List'],
            ['ability_module_id' => '10', 'category' => 'Create', 'name' => 'CreateLaborType', 'label' => 'LaborType Create'],
            ['ability_module_id' => '10', 'category' => 'Update', 'name' => 'UpdateLaborType', 'label' => 'LaborType Update'],
            ['ability_module_id' => '10', 'category' => 'Delete', 'name' => 'DeleteLaborType', 'label' => 'LaborType Delete'],

            ['ability_module_id' => '9', 'category' => 'ViewAny', 'name' => 'ViewAnyECG', 'label' => 'ECG View List'],
            ['ability_module_id' => '9', 'category' => 'Create', 'name' => 'CreateECG', 'label' => 'ECG Create'],
            ['ability_module_id' => '9', 'category' => 'Update', 'name' => 'UpdateECG', 'label' => 'ECG Update'],
            ['ability_module_id' => '9', 'category' => 'Delete', 'name' => 'DeleteECG', 'label' => 'ECG Delete'],

            ['ability_module_id' => '8', 'category' => 'ViewAny', 'name' => 'ViewAnyXRay', 'label' => 'XRay View List'],
            ['ability_module_id' => '8', 'category' => 'Create', 'name' => 'CreateXRay', 'label' => 'XRay Create'],
            ['ability_module_id' => '8', 'category' => 'Update', 'name' => 'UpdateXRay', 'label' => 'XRay Update'],
            ['ability_module_id' => '8', 'category' => 'Delete', 'name' => 'DeleteXRay', 'label' => 'XRay Delete'],

            ['ability_module_id' => '7', 'category' => 'ViewAny', 'name' => 'ViewAnyEchography', 'label' => 'Echography View List'],
            ['ability_module_id' => '7', 'category' => 'Create', 'name' => 'CreateEchography', 'label' => 'Echography Create'],
            ['ability_module_id' => '7', 'category' => 'Update', 'name' => 'UpdateEchography', 'label' => 'Echography Update'],
            ['ability_module_id' => '7', 'category' => 'Delete', 'name' => 'DeleteEchography', 'label' => 'Echography Delete'],

            ['ability_module_id' => '6', 'category' => 'ViewAny', 'name' => 'ViewAnyLabor', 'label' => 'Labor View List'],
            ['ability_module_id' => '6', 'category' => 'Create', 'name' => 'CreateLabor', 'label' => 'Labor Create'],
            ['ability_module_id' => '6', 'category' => 'Update', 'name' => 'UpdateLabor', 'label' => 'Labor Update'],
            ['ability_module_id' => '6', 'category' => 'Delete', 'name' => 'DeleteLabor', 'label' => 'Labor Delete'],

            ['ability_module_id' => '5', 'category' => 'ViewAny', 'name' => 'ViewAnyDoctor', 'label' => 'Doctor View List'],
            ['ability_module_id' => '5', 'category' => 'Create', 'name' => 'CreateDoctor', 'label' => 'Doctor Create'],
            ['ability_module_id' => '5', 'category' => 'Update', 'name' => 'UpdateDoctor', 'label' => 'Doctor Update'],
            ['ability_module_id' => '5', 'category' => 'Delete', 'name' => 'DeleteDoctor', 'label' => 'Doctor Delete'],

            ['ability_module_id' => '4', 'category' => 'ViewAny', 'name' => 'ViewAnyConsultation', 'label' => 'Consultation View List'],
            ['ability_module_id' => '4', 'category' => 'Create', 'name' => 'CreateConsultation', 'label' => 'Consultation Create'],
            ['ability_module_id' => '4', 'category' => 'Update', 'name' => 'UpdateConsultation', 'label' => 'Consultation Update'],
            ['ability_module_id' => '4', 'category' => 'Delete', 'name' => 'DeleteConsultation', 'label' => 'Consultation Delete'],

            ['ability_module_id' => '3', 'category' => 'ViewAny', 'name' => 'ViewAnyPatient', 'label' => 'Patient View List'],
            ['ability_module_id' => '3', 'category' => 'Create', 'name' => 'CreatePatient', 'label' => 'Patient Create'],
            ['ability_module_id' => '3', 'category' => 'Update', 'name' => 'UpdatePatient', 'label' => 'Patient Update'],
            ['ability_module_id' => '3', 'category' => 'Delete', 'name' => 'DeletePatient', 'label' => 'Patient Delete'],

            ['ability_module_id' => '2', 'category' => 'ViewAny', 'name' => 'ViewAnyUser', 'label' => 'User View List'],
            ['ability_module_id' => '2', 'category' => 'Create', 'name' => 'CreateUser', 'label' => 'User Create'],
            ['ability_module_id' => '2', 'category' => 'Update', 'name' => 'UpdateUser', 'label' => 'User Update'],
            ['ability_module_id' => '2', 'category' => 'Other', 'name' => 'UpdateUserPassword', 'label' => 'User Update Password'],
            ['ability_module_id' => '2', 'category' => 'Delete', 'name' => 'DeleteUser', 'label' => 'User Delete'],
            ['ability_module_id' => '2', 'category' => 'Other', 'name' => 'AssignUserRole', 'label' => 'User Assign Role'],
            ['ability_module_id' => '2', 'category' => 'Other', 'name' => 'AssignUserAbility', 'label' => 'User Assign Ability'],

            ['ability_module_id' => '1', 'category' => 'ViewAny', 'name' => 'ViewAnyRole', 'label' => 'Role View List'],
            ['ability_module_id' => '1', 'category' => 'Create', 'name' => 'CreateRole', 'label' => 'Role Create'],
            ['ability_module_id' => '1', 'category' => 'Update', 'name' => 'UpdateRole', 'label' => 'Role Update'],
            ['ability_module_id' => '1', 'category' => 'Delete', 'name' => 'DeleteRole', 'label' => 'Role Delete'],
            ['ability_module_id' => '1', 'category' => 'Other', 'name' => 'AssignRoleAbility', 'label' => 'Role Assign Ability'],

        ]);
    }
}
