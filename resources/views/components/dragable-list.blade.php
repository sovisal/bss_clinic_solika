@props([
	'data',
	'id' => 'widget-todo-list',
])

<ul {{ $attributes->merge(["class" => "widget-todo-list-wrapper tw-flex flex-column tw-gap-1"]) }} id="{{ $id }}">
	@if ( isset($data) )
		@foreach ($data as $key => $value)
			<x-dragable-item>
				{{ $value }}
			</x-dragable-item>
		@endforeach
	@else
		{!! $slot !!}
	@endif
</ul>