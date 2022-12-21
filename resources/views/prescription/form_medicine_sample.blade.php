<tr>
    <input type="hidden" name="test_id[]" />
    <td>
        <x-bss-form.select name="medicine_id[]" id="" required :select2="false">
            <option value="">Please choose</option>
            @foreach ($medicine as $data)
            <option value="{{ $data->id }}">{{ $data->name }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
    <td>
        <x-bss-form.input type="text" name='qty[]' value="0" class="text-center" />
    </td>
    <td>
        <x-bss-form.input type="number" name='upd[]' value="0" class="text-center" />
    </td>
    <td>
        <x-bss-form.input type="number" name='nod[]' value="0" class="text-center" />
    </td>
    <td>
        <x-bss-form.input type="number" name='total[]' value="0" class="text-center" readonly />
    </td>
    <td>
        <x-bss-form.input type="text" name='unit[]' value="" class="text-center" />
    </td>
    <td>
        <x-bss-form.select name="usage_id[]" id="" required data-no_search="true" :select2="false">
            <option value="">Please choose</option>
            @foreach ($usages as $id => $data)
            <option value="{{ $id }}" {{ ($data=='លេប' )? 'selected' : '' }}>{{ $data }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
    <td>
        @foreach ($time_usage as $id => $data)
        <label style="display: inline;">
            <!-- row_id + time_usage_id -->
            <input name="time_usage_{{ $id }}[]" type="checkbox">
            {{ $data }}
        </label><br>
        @endforeach
    </td>
    <td>
        <x-bss-form.textarea name="other[]" rows="3"></x-bss-form.textarea>
    </td>
    <td class="text-center">
        <x-form.button color="danger" class="btn-sm" icon="bx bx-trash" onclick="$(this).parents('tr').remove();" />
    </td>
</tr>