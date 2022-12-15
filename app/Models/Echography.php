<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Echography extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function echoType()
    {
        return $this->belongsTo(EchoType::class, 'type');
    }
}
