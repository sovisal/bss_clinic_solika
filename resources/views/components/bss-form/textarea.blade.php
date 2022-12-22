@props([
    'name',
    'id' => null,
    'charLength' => '',
    'error',
])

<textarea
    {{ $attributes->merge([
        'class' => 'form-control ' . ( isset($error) ?? $errors->first($name) ? ' is-invalid ': ''),
        'name' => $name,
        'id' => $id ?? $name,
        'class' => ( ((isset($error) && $error != '') || $errors->first($name)) ? 'is-invalid ': '') . ' form-control',
    ]) }}
    {{ $charLength != '' ? 'data-length='. $charLength : '' }}
>{{ old($name, ($slot ?? '')) }}</textarea>
@if ($charLength != '')
    <small class="counter-value counter-value-{{ $name }} float-right"><span class="char-count">{{ strlen(old($name, ($slot ?? ''))) }}</span> / {{ $charLength }} </small>
@endif
@if(isset($error))
    <span class="invalid-feedback"><i class="bx bx-radio-circle"></i> {!! $error !!}</span>
@else
    <x-form.error name="{{ $name }}" />
@endif