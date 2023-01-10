<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    
    public function consultations()
    {
        return $this->hasMany(Consultation::class, 'patient_id')->orderBy('status', 'asc');
    }
    
    public function lastedConsultation()
    {
        return $this->hasMany(Consultation::class, 'patient_id')->orderBy('status', 'asc')->first();
    }

    public function hasOneConsultation()
    {
        return $this->hasOne(Consultation::class, 'patient_id')->latest();
    }

    public function gender()
    {
        return $this->belongsTo(DataParent::class, 'gender_id');
    }

    public function nationality()
    {
        return $this->belongsTo(DataParent::class, 'nationality_id');
    }

    public function enterprise()
    {
        return $this->belongsTo(DataParent::class, 'enterprise_id');
    }

    public function marital_status()
    {
        return $this->belongsTo(DataParent::class, 'marital_status_id');
    }

    public function blood_type()
    {
        return $this->belongsTo(DataParent::class, 'blood_type_id');
    }

    public function address()
    {
        return $this->belongsTo(Address_linkable::class, 'address_id');
    }

    public function history()
    {
        $history = new collection();
        $history = $history->concat($this->prescriptions->map(function($row){
            $row->row_type = 'prescription';
            $row->url = route('prescription.print', $row->id);
            return $row;
        } ));
        $history = $history->concat($this->labors->map(function($row){
            $row->row_type = 'labor';
            $row->url = route('para_clinic.labor.print', $row->id);
            return $row;
        } ));
        $history = $history->concat($this->xrays->map(function($row){
            $row->row_type = 'xray';
            $row->url = route('para_clinic.xray.print', $row->id);
            return $row;
        } ));
        $history = $history->concat($this->echos->map(function($row){
            $row->row_type = 'echo';
            $row->url = route('para_clinic.echography.print', $row->id);
            return $row;
        } ));
        $history = $history->concat($this->ecgs->map(function($row){
            $row->row_type = 'ecg';
            $row->url = route('para_clinic.ecg.print', $row->id);
            return $row;
        } ));
        $history = $history->sortByDesc('requested_at');
        
        return $history;

    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'patient_id');
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'patient_id');
    }

    public function labors()
    {
        return $this->hasMany(Laboratory::class, 'patient_id');
    }

    public function xrays()
    {
        return $this->hasMany(Xray::class, 'patient_id');
    }
    
    public function echos()
    {
        return $this->hasMany(Echography::class, 'patient_id');
    }

    public function ecgs()
    {
        return $this->hasMany(Ecg::class, 'patient_id');
    }

    public function getLinkAttribute()
    {
        if ($this->status > 0 && can('UpdatePatient')) { // will check permission
            return d_link(d_obj($this, ['name_en', 'name_kh']), route('patient.edit', [d_obj($this, 'id'), 'back' => url()->current()]));
        } else {
            return d_obj($this, ['name_en', 'name_kh']);
        }
    }
}
