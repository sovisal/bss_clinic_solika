<?php

namespace App\Models\Inventory;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductPackage extends BaseModel
{
    use HasFactory, SoftDeletes;
	protected $guarded = ['id'];
    
    public function unit()
    {
        return $this->belongsTo(ProductUit::class, 'product_unit_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
