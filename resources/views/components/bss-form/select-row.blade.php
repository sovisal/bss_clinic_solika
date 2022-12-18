@props([
    'name',
    'label',
    'labelWidth' => '20%',
    'data'=> null,
    'id' => null,
    'selected' => null,
    'select2' => true,
    'placeHolder' => true,
    'error'=>'',
    'tr' => true,
])

@if ($tr)
<tr>
@endif
    <td width="{{ $labelWidth }}" class="text-right">
        <label for="{{ $id ?? $name }}">{!! $label . ($attributes['required']? ' <small class="required">*</small>' : '') !!}</label>
    </td>
    <td>
        <x-bss-form.select
            :name="$name"
            :data="$data"
            :id="$id"
            :selected="$selected"
            :select2="$select2"
            :place-holder="$placeHolder"
            :error="$error"
        >{!! $slot !!}</x-bss-form.select>
    </td>
@if ($tr)
</tr>
@endif