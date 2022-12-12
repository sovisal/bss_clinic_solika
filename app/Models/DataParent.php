<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataParent extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title_en', 'title_kh', 'description', 'status', 'type', 'parent_id',
        'user_id', 'status'
    ];

    public function scopeUsage($query)
    {
        $query->where('type', 'usage')->where('status', 1);
    }
}
