<tr>
    <td colspan="2" class="text-left tw-bg-gray-100">Product Type Information</td>
</tr>

<x-bss-form.input-row name="date" :value="old('date', @$row->date)" class="date-picker" hasIcon="right" icon="bx bx-calendar" required label="Date" />
<x-bss-form.input-row name="exp_date" :value="old('exp_date', @$row->exp_date)" class="date-picker" hasIcon="right" icon="bx bx-calendar" label="Expire Date" />
<x-bss-form.input-row name="reciept_no" :value="old('reciept_no', @$row->reciept_no)" required label="Reciept Number" />
<x-bss-form.input-row name="price" class="is_number" :value="old('price', @$row->price) ?? 0" label="Price" />
<x-bss-form.input-row name="qty" class="is_number" :value="old('qty', @$row->qty) ?? 0" label="QTY" />
    
<x-bss-form.select-row name="supplier_id" required label="Supplier">
    <option value="">Please choose</option>
    @foreach ($suppliers as $supplier)
    <option value="{{ $supplier->id }}" {{ old('supplier_id', @$row->supplier_id) == $supplier->id ? 'selected' : '' }}>{{ d_obj($supplier, ['name_en', 'name_kh']) }}</option>
    @endforeach
</x-bss-form.select-row>
<x-bss-form.select-row name="product_id" required label="Product">
    <option value="">Please choose</option>
    @foreach ($products as $product)
    <option value="{{ $product->id }}" {{ old('product_id', @$row->product_id) == $product->id ? 'selected' : '' }}>{{ d_obj($product, ['name_en', 'name_kh']) }}</option>
    @endforeach
</x-bss-form.select-row>
<x-bss-form.select-row name="unit_id" required label="Unit">
    <option value="">Please choose</option>
    @foreach ($units as $unit)
    <option value="{{ $unit->id }}" {{ old('unit_id', @$row->unit_id) == $unit->id ? 'selected' : '' }}>{{ d_obj($unit, ['name_en', 'name_kh']) }}</option>
    @endforeach
</x-bss-form.select-row>
