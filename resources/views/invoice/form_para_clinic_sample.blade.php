@php
$service_id = $item->id;
$service_type = strtolower(class_basename($item));
$control_name = $service_type . '[' . $service_id . ']';

$service_name = $item->code;
$service_label = d_link($item->code, "javascript:getDetail(" . $service_id . ", '" . route($item->route . '.getDetail', 'Detail') . "')");
if (d_obj($item, 'type', ['name_en', 'name_kh']) != '-') {
    $service_name .= ' / ' . d_obj($item, 'type', ['name_en', 'name_kh']);
    $service_label .= ' / ' . $item->typeLink;
}
@endphp

@php
$checked = old($control_name . '[chk]', $item->chk ?: 0);
$value_qty = old($control_name . '[qty]', $item->qty ?: 1);
$value_price = old($control_name . '[price]', $item->price ?: 0);
$value_total = $value_qty * $value_price;
$value_description = old($control_name . '[description]', $item->description);
@endphp
<tr>
    <input type="hidden" name="{{ $control_name }}[service_id]" value="{{ $service_id }}">
    <input type="hidden" name="{{ $control_name }}[service_name]" value="{{ $service_name }}">
    <input type="hidden" name="{{ $control_name }}[service_type]" value="{{ $service_type }}">
    <input type="hidden" name="{{ $control_name }}[qty]" value="{{ $value_qty }}">
    <td>
        <input type="checkbox" name="{{ $control_name }}[chk]" {{ $checked ? 'checked' : '' }} value="1"/>
    </td>
    <td>{!! d_link(class_basename($item), route($item->route . '.index', ['back' => url()->current()])) !!}</td>
    <td>{!! d_text($service_label) !!}</td>
    <td>
        <x-bss-form.input type="number" name="{{ $control_name }}[qty]" disabled value="{{ $value_qty }}" required class="text-center"/>
    </td>
    <td>
        <x-bss-form.input type="number" name="{{ $control_name }}[price]" value="{{ $value_price }}" required class="text-center"/>
    </td>
    <td>
        <x-bss-form.input type="number" name="{{ $control_name }}[total]"  value="{{ $value_total }}"  required class="text-center"/>
    </td>
    <td>
        <x-bss-form.input type="text" name="{{ $control_name }}[description]" value="{{ $value_description }}"/>
    </td>
</tr>