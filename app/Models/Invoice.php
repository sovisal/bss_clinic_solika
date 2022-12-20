<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function detail()
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id');
    }
}
