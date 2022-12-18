<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Xray extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    public $route = 'para_clinic.xray';

    public function type()
    {
        return $this->belongsTo(XrayType::class);
    }
}
