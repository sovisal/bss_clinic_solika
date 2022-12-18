@props([
'name',
'data',
'type' => 'checkbox',
'checked' => '',
])

<x-ul-unstyled class="d-flex align-items-center form-control">
    @foreach ($data as $id => $text)
    <x-li-inline>
        @if ( $type == 'radio' )
        <x-form.radio name="{{ $name }}" value="{{ $id }}" id="{{ $name .'-'. $id }}" label="{{ $text }}" checked="{{ ($id == $checked) }}" />
        @else
        <x-form.checkbox name="{{ $name }}" value="{{ $id }}" id="{{ $name .'-'. $id }}" label="{{ $text }}"
            checked="{{ ($id == $checked) }}" />
        @endif
    </x-li-inline>
    @endforeach
</x-ul-unstyled>
<x-form.error name="{{ $name }}" />