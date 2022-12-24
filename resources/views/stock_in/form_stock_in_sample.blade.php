<div id="stock-in-new-item" class="sr-only">
    <table class="table-form striped mt-1">
        <tr>
            <th colspan="2" class="tw-bg-gray-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>Information</div>
                    <x-form.button href="javascript:void(0)" color="danger" class="btn-remove-stock-in" icon="bx bx-trash" onclick="$(this).closest('tr.stock-in-item').remove();" label="Remove"/>
                </div>
            </th>
        </tr>

        <x-bss-form.input-row name="date" :value="old('date', @$row->date)" class="date-picker" hasIcon="right" icon="bx bx-calendar" required label="Date" />
        <x-bss-form.input-row name="exp_date" :value="old('exp_date', @$row->exp_date)" class="date-picker" hasIcon="right" icon="bx bx-calendar" label="Expire Date" />
        <x-bss-form.input-row name="reciept_no" :value="old('reciept_no', @$row->reciept_no)" required label="Reciept Number" />
            
        <x-bss-form.select-row name="supplier_id" :select2="false" required label="Supplier">
            <option value="">Please choose</option>
            @foreach ($suppliers as $supplier)
            <option value="{{ $supplier->id }}" {{ old('supplier_id', @$row->supplier_id) == $supplier->id ? 'selected' : '' }}>{{ d_obj($supplier, ['name_en', 'name_kh']) }}</option>
            @endforeach
        </x-bss-form.select-row>
        <x-bss-form.select-row name="product_id" :select2="false" required label="Product">
            <option value="">Please choose</option>
        </x-bss-form.select-row>
        <x-bss-form.select-row name="unit_id" :select2="false" required label="Unit">
            <option value="">Please choose</option>
        </x-bss-form.select-row>
        <x-bss-form.input-row name="qty" class="is_number" :value="old('qty', @$row->qty) ?? 0" label="QTY" />
        <x-bss-form.input-row name="price" class="is_number" :value="old('price', @$row->price) ?? 0" label="Price" />
    </table>
</div>