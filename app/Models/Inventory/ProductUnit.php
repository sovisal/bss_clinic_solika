<?php

namespace App\Models\Inventory;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductUnit extends BaseModel
{
    use HasFactory, SoftDeletes;
	protected $guarded = ['id'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function packages()
    {
        return $this->hasMany(ProductPackage::class, 'product_unit_id');
    }

    public function getLinkAttribute()
    {
        if (($this->status ?? 0) > 0) { // will check permission
            return d_link(
                d_obj($this, ['name_en', 'name_kh']),
                route('inventory.product_unit.edit', [d_obj($this, 'id'), 'back' => url()->current()])
            );
        } else {
            return d_obj($this, ['name_en', 'name_kh']);
        }
    }
}
