<?php

namespace App\Http\Requests;

use App\Models\Inventory\Product;
use App\Models\Inventory\ProductUnit;
use Illuminate\Foundation\Http\FormRequest;

class StockOutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    protected function getValidatorInstance()
    {
        return parent::getValidatorInstance()->after(function ($validator) {
            $stockOuts = collect();
            $allProducts = Product::with([
                'stockins' => function ($q) { $q->where('qty_remain', '>', 0)->orderBy('date'); }
            ])->whereIn('id', $this->input('product_id', []))->get();
            $allProductUnits = ProductUnit::select(['id','name_kh','name_en'])->whereIn('id', $this->input('unit_id', []))->get();

            foreach ($this->input('product_id', []) as $index => $value) {
                if ($product = $allProducts->where('id', $this->product_id[$index] ?? '')->first()) {
                    $error_msg = '';
                    if ($product->stockins->sum('qty_remain') < $this->qty_based[$index]) {
                        $error_msg = 'Insufficient stock on product: ' . d_obj($product, ['name_kh', 'name_en']) . '! total requested stock is ' . d_number($this->qty_based[$index]) . ' but total stock available is ' . d_number($product->stockins->sum('qty_remain'));
                        // If requested stock is larger then stock available add error for msg
                        $validator->errors()->add($index, 'Insufficient stock on product: ' . d_obj($product, ['name_kh', 'name_en']) . '! total requested stock is ' . d_number($this->qty_based[$index]) . ' but total stock available is ' . d_number($product->stockins->sum('qty_remain')));
                    }
                    $unit = $allProductUnits->where('id', $this->unit_id[$index])->first();
                    $stockOuts->push((object)[
                            'type' => 'StockOut',
                            'date' => $this->date[$index],
                            'document_no' => $this->reciept_no[$index],
                            'product_id' => $this->product_id[$index],
                            'unit_id' => $this->unit_id[$index],
                            'unit_option' => '<option value="'. $unit->id .'" selected>'. d_obj($unit, ['name_kh','name_en']) .'</option>',
                            'price' => $this->price[$index],
                            'qty_based' => $this->qty_based[$index],
                            'qty' => $this->qty[$index],
                            'note' => $this->note[$index],
                            'total' => $this->total[$index],
                            'error' => $error_msg,
                        ]);
                }
            }
            // flash old stockOuts to session and trigger validation error
            session()->flash('stockOuts', $stockOuts);
        });
    }
}
