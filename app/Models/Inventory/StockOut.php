<?php

namespace App\Models\Inventory;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockOut extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function unit()
    {
        return $this->belongsTo(ProductUnit::class, 'unit_id');
    }

    public function stock_ins()
    {
        return $this->belongsToMany(StockIn::class, 'stock_out_details', 'stock_out_id', 'stock_in_id')
                    ->withPivot('qty')
                    ->withTimestamps();
    }

}
