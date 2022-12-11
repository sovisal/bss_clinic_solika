@props([
	'head' => true,
	'foot' => true,
	'headerClass' => '',
	'footerClass' => '',
	'bodyClass' => '',
])
<div {{ $attributes->merge(['class'=>"card shadow-sm mb-1"]) }}>
	@if ($head)
		<div class="card-header {{ $headerClass }}">
			{!! $header ?? '<h4 class="card-title">'. __('module.sub.'. subModule()) .'</h4>' !!}
            {!! $action ?? '' !!}
		</div>
	@endif
	<div class="card-content collapse show">
		<div class="card-body {{ $bodyClass }}">
			{{ $slot }}
		</div>
	</div>
	
	@if ($foot)
		<div class="card-footer text-right {{ $footerClass }}">
			{!! $footer ?? '' !!}
		</div>
	@endif
</div>