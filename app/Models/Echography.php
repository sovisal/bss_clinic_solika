<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Echography extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    public $route = 'para_clinic.echography';

    public function type()
    {
        return $this->belongsTo(EchoType::class);
    }
}
