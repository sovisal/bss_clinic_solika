<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaborItem extends Model
{
	use HasFactory;
	protected $fillable = [
		'name_en', 'name_kh',
		'min_range', 'max_range', 'unit', 'type',
		'status', 'index', 'other'
	];

	public function hasType()
	{
		return $this->belongsTo(LaborType::class, 'type');
	}

	public function category()
	{
		return $this->belongsTo(LaborType::class, 'type')->first();
	}
}
