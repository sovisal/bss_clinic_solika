<tr>
    <input type="hidden" name="test_id[]" />
    <td>
        <x-bss-form.select name="medicine_id[]" id="" required :select2="false" :url="route('inventory.product.index')">
            <option value="">Please choose</option>
            @foreach ($medicine as $data)
            <option value="{{ $data->id }}" {{ $data->id == @$row->medicine_id ? 'selected' : '' }}>{{ d_obj($data, ['code', 'name_en', 'name_kh']) }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
    <td>
        <x-bss-form.input type="text" name='qty[]' value="{{ d_number(@$row->qty ?: 0) }}" class="text-center is_number" />
    </td>
    <td>
        <x-bss-form.input type="number" name='upd[]' value="{{ d_number(@$row->upd ?: 0) }}" class="text-center is_number" />
    </td>
    <td>
        <x-bss-form.input type="number" name='nod[]' value="{{ d_number(@$row->nod ?: 0) }}" class="text-center is_number" />
    </td>
    <td>
        <x-bss-form.input type="number" name='total[]' value="{{ d_number(@$row->total ?: 0) }}" class="text-center is_number" readonly />
    </td>
    <td>
        <x-bss-form.select name="unit_id[]" id="" required :select2="false" >
            @if (@$row && $row->product)
                <option value="{{ $row->product->unit_id }}" {{ $row->product->unit_id == @$row->unit_id ? 'selected' : '' }}>{{ d_obj($row->product, 'unit', ['name_kh', 'name_en']) }}</option>
                @foreach ($row->product->packages ?: [] as $package)
                    <option value="{{ $package->product_unit_id }}" {{ $package->product_unit_id == @$row->unit_id ? 'selected' : '' }}>{{ d_obj($package, 'unit', ['name_kh', 'name_en']) }}</option>
                @endforeach
            @endif
        </x-bss-form.select>
    </td>
    <td>
        <x-bss-form.select name="usage_id[]" id="" required data-no_search="true" :select2="false">
            <option value="">Please choose</option>
            @foreach ($usages as $id => $data)
            @php($default_select = ($data == "លេប" ? $id : '' ))
            <option value="{{ $id }}" {{ $id == ($row->usage_id ?? $default_select) ? 'selected' : '' }}>{{ $data }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
    <td>
        @foreach ($time_usage as $data)
        <label style="display: inline;">
            <!-- row_id + time_usage_id -->
            <input name="time_usage_{{ $data->id }}[]" type="checkbox" {{ in_array($data->id, explode(',', @$row->usage_times)) ? 'checked' : '' }}>
            {{ d_obj($data, ['title_en', 'title_kh']) }}
        </label><br>
        @endforeach
    </td>
    <td>
        <x-bss-form.textarea name="other[]" rows="3">{{ @$row->other ?: '' }}</x-bss-form.textarea>
    </td>
    <td class="text-center">
        <x-form.button color="danger" class="btn-sm" icon="bx bx-trash" onclick="$(this).parents('tr').remove();" />
    </td>
</tr>