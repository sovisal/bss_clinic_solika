@props([
'name',
'label',
'labelWidth' => '20%',
'id' => null,
'class' => '',
])

<tr>
	<td width="{{ $labelWidth }}" class="text-right">
		<label for="{{ $id ?? $name }}">{!! $label . ($attributes['required']? ' <small class="required">*</small>' : '') !!}</label>
	</td>
	<td>
        <div class="custom-file">
            <input class="@error($name)is-invalid @enderror form-control custom-file-input {{ $class }}" type="file" name="{{ $name }}"
                id="{{ $id ?? $name }}" {{ $attributes(['value'=> old($name)]) }}
            />
            <label class="custom-file-label" for="{{ $name }}">Choose file</label>
            <x-form.error name="{{ $name }}" />
        </div>
	</td>
</tr>