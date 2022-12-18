@props([
    'name',
    'label',
    'labelWidth' => '20%',
    'data',
    'type' => 'checkbox',
    'checked' => '',
    'tr' => true,
])

@if ($tr)
<tr>
@endif
    <td width="{{ $labelWidth }}" class="text-right">
        <label for="{{ $name }}">{!! $label . ($attributes['required']? ' <small class="required">*</small>' : '') !!}</label>
    </td>
    <td>
        <x-bss-form.choices
            :name="$name"
            :data="$data"
            :type="$type"
            :checked="$checked"
            {{ $attributes }}
        />
    </td>
@if ($tr)
</tr>
@endif