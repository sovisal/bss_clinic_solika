<?php

namespace App\Models\Inventory;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends BaseModel
{
    use HasFactory, SoftDeletes;
	protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function unit()
    {
        return $this->belongsTo(ProductUnit::class, 'unit_id');
    }

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'type_id');
    }

    public function packages()
    {
        return $this->hasMany(ProductPackage::class, 'product_id');
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'supplier_id');
    }

    public function stockins ()
    {
        return $this->hasMany(StockIn::class, 'product_id');
    }

    public function stock_outs ()
    {
        return $this->hasMany(StockOut::class, 'product_id');
    }

    public function updateQtyRamain()
    {
        $this->update(['qty_remain' => $this->stockins()->sum('qty_remain')]);
        return $this;
    }

    public function updateQty()
    {
        $this->update([
            'qty_in' => $this->stockins->sum('qty_based'),
            'qty_out' => $this->stock_outs->sum('qty'),
            'qty_remain' => $this->stockins->sum('qty_remain'),
        ]);
        return $this;
    }

    public function getLinkAttribute()
    {
        if (($this->status ?? 0) > 0) { // will check permission
            return d_link(
                d_obj($this, ['name_en', 'name_kh']),
                route('inventory.product.edit', [d_obj($this, 'id'), 'back' => url()->current()])
            );
        } else {
            return d_obj($this, ['name_en', 'name_kh']);
        }
    }
}
