<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laboratory extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    public $route = 'para_clinic.labor';

    public function details()
	{
		return $this->hasMany(LaborDetail::class, 'labor_id');
	}
}
