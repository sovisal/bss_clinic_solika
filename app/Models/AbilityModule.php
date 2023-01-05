<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AbilityModule extends Model
{
    use HasFactory, SoftDeletes;
	protected $guarded = ['id'];
	
	public function abilities()
	{
		return $this->hasMany(Ability::class, 'ability_module_id');
	}

}
