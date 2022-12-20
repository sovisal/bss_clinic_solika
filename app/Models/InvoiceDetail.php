<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceDetail extends BaseModel
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'invoice_items';
    protected $fillable = ['service_id', 'service_name', 'service_type', 'price', 'qty', 'total', 'description', 'exchange_rate'];

    public function paraClinicItem()
    {
        if ($this->service_type == 'echography') {
            return $this->belongsTo(Echography::class, 'service_id', 'id');
        } elseif ($this->service_type == 'ecg') {
            return $this->belongsTo(Ecg::class, 'service_id', 'id');
        } elseif ($this->service_type == 'xray') {
            return $this->belongsTo(Xray::class, 'service_id', 'id');
        }
    }
}
