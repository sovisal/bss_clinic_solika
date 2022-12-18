@props([
    'name',
    'label',
    'labelWidth' => '20%',
    'id' => null,
    'charLength' => '',
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
        <x-bss-form.textarea
            :name="$name"
            :id="$id"
            :char-length="$charLength"
            :error="$error"
            {{ $attributes }}
        >{!! $slot !!}</x-bss-form.textarea>
    </td>
@if ($tr)
</tr>
@endif