<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prescription extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    public $route = 'prescription';

    public function detail()
    {
        return $this->hasMany(PrescriptionDetail::class, 'prescription_id');
    }

    public function updateQty()
    {
        $this->update([
            'price' => $this->detail()->sum(\DB::raw('price * qty'))
        ]);
    }
}
