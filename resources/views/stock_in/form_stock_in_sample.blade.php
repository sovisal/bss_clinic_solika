<div id="stock-in-new-item" class="sr-only">
    <table class="table-stock-in-item table-form striped">
        <tr>
            <th colspan="4" class="tw-bg-gray-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div><i class='bx bx-grid-vertical mr-25 font-medium-4 cursor-move'></i> Information</div>
                    <x-form.button href="javascript:void(0)" color="danger" class="btn-remove-stock-in" icon="bx bx-trash" onclick="$(this).closest('tr.stock-in-item').remove();" label="Remove"/>
                </div>
            </th>
        </tr>

        <tr>
            <x-bss-form.input-row name="date[]" id="" labelWidth="15%" :tr="false" :value="old('date', @$row->date)" class="date-picker" hasIcon="right" icon="bx bx-calendar" required label="Date" />
            <x-bss-form.select-row name="supplier_id[]" id="" labelWidth="15%" :tr="false" :select2="false" required label="Supplier">
                <option value="">---- None ----</option>
                @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ old('supplier_id', @$row->supplier_id) == $supplier->id ? 'selected' : '' }}>{{ d_obj($supplier, ['name_en', 'name_kh']) }}</option>
                @endforeach
            </x-bss-form.select-row>
        </tr>

        <tr>
            <x-bss-form.input-row name="exp_date[]" id="" labelWidth="15%" :tr="false" :value="old('exp_date', @$row->exp_date)" class="date-picker" hasIcon="right" icon="bx bx-calendar" label="Expire Date" />
            <x-bss-form.select-row name="product_id[]" id="" labelWidth="15%" :tr="false" :select2="false" required label="Product">
                <option value="">---- None ----</option>
            </x-bss-form.select-row>
        </tr>

        <tr>
            <x-bss-form.input-row name="reciept_no[]" id="" labelWidth="15%" :tr="false" :value="old('reciept_no', @$row->reciept_no)" required label="Reciept Number" />
            <x-bss-form.select-row name="unit_id[]" id="" labelWidth="15%" :tr="false" :select2="false" label="Unit">
                <option value="">---- None ----</option>
            </x-bss-form.select-row>
        </tr>
        <tr>
            <x-bss-form.input-row name="qty[]" id="" labelWidth="15%" :tr="false" class="is_number" :value="old('qty', @$row->qty)" required label="QTY" />
            <x-bss-form.input-row name="price[]" id="" labelWidth="15%" :tr="false" class="is_number" :value="old('price', @$row->price) ?? 0" required label="Price" />
        </tr>
    </table>
</div>