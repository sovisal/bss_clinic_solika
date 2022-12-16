@props([
'row' => null,
'type' => null,
'patient' => null,
'doctor' => null,
'paymentType' => null,
'isEdit' => false,
'gender' => null
])
<tr>
    <td width="15%" class="text-right">Form <small class='required'>*</small></td>
    <td>
        <x-bss-form.select name="type_id" :disabled="$isEdit && $row->type_id" required>
            <option value="">Please choose</option>
            @foreach ($type as $data)
            <option value="{{ $data->id }}" data-price="{{ $data->price }}" {{ old('type', @$row->type_id) == $data->id ? 'selected' : '' }}>{{ d_obj($data, ['name_en', 'name_kh']) }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
    <td class="text-right">Payment type <small class='required'>*</small></td>
    <td>
        <x-bss-form.select name="payment_type" data-no_search="true" required>
            @foreach ($paymentType as $id => $data)
            <option value="{{ $id }}" {{ old('payment_type', @$row->payment_type) == $id ? 'selected' : '' }}>{{ $data }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
</tr>
<tr>
    <td class="text-right">Patient name <small class='required'>*</small></td>
    <td>
        <x-bss-form.select name="patient_id" required>
            <option value="">Please choose patient</option>
            @foreach ($patient as $data)
            <option value="{{ $data->id }}" {{ old('patient_id', @$row->patient_id) == $data->id ? 'selected' : '' }}>{{ d_obj($data, ['name_en', 'name_kh']) }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
    <td class="text-right">Gender</td>
    <td>
        <x-bss-form.select name="gender_id" data-no_search="true">
            <option value="">Please choose gender</option>
            @foreach ($gender as $id => $data)
            <option value="{{ $id }}" {{ (old('gender_id', @$row->gender_id) == $id) ? 'selected' : '' }}>{{ $data }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
</tr>
<tr>
    <td class="text-right">Age</td>
    <td>
        <x-bss-form.input name='age' value="{{ $row->age ?? '' }}" />
    </td>
    <td colspan="2"></td>
</tr>
<tr>
    <td class="text-right">Requested by <small class='required'>*</small></td>
    <td>
        <x-bss-form.select name="requested_by" required :disabled="$isEdit && $row->requested_by">
            @foreach ($doctor as $data)
            <option value="{{ $data->id }}" {{ ($row->requested_by ?? auth()->user()->doctor_id ?? false) == $data->id ? 'selected' : '' }}>{{ d_obj($data, ['name_en', 'name_kh']) }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
    <td class="text-right">Physician</td>
    <td>
        <x-bss-form.select name="doctor_id">
            @foreach ($doctor as $data)
            <option value="{{ $data->id }}" {{ ($row->doctor_id ?? auth()->user()->doctor_id ?? false) == $data->id ? 'selected' : '' }}>{{ d_obj($data, ['name_en', 'name_kh']) }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
</tr>
<tr>
    <td class="text-right">Requested date <small class='required'>*</small></td>
    <td>
        <x-bss-form.input name='requested_at' class="date-time-picker" hasIcon="right" icon="bx bx-calendar" value="{{ $row->requested_at ?? date('Y-m-d H:i:s') }}" :disabled="$isEdit && $row->requested_at" />
    </td>
    <td colspan="2"></td>
</tr>
<tr>
    <td class="text-right">Price</td>
    <td colspan="3">
        <span id="price_label"> {{ $row->price ?? 0 }} </span> USD
        <input type="hidden" name="price" value="{{ $row->price ?? 0 }}" :disabled="$isEdit">
    </td>
</tr>
{!! $slot !!}