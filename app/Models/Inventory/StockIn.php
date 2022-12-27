<?php

namespace App\Models\Inventory;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockIn extends BaseModel
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

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function stock_outs()
    {
        return $this->belongsToMany(StockOut::class, 'stock_out_details', 'stock_in_id', 'stock_out_id')
                    ->withPivot('qty')
                    ->withTimestamps();
    }

}
