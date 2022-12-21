@props([
    'path',
    'labelWidth' => '20%',
    'name' => 'image',
    'value' => null,
    'label' => __('form.image'),
    'tr' => true,
    'imageClass' => 'text-center',
])

@if ($tr)
<tr>
@endif
    <td width="{{ $labelWidth }}" class="text-right">
        <label for="file-browse-{{ $name }}">{!! $label . ($attributes['required']? ' <small class="required">*</small>' : '') !!}</label>
    </td>
    <td>
        <div style="width: 128px;">
            <x-bss-form.input-file-image :path="$path" :name="$name" :value="$value" {{ $attributes }} />
        </div>
    </td>
    
@if ($tr)
</tr>
@endif