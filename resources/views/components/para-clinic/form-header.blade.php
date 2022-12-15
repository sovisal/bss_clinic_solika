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
        <x-bss-form.select name="type" :disabled="$isEdit && $row->type" required>
            <option value="">Please choose</option>
            @foreach ($type as $data)
            <option value="{{ $data->id }}" data-price="{{ $data->price }}" {{ old('type', @$row->type) == $data->id ? 'selected' : '' }}>{{ d_obj($data, ['name_en', 'name_kh']) }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
    <td class="text-right">Payment type <small class='required'>*</small></td>
    <td>
        <x-bss-form.select name="payment_type" data-no_search="true" required :disabled="$isEdit && $row->payment_type">
            @foreach ($paymentType as $id => $data)
            <option value="{{ $id }}" {{ old('payment_type', @$row->payment_type) == $id ? 'selected' : '' }}>{{ $data }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
</tr>
<tr>
    <td class="text-right">Patient name <small class='required'>*</small></td>
    <td>
        <x-bss-form.select name="patient_id" required :disabled="$isEdit && $row->patient_id">
            <option value="">Please choose patient</option>
            @foreach ($patient as $data)
            <option value="{{ $data->id }}" {{ old('patient_id', @$row->patient_id) == $data->id ? 'selected' : '' }}>{{ d_obj($data, ['name_en', 'name_kh']) }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
    <td class="text-right">Requested date <small class='required'>*</small></td>
    <td>
        <x-bss-form.input name='requested_at' class="date-time-picker" hasIcon="right" icon="bx bx-calendar" value="{{ $row->requested_at ?? date('Y-m-d H:i:s') }}" :disabled="$isEdit && $row->requested_at" />
    </td>
</tr>
<tr>
    <td class="text-right">Gender</td>
    <td>
        <x-bss-form.select name="pt_gender" data-no_search="true" :disabled="$isEdit && $row->pt_gender">
            <option value="">Please choose gender</option>
            @foreach ($gender as $id => $data)
            <option value="{{ $id }}" {{ (old('pt_gender', @$row->pt_gender) == $id) ? 'selected' : '' }}>{{ $data }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
    <td class="text-right">Age</td>
    <td>
        <x-bss-form.input name='age' value="{{ $row->age ?? '' }}" :disabled="$isEdit && $row->age" />
    </td>
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
        <x-bss-form.select name="doctor_id" :disabled="$isEdit && $row->doctor_id">
            @foreach ($doctor as $data)
            <option value="{{ $data->id }}" {{ ($row->doctor_id ?? auth()->user()->doctor_id ?? false) == $data->id ? 'selected' : '' }}>{{ d_obj($data, ['name_en', 'name_kh']) }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
</tr>
<tr>
    <td class="text-right">Price</td>
    <td colspan="3">
        <span id="amount_label"> {{ $row->amount ?? 0 }} </span> USD
        <input type="hidden" name="amount" value="{{ $row->amount ?? 0 }}" :disabled="$isEdit">
    </td>
</tr>
{!! $slot !!}