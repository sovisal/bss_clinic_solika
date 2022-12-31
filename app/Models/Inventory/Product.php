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

    public function updateQty()
    {
        $this->update([
            'qty_in' => $this->stockins->sum('qty_based'),
            'qty_out' => $this->stockins->sum('qty_used'),
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

    public function scopeOutOfStock($query)
    {
        return $query->whereRaw('qty_remain <= qty_alert');
    }

    public function scopeAvaiableStock($query)
    {
        return $query->where('status', '>=', '1')->where('qty_remain', '>', '0');
    }

    public function getAccuratePrice ($unit_id = null) {
        if ($unit_id) {
            if ($unit_id != $this->unit_id) {
                $matched_package = $this->packages()->where('product_unit_id', $unit_id)->first();
                if ($matched_package && $matched_package->price) {
                    return $matched_package->price;
                }
            }
        }
        return $this->price;
    }

    public function getCalculationQty ($unit_id = null) {
        if ($unit_id) {
            if ($unit_id != $this->unit_id) {
                $matched_package = $this->packages()->where('product_unit_id', $unit_id)->first();
                if ($matched_package && $matched_package->qty) {
                    return $matched_package->qty;
                }
            }
        }
        return 1;
    }
}
