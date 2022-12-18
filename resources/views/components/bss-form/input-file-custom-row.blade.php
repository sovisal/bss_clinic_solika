@props([
    'name',
    'label',
    'labelWidth' => '20%',
    'id' => null,
    'tr' => true,
	'class' => '',
])

@if ($tr)
<tr>
@endif
    <td width="{{ $labelWidth }}" class="text-right">
        <label for="{{ $id ?? $name }}">{!! $label . ($attributes['required']? ' <small class="required">*</small>' : '') !!}</label>
    </td>
    <td>
        <x-bss-form.input-file-custom :name="$name" :id="$id" :class="$class" />
    </td>
@if ($tr)
</tr>
@endif