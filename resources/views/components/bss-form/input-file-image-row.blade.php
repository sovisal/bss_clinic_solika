@props([
    'path',
    'labelWidth' => '20%',
    'name' => 'image',
    'value' => null,
    'label' => __('form.image'),
    'tr' => true,
])

@if ($tr)
<tr>
@endif
    <td width="{{ $labelWidth }}" class="text-right">
        <label for="file-browse-{{ $name }}">{!! $label . ($attributes['required']? ' <small class="required">*</small>' : '') !!}</label>
    </td>
    <td class="text-center">
        <x-bss-form.input-file-image :path="$path" :name="$name" :value="$value" {{ $attributes }} />
    </td>
    
@if ($tr)
</tr>
@endif