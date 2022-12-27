<div id="stock-in-new-item" class="sr-only">
    <table class="table-stock-in-item table-form striped">
        <tr>
            <th colspan="6" class="tw-bg-gray-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div><i class='bx bx-grid-vertical mr-25 font-medium-4 cursor-move'></i> Information</div>
                    <x-form.button href="javascript:void(0)" color="danger" class="btn-remove-stock-in" icon="bx bx-trash" onclick="$(this).closest('tr.stock-in-item').remove();" label="Remove"/>
                </div>
            </th>
        </tr>
        <tr>
            <x-bss-form.input-row name="date[]" id="" labelWidth="12%" :tr="false" class="date-picker" hasIcon="right" icon="bx bx-calendar" required label="Date" value="{{ date('Y-m-d') }}" />
            <x-bss-form.select-row name="supplier_id[]" id="" labelWidth="12%" :tr="false" :select2="false" required label="Supplier">
                <option value="">---- None ----</option>
                @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ d_obj($supplier, ['name_en', 'name_kh']) }}</option>
                @endforeach
            </x-bss-form.select-row>
            <x-bss-form.input-row name="qty[]" id="" labelWidth="12%" :tr="false" class="is_number qty" required label="QTY IN" />
        </tr>
        <tr>
            <x-bss-form.input-row name="exp_date[]" id="" labelWidth="12%" :tr="false" class="date-picker" hasIcon="right" icon="bx bx-calendar" label="Expire Date" />
            <x-bss-form.select-row name="product_id[]" id="" labelWidth="12%" :tr="false" :select2="false" required label="Product">
                <option value="">---- None ----</option>
            </x-bss-form.select-row>
            <x-bss-form.input-row name="price[]" id="" labelWidth="12%" :tr="false" class="is_number price" required label="Price" />
        </tr>
        <tr>
            <x-bss-form.input-row name="reciept_no[]" id="" labelWidth="12%" :tr="false" required label="Reciept Number" />
            <x-bss-form.select-row name="unit_id[]" id="" labelWidth="12%" :tr="false" class="unit_id" :select2="false" data-qty="0" label="Unit">
                <option value="">---- None ----</option>
            </x-bss-form.select-row>
            <x-bss-form.input-row name="total[]" id="" labelWidth="12%" :tr="false" class="is_number" value="0" readonly label="Total" />
        </tr>
        <x-bss-form.input type="hidden" name="qty_based[]" id="" value="0" />
    </table>
</div>