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
            <x-bss-form.input-row name="date[]" id="" labelWidth="15%" :tr="false" class="date-picker" required hasIcon="right" icon="bx bx-calendar" label="Date" />
            <x-bss-form.select-row name="product_id[]" id="" labelWidth="15%" :tr="false" :select2="false" required label="Product">
                <option value="">---- None ----</option>
                @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ d_obj($product, ['name_en', 'name_kh']) }}</option>
                @endforeach
            </x-bss-form.select-row>
        </tr>
        <tr>
            <x-bss-form.input-row name="reciept_no[]" id="" labelWidth="15%" :tr="false" required label="Reciept Number" />
            <x-bss-form.select-row name="unit_id[]" id="" labelWidth="15%" :tr="false" :select2="false" label="Unit">
                <option value="">---- None ----</option>
            </x-bss-form.select-row>
        </tr>
        <tr>
            <x-bss-form.input-row name="qty[]" id="" labelWidth="15%" :tr="false" class="is_number" required label="QTY" />
            <x-bss-form.input-row name="price[]" id="" labelWidth="15%" :tr="false" class="is_number" required label="Price" />
        </tr>
    </table>
</div>