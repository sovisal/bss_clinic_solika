@props([
    'name',
    'label',
    'labelWidth' => '20%',
    'id' => null,
    'inputGroup' => false,
    'inputGroupType' => '',
    'append' => '',
    'prepend' => '',
    'hasIcon' => '',
    'icon' => '',
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
        <x-bss-form.input
            :name="$name"
            :id="$id"
            :input-group="$inputGroup"
            :input-group-type="$inputGroupType"
            :append="$append"
            :prepend="$prepend"
            :has-icon="$hasIcon"
            :icon="$icon"
            :error="$error"
            {{ $attributes }}
        />
    </td>
@if ($tr)
</tr>
@endif