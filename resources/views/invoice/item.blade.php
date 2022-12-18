@php
    $control_name = strtolower(class_basename($item)) . '[' . $item->id . ']';
    $service_name = d_link($item->code, "javascript:getDetail(" . $item->id . ", '" . route($item->route . '.getDetail', 'Detail') . "')");
    if (d_obj($item, 'type', ['name_en', 'name_kh']) != '-') {
        $service_name .= ' / ' . d_obj($item, 'type', ['name_en', 'name_kh']);
    }
@endphp
<tr>
    <td>
        <input type="checkbox" name="{{ $control_name }}[chk]" value="1"/>
    </td>
    <td>{!! d_link(class_basename($item), route($item->route . '.index', ['back' => url()->current()])) !!}</td>
    <td>{!! d_text($service_name) !!}</td>
    <td>
        <x-bss-form.input type="number" name="{{ $control_name }}[qty]" value="{{ old($control_name . '[qty]', 1) }}" required class="text-center"/>
    </td>
    <td>
        <x-bss-form.input type="number" name="{{ $control_name }}[price]" value="{{ old($control_name . '[price]', $item->price) }}" required class="text-center"/>
    </td>
    <td>
        <x-bss-form.input type="number" name="{{ $control_name }}[total]"  value="{{ old($control_name . '[total]', $item->price * old($control_name . '[qty]', 1)) }}"  required class="text-center"/>
    </td>
    <td>
        <x-bss-form.input type="number" name="{{ $control_name }}[description]" value="{{ old($control_name . '[description]') }}" class="text-center"/>
    </td>
    <td>
        <x-form.button color="danger" class="btn-sm" icon="bx bx-trash" onclick="$(this).parents('tr').remove();"/>
    </td>
</tr>