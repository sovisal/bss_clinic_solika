<?php

namespace App\Models\Inventory;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'type_id');
    }

    // public function products()
    // {
    //     return $this->belongsToMany(Product::class, 'supplier_id')->withTimestamps();
    // }
    
    public function assignProduct($products = [])
    {
        $this->hasAbilities()->sync($products);
    }
}
