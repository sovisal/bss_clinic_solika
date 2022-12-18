@props([
	'name',
	'label',
	'labelWidth' => '20%',
	'data',
	'id' => null,
	'selected' => null,
	'select2' => true,
	'placeHolder' => true,
	'error',
    'tr' => true,
])

@if ($tr)
<tr>
@endif
	<td width="{{ $labelWidth }}" class="text-right">
		<label for="{{ $id ?? $name }}">{!! $label . ($attributes['required']? ' <small class="required">*</small>' : '') !!}</label>
	</td>
	<td>
		{!! @$prependHtml !!}
		<div class="flex-grow-1">
			<select
				class="form-control {{ ( $error ?? $errors->first($name) ? ' is-invalid ': '') }} {{ (($select2)? 'custom-select2' : '') }} {{ $attributes['class'] }}"
				{{ $attributes->merge([
					'name' => $name,
					'id' => $id ?? $name,
					'value' => old($name),
				]) }}
			>
				@if (isset($data))
					@if ($placeHolder)
						<option value="">{{ __('form.please_select') }}</option>
					@endif
					@foreach ($data as $key => $value)
						@if (is_array($value))
							<optgroup label="{{ $key }}">
								@foreach ($value as $k => $v)
									@if (is_array($selected))
										<option value="{{ $k }}" {{ in_array($k, $selected) ? 'selected' : '' }}>{{ $v }}</option>
									@else
										<option value="{{ $k }}" {{ $k == $selected ? 'selected' : '' }}>{{ $v }}</option>
									@endif
								@endforeach
							</optgroup>
						@else
							@if (is_array($selected))
								<option value="{{ $key }}" {{ in_array($key, $selected) ? 'selected' : '' }}>{{ $value }}</option>
							@else
								<option value="{{ $key }}" {{ $key == $selected ? 'selected' : '' }}>{{ $value }}</option>
							@endif
						@endif
					@endforeach
				@else
					{{ $slot }}
				@endif
			</select>

			@if(isset($error) && $error !== '')
				<span class="invalid-feedback"><i class="bx bx-radio-circle"></i> {!! $error !!}</span>
			@else
				<x-form.error name="{{ $name }}"/>
			@endif
		</div>
		{!! @$appendHtml !!}
	</td>
@if ($tr)
</tr>
@endif