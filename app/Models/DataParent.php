<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataParent extends BaseModel
{
	use HasFactory;

	protected $fillable = [
		'title_en', 'title_kh', 'description', 'status', 'type', 'parent_id'
	];

	public function scopeType($query, $type = []){
        if (!is_array($type)) {
            $type = [$type];
        }
		$query->whereIn('type', $type)->where('status', 1);
	}
}
