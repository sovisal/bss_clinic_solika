<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaborType extends BaseModel
{
	use HasFactory, SoftDeletes;

	protected $guarded = ['id'];

	public function items()
	{
		return $this->hasMany(LaborItem::class, 'type_id')->where('status', 1)->orderBy('index', 'asc');
	}

	public function types()
	{
		return $this->hasMany(LaborType::class, 'parent_id')->where('status', 1)->orderBy('index', 'asc');
	}

	public function parent()
	{
		return $this->belongsTo(LaborType::class, 'parent_id')->where('status', 1);
	}

	// Separate Labor type into 2 level of groups
	public function scopeRegroupe($query)
	{
		$types = $query->whereNull('parent_id')->with(['types' => function ($q) { return $q->with(['items']); }])->get() ?: [];
		$result = [];
		foreach ($types as $labor_type) {
			$labor_type->is_parent = $labor_type->parent_id > 0;
			$labor_type->child = (array) $labor_type->types->all();
			$result[] = $labor_type;
		}
		return $result;
	}
}
