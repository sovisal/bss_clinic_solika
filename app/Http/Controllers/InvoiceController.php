<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Doctor;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['rows'] = Invoice::with(['doctor', 'patient', 'gender', 'address', 'user'])
            ->filter()
            ->where('invoices.status', '>=', 1)
            ->orderBy('id', 'DESC')
            ->limit(5000)
            ->get();
        return view('invoice.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'code' => generate_code('INV', 'invoices', false),
            'service' => [],
            'patient' => Patient::orderBy('name_en', 'asc')->get(),
            'doctor' => Doctor::orderBy('id', 'asc')->get(),
            'payment_type' => getParentDataSelection('payment_type'),
            'gender' => getParentDataSelection('gender'),
            'is_edit' => false
        ];

        return view('invoice.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($inv = Invoice::create([
            'code' => generate_code('INV', 'invoices'),
            'inv_date' => $request->inv_date ?: date('Y-m-d H:i:s'),
            'patient_id' => $request->patient_id ?: null,
            'age' => $request->age ?: '0',
            'age_type' => 1, // Will link with data-patent to get age type and disply dropdown at form
            'gender_id' => $request->gender_id ?: null,
            'doctor_id' => $request->doctor_id ?: Auth()->user()->doctor_id ?: null,
            'remark' => $request->remark ?: '',
            'payment_type' => $request->payment_type ?: null,
            'exchange_rate' => d_exchange_rate(),
            'total' => array_sum($request->total ?: []),
        ])) {
            $inv->update(['address_id' => update4LevelAddress($request)]);
            // $this->refresh_invoice_detail($request, $inv->id, true);
            return redirect()->route('invoice.edit', $inv->id)->with('success', 'Data created success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    public function print($id)
    {
        $invoice = Invoice::select([
            'invoices.*',
            'invoices.pt_age as patient_age',
            'genders.title_en as patient_gender',
            'patients.name_en as patient_en', 'patients.name_kh as patient_kh',
            'doctors.name_en as doctor_en', 'doctors.name_kh as doctor_kh',
        ])
            ->where('invoices.id', $id)
            ->with('detail')
            ->leftJoin('patients', 'patients.id', '=', 'invoices.patient_id')
            ->leftJoin('data_parents AS genders', 'genders.id', '=', 'patients.gender')
            ->leftJoin('doctors', 'doctors.id', '=', 'invoices.doctor_id')
            ->first();
        if ($invoice) {
            $data['row'] = $invoice;
            return view('invoice.print', $data);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $data = [
            'row' => $invoice,
            'code' => generate_code('INV', 'invoices', false),
            'inv_number' => "PT-" . str_pad($invoice->id, 4, '0', STR_PAD_LEFT),
            'service' => [],
            'patient' => Patient::orderBy('name_en', 'asc')->get(),
            'doctor' => Doctor::orderBy('id', 'asc')->get(),
            'payment_type' => getParentDataSelection('payment_type'),
            'gender' => getParentDataSelection('gender'),
            'invoice_detail' => $invoice->detail()->get(),
            'is_edit' => true
        ];

        // $data['service'] = [
            // 'echo' => ''
        // ];

        return view('invoice.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoiceRequest  $request
     * @param  \App\Models\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        if ($invoice->update([
            'inv_date' => $request->inv_date ?: $invoice->inv_date,
            'doctor_id' => $request->doctor_id ?: $invoice->doctor_id,
            'patient_id' => $request->patient_id ?: $invoice->patient_id,
            'gender_id' => $request->gender_id ?: $invoice->gender_id,
            'age' => $request->age ?: $invoice->age,
            'address_id' => update4LevelAddress($request, $invoice->address_id),
            'exchange_rate' => $request->exchange_rate ?: $invoice->exchange_rate,
            'payment_type' => $request->payment_type ?: $invoice->payment_type,
            'remark' => $request->remark ?: $invoice->remark,
            'total' => array_sum($request->total ?: []),
        ])) {
            $this->refresh_invoice_detail($request, $invoice->id);
            return redirect()->route('invoice.index')->with('success', 'Data update success');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->status = 0;
        if ($invoice->update()) {
            return redirect()->route('invoice.index')->with('success', 'Data delete success');
        }
    }

    public function refresh_invoice_detail($request, $parent_id = 0, $is_new = false)
    {
        $ids = [];
        foreach ($request->inv_item_id ?: [] as $index => $id) {
            $item = [
                'invoice_id'     => $parent_id,
                'service_type'     => $request->service_type[$index] ?: '',
                'service_name'  => $request->service_name[$index] ?: '',
                'service_id'     => $request->service_id[$index] ?: 0,
                'qty'             => $request->qty[$index] ?: 0,
                'price'         => $request->price[$index] ?: 0,
                'description'   => $request->description[$index] ?: '',
                'total'         => $request->total[$index] ?: 0,
            ];

            if ($id !== '0') {
                $inv = InvoiceDetail::find($id)->update($item);
                $ids[] = $id;
            } else {
                $inv = InvoiceDetail::create($item);
                $ids[] = $inv->id;
            }
        }

        if ($is_new == false) {
            // Clean old data when clicked on icon trast/delete
            if (sizeof($ids) > 0) {
                $detailToDelete = InvoiceDetail::where('invoice_id', $parent_id)->whereNotIn('id', $ids);
                $detailToDelete->delete();
            }
        }
    }
}
