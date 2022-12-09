<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaborType extends BaseModel
{
	use HasFactory;

	protected $guarded = ['id'];

	public function items()
	{
		return $this->hasMany(LaborItem::class, 'type')->where('status', 1);
	}

	public function types()
	{
		return $this->hasMany(LaborType::class, 'parent_id')->where('status', 1);
	}

	public function item()
	{
		return $this->hasMany(LaborItem::class, 'type');
	}

	// Separate Labor type into 2 level of groups
	// public function scopeRegroupe($query)
	// {
	// 	$types = $query->get() ?: [];
	// 	$result = [];
	// 	foreach ($types as $labor_type) {
	// 		if (substr($labor_type->name_en, 0, 2) == '- ') {
	// 			$last_labor_type = end($result);
	// 			$last_labor_type->is_parent = true;
	// 			$last_labor_type->child = array_merge($last_labor_type->child, [$labor_type]);
	// 			$result[count($result) - 1] = $last_labor_type;
	// 		} else {
	// 			$labor_type->is_parent = false;
	// 			$labor_type->child = [];
	// 			$result[] = $labor_type;
	// 		}
	// 	}
	// 	return $result;
	// }

	// Separate Labor type into 2 level of groups
	public function scopeRegroupe($query)
	{
		$types = $query->whereNull('parent_id')->with(['types' => fn($q) => $q->with(['items'])])->get() ?: [];
		$result = [];
		foreach ($types as $labor_type) {
			$labor_type->is_parent = $labor_type->parent_id > 0;
			$labor_type->child = (array) $labor_type->types->all();
			$result[] = $labor_type;
		}
		return $result;
	}
}
