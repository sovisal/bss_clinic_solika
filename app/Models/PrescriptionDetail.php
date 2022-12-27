<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrescriptionDetail extends BaseModel
{
    use HasFactory;
    protected $guarded = ['id'];

    public function product () {
        return $this->belongsTo(Inventory\Product::class, 'medicine_id');
    }

    public function unit()
    {
        return $this->belongsTo(Inventory\ProductUnit::class, 'unit_id');
    }
}
