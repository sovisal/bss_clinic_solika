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

	public function scopeType($query, $type = []){
        if (!is_array($type)) {
            $type = [$type];
        }
		$query->whereIn('type', $type)->where('status', 1);
	}
}
