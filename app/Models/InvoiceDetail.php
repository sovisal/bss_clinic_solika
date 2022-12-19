<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceDetail extends BaseModel
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'invoice_items';
    protected $fillable = ['service_id', 'service_name', 'service_type', 'price', 'qty', 'total', 'description', 'exchange_rate'];
}
