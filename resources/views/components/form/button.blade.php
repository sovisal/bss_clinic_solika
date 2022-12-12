@props([
    'label' => '',
    'icon' => '',
    'href' => '',
    'hideLabelOnXS' => false,
    'iconPosition' => 'left',
    'color' => 'primary',
])
@if ($href=='')
    <button {{ $attributes->merge([
        "type" => 'button',
        "class" => "btn btn-". $color ." ". (($label=='')? 'btn-icon' : '' ),
    ]) }}>
        @if ($hideLabelOnXS)
            <div class=" d-block d-sm-none">
                <i class="{!! $icon !!}"></i>
            </div>
            <span class="d-none d-sm-block">
        @endif
    
        @if ($iconPosition=='left')
            <i class="{!! $icon !!}"></i> 
        @endif
        {!! $label !!}
        @if ($iconPosition=='right')
            <i class="{!! $icon !!}"></i> 
        @endif

        @if ($hideLabelOnXS)
        </span>
        @endif
    </button>
@else
    <a {{ $attributes->merge([
        "href" => (($attributes['disabled'])? 'javascription:void(0)' : $href),
        "class" => "btn btn-". $color ." ". (($label=='')? 'btn-icon' : '' ) .  (($attributes['disabled'])? ' disabled' : '')
    ]) }}>
        @if ($hideLabelOnXS)
            <div class=" d-block d-sm-none">
                <i class="{!! $icon !!}"></i>
            </div>
            <span class="d-none d-sm-block">
        @endif

        @if ($iconPosition=='left')
            <i class="{!! $icon !!}"></i> 
        @endif
        {!! $label !!}
        @if ($iconPosition=='right')
            <i class="{!! $icon !!}"></i> 
        @endif

        @if ($hideLabelOnXS)
        </span>
        @endif
    </a>
@endif