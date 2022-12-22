<?php

namespace App\Models\Inventory;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductType extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
