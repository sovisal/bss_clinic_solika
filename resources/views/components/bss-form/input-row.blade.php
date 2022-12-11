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
	'error',
])

<tr>
	<td width="{{ $labelWidth }}" class="text-right">
		<label for="{{ $id ?? $name }}">{!! $label . ($attributes['required']? ' <small class="required">*</small>' : '') !!}</label>
	</td>
	<td>
		@if ($inputGroup)
			<div class="input-group">
				@if ($prepend != '')
					<div class="input-group-prepend">
						@if ($inputGroupType == 'button')
							{!! $prepend !!}
						@else
							<span class="input-group-text">
								{!! $prepend !!}
							</span>
						@endif
					</div>
				@endif
		@endif
		@if ($hasIcon!='' && $icon!='')
			<div class="position-relative has-icon-{{ $hasIcon }}">
		@endif
		<input
			{{ $attributes([
				'type' => 'text',
				'name' => $name,
				'id' => $id ?? $name,
				'class' => ( $error ?? $errors->first($name) ? 'is-invalid ': '') . ' form-control',
				'value' => old($name),
			]) }}
		/>
		@if ($hasIcon!='' && $icon!='')
				<div class="form-control-position">
					<i class="{{ $icon }}"></i>
				</div>
			</div>
		@endif
		@if ($inputGroup)
				@if ($append != '')
					<div class="input-group-append">
						@if ($inputGroupType == 'button')
							{!! $append !!}
						@else
							<span class="input-group-text">
								{!! $append !!}
							</span>
						@endif
					</div>
				@endif
			</div>
		@endif
		@if(isset($error) && $error !== '')
			<span class="invalid-feedback-custom"><i class="bx bx-radio-circle"></i> {!! $error !!}</span>
		@else
			<x-form.error name="{{ $name }}"/>
		@endif
	</td>
</tr>