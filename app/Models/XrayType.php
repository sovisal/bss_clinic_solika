<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class XrayType extends BaseModel
{
  use HasFactory, SoftDeletes;
  protected $fillable = [
    'name_en', 'name_kh', 'default_form', 'attribite', 'price',
    'user_id', 'status', 'index', 'other'
  ];
}
