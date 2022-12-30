<tr>
    <td>
        <input type="hidden" name="service_type[]" value="{{ @$item ? $item->service_type : 'service' }}">
        <input type="hidden" name="service_name[]" value="{{ @$item ? $item->service_name : '' }}">
        <x-bss-form.select name="service_id[]" class="medicine_selector" required :select2="false">
            <option value="">Please choose</option>
            @foreach ($invoice_selection['medicine'] as $data)
                <option value="{{ $data->id }}"
                    data-price="{{ $data->price }}"
                    {{ @$item && $item->service_id == $data->id ? 'selected' : '' }}
                >{{ d_obj($data, ['name_en', 'name_kh']) }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
    <td>
        <x-bss-form.select name="unit_id[]" id="" required :select2="false" >
            <option value="">---- None ----</option>
            @if (@$row && $row->product)
                <option value="{{ $row->product->unit_id }}" {{ $row->product->unit_id == @$row->unit_id ? 'selected' : '' }}>{{ d_obj($row->product, 'unit', ['name_kh', 'name_en']) }}</option>
                @foreach ($row->product->packages ?: [] as $package)
                    <option value="{{ $package->product_unit_id }}" {{ $package->product_unit_id == @$row->unit_id ? 'selected' : '' }}>{{ d_obj($package, 'unit', ['name_kh', 'name_en']) }}</option>
                @endforeach
            @endif
        </x-bss-form.select>
    </td>
    <td>
        <x-bss-form.input type="text" name='qty[]' value="{{ @$item ? $item->qty : 1 }}" required class="is_number text-center"/>
    </td>
    <td>
        <x-bss-form.input type="text" name='price[]' value="{{ @$item ? $item->price : 0 }}" required class="is_number text-center"/>
    </td>
    <td>
        <x-bss-form.input type="text" name='total[]' value="{{ @$item ? $item->total : 0 }}" required class="is_number text-center"/>
    </td>
    <td>
        <x-bss-form.input type="text" name='description[]' value="{{ @$item ? $item->description : '' }}"/>
    </td>
    <td>
        <x-form.button color="danger" class="btn-sm btn_delete_row" icon="bx bx-trash" />
    </td>
</tr>