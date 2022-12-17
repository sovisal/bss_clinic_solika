<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Echography extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function type()
    {
        return $this->belongsTo(EchoType::class);
    }

    public function getfilterAttrAttribute () {
        return array_except(filter_unit_attr(unserialize($this->attribute) ?: []), ['patient_id', 'gender_id', 'age', 'doctor_id', 'status', 'amount', 'price', 'payment_type', 'address_id', 'pt_province_id', 'pt_district_id', 'pt_commune_id', 'pt_village_id', 'name_kh', 'name_en', 'index', 'requested_by']);
    }
}
