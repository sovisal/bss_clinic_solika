<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ecg extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    public $route = 'para_clinic.ecg';

    public function type()
    {
        return $this->belongsTo(EcgType::class);
    }
}
