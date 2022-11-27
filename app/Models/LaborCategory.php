<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaborCategory extends Model
{
	use HasFactory;
	protected $table = 'labor_type';

	public function hasLaborItems()
	{
		return $this->hasMany(LaborItem::class, 'type');
	}

}
