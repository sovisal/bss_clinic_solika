<input type="hidden" name="is_treament_plan" value="0">
<table class="table-form table-padding-sm table-striped table-medicine">
    <thead>
        <tr>
            <th colspan="10" class="tw-bg-gray-100">
                <div class="d-flex justify-content-between align-items-center">
                    Result <small>Qty: Quantity , U/D: Usage per Day , NoD: Number of Day</small>
                    <div>
                        <x-form.button class="btn-add-medicine" icon="bx bx-plus" label="Add Medicine" />
                    </div>
                </div>
            </th>
        </tr>
        <tr class="text-center">
            <th width="15%">Medicine <small class="required">*</small></th>
            <th width="9%">Qty <small class="required">*</small></th>
            <th width="9%">U/D <small class="required">*</small></th>
            <th width="9%">NoD <small class="required">*</small></th>
            <th width="5%">Total</th>
            <th width="5%">Unit</th>
            <th width="15%">Usage</th>
            <th width="12%">Usage Time</th>
            <th>Note</th>
            <th width="8%">Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- JS dynamic -->
        @foreach ($prescription_detail as $row)
        @php
        static $i = 1;
        @endphp
        <tr>
            <input type="hidden" name="test_id[]" value="{{ $row->id }}" />
            {{-- <td class="text-center">{{ $i++ }}</td> --}}
            <td>
                <x-bss-form.select name="medicine_id[]" required id="medicine_{{ $row->id }}">

                    <option value="">Please choose</option>

                    @foreach ($medicine as $data)
                    <option value="{{ $data->id }}" {{ ($row->medicine_id ?? false) == $data->id ? 'selected' : '' }}>{{ $data->name }}</option>
                    @endforeach
                </x-bss-form.select>
            </td>
            <td>
                <x-bss-form.input type="text" name='qty[]' value="{{ $row->qty ?: 0 }}" class="text-center" />
            </td>
            <td>
                <x-bss-form.input type="number" name='upd[]' value="{{ $row->upd ?: 0 }}" class="text-center" />
            </td>
            <td>
                <x-bss-form.input type="number" name='nod[]' value="{{ $row->nod ?: 0 }}" class="text-center" />
            </td>
            <td>
                <x-bss-form.input type="number" name='total[]' value="{{ $row->total ?: 0 }}" class="text-center" readonly />
            </td>
            <td>
                <x-bss-form.input type="text" name='unit[]' value="{{ $row->unit ?: '' }}" class="text-center" />
            </td>
            <td>
                <x-bss-form.select name="usage_id[]" required data-no_search="true" :select2="false">
                    @if (!$is_edit)
                    <option value="">Please choose</option>
                    @endif
                    @foreach ($usages as $id => $data)
                    <option value="{{ $id }}" {{ ($row->usage_id ?? false) == $id ? 'selected' : '' }}>{{ $data }}</option>
                    @endforeach
                </x-bss-form.select>
            </td>
            <td>
                @foreach ($time_usage as $id => $data)
                <label style="display: inline;">
                    <!-- row_id + time_usage_id -->
                    <input name="time_usage_{{ $row->id }}_{{ $id }}[]" type="checkbox" {{ in_array($id, explode(',', $row->usage_times ?? [])) ? 'checked' : '' }}>
                    {{ $data }}
                </label><br>
                @endforeach
            </td>
            <td>
                <x-bss-form.textarea name="other[]" rows="3">
                    {{ $row->other }}
                </x-bss-form.textarea>
            </td>
            <td class="text-center">
                <x-form.button color="danger" class="btn-sm" icon="bx bx-trash" onclick="$(this).parents('tr').remove();" />
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
