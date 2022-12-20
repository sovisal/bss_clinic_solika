@props([
'row' => null,
'type' => [],
'patient' => [],
'doctor' => [],
'paymentType' => [],
'gender' => [],
'isEdit' => false,
'isInvoice' => false,
'isLabor' => false,
])
<tr>
    @if ($isInvoice)
        <td width="15%" class="text-right"><label>Invoice Date<small class='required'>*</small></label></td>
        <td>
            <x-bss-form.input name='inv_date' value="{{ date('Y-m-d H:i:s') }}" required :disabled="$isEdit && $row->inv_date" />
        </td>
    @elseif($isLabor)
        <td width="15%" class="text-right"></td>
        <td>
            
        </td>
    @else
        <td width="15%" class="text-right"><label>Form<small class='required'>*</small></label></td>
        <td>
            <x-bss-form.select name="type_id" :disabled="$isEdit && $row->type_id" required>
                <option value="">Please choose</option>
                @foreach ($type as $data)
                <option value="{{ $data->id }}" data-price="{{ $data->price }}" {{ old('type', @$row->type_id) == $data->id ? 'selected' : '' }}>{{ d_obj($data, ['name_en', 'name_kh']) }}</option>
                @endforeach
            </x-bss-form.select>
        </td>
    @endif

    <td class="text-right"><label>Payment type<small class='required'>*</small></label></td>
    <td>
        <x-bss-form.select name="payment_type" data-no_search="true" required>
            @foreach ($paymentType as $id => $data)
            <option value="{{ $id }}" {{ old('payment_type', @$row->payment_type) == $id ? 'selected' : '' }}>{{ $data }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
</tr>
<tr>
    <td class="text-right"><label>Patient name<small class='required'>*</small></label></td>
    <td>
        <x-bss-form.select name="patient_id" required>
            <option value="">Please choose patient</option>
            @foreach ($patient as $data)
            <option value="{{ $data->id }}" {{ old('patient_id', @$row->patient_id) == $data->id ? 'selected' : '' }}>{{ d_obj($data, ['name_en', 'name_kh']) }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
    <td class="text-right"><label>Gender</label></td>
    <td>
        <x-bss-form.select name="gender_id" data-no_search="true">
            <option value="">Please choose gender</option>
            @foreach ($gender as $id => $data)
            <option value="{{ $id }}" {{ (old('gender_id', @$row->gender_id) == $id) ? 'selected' : '' }}>{{ $data }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
</tr>
@if ($isInvoice)
    <tr>
        <td class="text-right">Age</td>
        <td>
            <x-bss-form.input name='age' value="{{ $row->age ?? '' }}" />
        </td>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td class="text-right">Doctor <small class='required'>*</small></td>
        <td>
            <x-bss-form.select name="doctor_id">
                @foreach ($doctor as $data)
                <option value="{{ $data->id }}" {{ ($row->doctor_id ?? auth()->user()->doctor_id ?? false) == $data->id ? 'selected' : '' }}>{{ d_obj($data, ['name_en', 'name_kh']) }}</option>
                @endforeach
            </x-bss-form.select>
        </td>
        <td class="text-right"><label>Remark</label></td>
        <td>
            <x-bss-form.input name='remark' value="{{ old('remark', @$row->remark) }}" />
        </td>
    </tr>
@else
    <tr>
        <td class="text-right"><label>Requested by<small class='required'>*</small></label></td>
        <td>
            <x-bss-form.select name="requested_by" required :disabled="$isEdit && $row->requested_by">
                @foreach ($doctor as $data)
                <option value="{{ $data->id }}" {{ ($row->requested_by ?? auth()->user()->doctor_id ?? false) == $data->id ? 'selected' : '' }}>{{ d_obj($data, ['name_en', 'name_kh']) }}</option>
                @endforeach
            </x-bss-form.select>
        </td>
        <td class="text-right"><label>Age</label></td>
        <td>
            <x-bss-form.input name='age' value="{{ $row->age ?? '' }}" />
        </td>
    </tr>
    <tr>
        <td class="text-right"><label>Requested date </label><small class='required'>*</small></td>
        <td>
            <x-bss-form.input name='requested_at' class="date-time-picker" hasIcon="right" icon="bx bx-calendar" value="{{ $row->requested_at ?? date('Y-m-d H:i:s') }}" :disabled="$isEdit && $row->requested_at" />
        </td>
        <td class="text-right"><label>Physician</label></td>
        <td>
            <x-bss-form.select name="doctor_id">
                @foreach ($doctor as $data)
                <option value="{{ $data->id }}" {{ ($row->doctor_id ?? auth()->user()->doctor_id ?? false) == $data->id ? 'selected' : '' }}>{{ d_obj($data, ['name_en', 'name_kh']) }}</option>
                @endforeach
            </x-bss-form.select>
        </td>
    </tr>
    <tr>
        <td class="text-right"><label>Price</label></td>
        <td colspan="3">
            <span id="price_label"> {{ $row->price ?? 0 }} </span> USD
            <input type="hidden" name="price" value="{{ $row->price ?? 0 }}" :disabled="$isEdit">
        </td>
    </tr>
@endif
{!! $slot !!}