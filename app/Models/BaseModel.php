<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory;

    protected static function boot()
    {
        static::creating(function ($model) {
            if (Auth()->user()) {
                $model->user_id = Auth()->user()->id;
                $model->status = 1;
            }
        });
        
        parent::boot();
    }

    public function scopeFilter($query)
    {
        $query->when(request()->ft_daterangepicker_drp_start, function ($query, $daterangepicker_drp_start) {
            $query->where('requested_at', '>=', ($daterangepicker_drp_start . ' 00:00:00'));
        });
        $query->when(request()->ft_daterangepicker_drp_end, function ($query, $daterangepicker_drp_end) {
            $query->where('requested_at', '<=', ($daterangepicker_drp_end . ' 23:59:59'));
        });
        $query->when(request()->ft_patient_id, function ($query, $patient_id) {
            $query->where('patient_id', '=', $patient_id);
        });
    }

    public function scopeExclude($query, $value = [])
    {
        return $query->select(array_diff($this->columns, (array) $value));
    }

    // get Data Select2
    static function getSelect2($default_filter = [], $orderBy = [], $select = [])
    {
        $order_by = '';
        $orderBy = $orderBy ?: ['name', 'ASC'];
        if (is_array($orderBy[0])) {
            foreach ($orderBy as $order) {
                if ($order_by == '') {
                    $order_by = '`' . $order[0] . '` ' . $order[1];
                } else {
                    $order_by .= ', `' . $order[0] . '` ' . $order[1];
                }
            }
        } else {
            $order_by = '`' . $orderBy[0] . '` ' . $orderBy[1];
        }

        $select = ((is_array($select) && (count($select) > 1)) ? $select : ['id', 'name']);

        request()->merge($default_filter);
        $collection = parent::orderByRaw($order_by)
            ->select($select)
            ->limit(5)->get();
        $response = array();
        foreach ($collection as $item) {
            $temp = [];
            foreach ($select as $value) {
                $temp[$value] = $item->$value;
            }
            $response[] = $temp;
        }
        return response()->json($response);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function gender () {
        return $this->belongsTo(DataParent::class, 'gender_id', 'id')->where('type', 'gender');
    }

    public function address()
    {
        return $this->belongsTo(Address_linkable::class);
    }

    public function scopeFilterTrashed($q)
    {
        $q->when(auth()->user()->isWebDev, function ($q) {
            return $q->withTrashed();
        });
    }

    static function getNextIndex($where_clause = [])
    {
        return (parent::select('index')->where($where_clause)->orderBy('index', 'desc')->first()->index ?? 0) + 1;
    }

    static function saveOrder($request)
    {
        if (is_array($request->ids) && count($request->ids) > 0) {
            $rows = parent::where('status', 1)->whereIn('id', $request->ids)->orderBy('index', 'asc')->get();
            foreach ($request->ids as $index => $id) {
                $rows->where('id', $id)->first()->update(['index' => ++$index]);
            }
        }
    }
}
