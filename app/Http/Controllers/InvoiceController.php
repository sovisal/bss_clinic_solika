<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Echography;
use App\Models\Laboratory;
use App\Models\Xray;
use App\Models\Ecg;

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
        $invoice = Invoice::with(['patient', 'gender', 'doctor', 'detail'])
            ->where('invoices.id', $id)
            ->with('detail')
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
            'patient' => Patient::orderBy('name_en', 'asc')->get(),
            'doctor' => Doctor::orderBy('id', 'asc')->get(),
            'payment_type' => getParentDataSelection('payment_type'),
            'gender' => getParentDataSelection('gender'),
            'invoice_detail_service' => $invoice->detail()->where('service_type', 'service')->get(),
            'is_edit' => true
        ];

        // Invoice item selection
        $selection = [
            'medicine' => [],
            'service' => Service::where('status', '>=', '1')->orderBy('name', 'asc')->get(),
            'echography' => Echography::with(['type'])->where('patient_id', $invoice->patient_id)->where('payment_status', 0)->where('status', 1)->get(),
            'labor' => Laboratory::where('patient_id', $invoice->patient_id)->where('payment_status', 0)->where('status', 1)->get(),
            'xray' => Xray::with(['type'])->where('patient_id', $invoice->patient_id)->where('payment_status', 0)->where('status', 1)->get(),
            'ecg' => Ecg::with(['type'])->where('patient_id', $invoice->patient_id)->where('payment_status', 0)->where('status', 1)->get(),
        ];

        // Invoice item selected
        $count_check = $invoice->detail()->count();
        $data['invoice_selection'] = [];
        foreach ($selection as $type => $items) {
            $items_selected = $invoice->detail()->where('service_type', $type)->get()->keyBy('service_id');
            $item_selection = [];
            foreach ($items as $item) {
                if ($items_selected && isset($items_selected[$item['id']])) {
                    $item['chk'] = 1;
                    $item['qty'] = $items_selected[$item['id']]->qty;
                    $item['price'] = $items_selected[$item['id']]->price;
                    $item['total'] = $items_selected[$item['id']]->total;
                    $item['description'] = $items_selected[$item['id']]->description;
                }

                if ($count_check == 0) {
                    $item['chk'] = 1;
                }

                $item_selection[] = $item;
            }
            $data['invoice_selection'][$type] = $item_selection;
        }

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
            // Invoice items For Para-Clinic + Service + Medicine
            $items = array_merge($request->echography ?: [], $request->ecg ?: [], $request->xray ?: [], $request->labor ?: []);
            $items = array_filter($items, function ($item) {
                return isset($item['chk']);
            });
            $items = array_map(function ($item) {
                $item['exchange_rate'] = d_exchange_rate();
                $item['total'] = ($item['qty'] ?: 0) * ($item['price'] ?: 0);
                return $item;
            }, $items);

            $invoice->detail()->delete();
            
            // Para-Clinic
            $invoice->detail()->createMany($items);
 
            // Service + Medicine
            $services = [];
            foreach ($request->service_id ?: [] as $index => $id) {
                $services[] = [
                    'service_type'  => $request->service_type[$index] ?: '',
                    'service_name'  => $request->service_name[$index] ?: '',
                    'service_id'    => $request->service_id[$index] ?: 0,
                    'qty'           => $request->qty[$index] ?: 0,
                    'price'         => $request->price[$index] ?: 0,
                    'total'         => ($request->qty[$index] ?: 0) * ($request->price[$index] ?: 0),
                    'exchange_rate' => d_exchange_rate(),
                    'description'   => $request->description[$index] ?: '',
                ];
            }
            if (sizeof($services) > 0) {
                $invoice->detail()->createMany($services);
            }

            $invoice->total = $invoice->detail()->sum('total');
            $invoice->save();


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
        if ($invoice->delete()) {
            return redirect()->route('invoice.index')->with('success', 'Data delete success');
        }
    }
}
