<table class="sr-only">
    <tbody id="stock-adjustment-new-item">
        <tr class="stock-adjustment-item widget-todo-item">
            <td>
                <x-bss-form.input name="date[]" id="" labelWidth="10%" :tr="false" class="date-picker" value="{{ date('Y-m-d') }}" required hasIcon="right" icon="bx bx-calendar" label="Date" />
            </td>
            <td>
                <x-bss-form.select name="product_id[]" id="" labelWidth="10%" :tr="false" :select2="false" required label="Product">
                    <option value="">---- None ----</option>
                    @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ d_obj($product, ['name_en', 'name_kh']) }}</option>
                    @endforeach
                </x-bss-form.select>
            </td>
            <td>
                <x-bss-form.input name="qty[]" id="" labelWidth="10%" :tr="false" class="is_number" required label="QTY Remove" />
            </td>
            <td>
                <x-bss-form.textarea name="reason[]" rows="2" id="" labelWidth="10%" :tr="false" required label="Reason" />
            </td>
            <td>
                <x-form.button href="javascript:void(0)" color="danger" class="btn-remove-stock-adjustment" icon="bx bx-trash" onclick="$(this).closest('tr.stock-adjustment-item').remove();"/>
            </td>
        </tr>
    </tbody>
</table>