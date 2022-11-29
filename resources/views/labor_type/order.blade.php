<x-app-layout>
	<x-slot name="header">
		<div class="d-flex justify-content-between align-items-bottom">
			<div>
				<x-form.button color="danger" href="{!! route('setting.labor-type.index', ['type' => request()->type, 'old' => request()->old]) !!}" label="Back" icon="bx bx-left-arrow-alt" />
			</div>
		</div>
	</x-slot><x-slot name="css">
		<style>
			
		</style>
	</x-slot>
	<x-slot name="js">
		<script src="{{ asset('js/dragula.min.js') }}"></script>
		<script>
			dragula([document.getElementById("widget-todo-list")], {
				moves: function (e, o, t) {
					return t.classList.contains("cursor-move");
				},
			});
			
		</script>
	</x-slot>


	<form action="{{ route('setting.labor-type.update_order', ['type' => request()->type, 'old' => request()->old]) }}" method="POST">
		@csrf
		<x-card :actionShow="false" class="widget-todo">
			<x-slot name="header">
				<h5>Sort Labor Type Order</h5>
				<x-form.button type="submit" icon="bx bx-save" label="Save" />
			</x-slot>
			<x-dragable-list>
				@foreach ($rows as $row)
					<x-dragable-item>
						<input type="hidden" name="ids[]" value="{{ $row->id }}" />
						<div>
							{{ $row->name_kh }}
						</div>
					</x-dragable-item>
				@endforeach
			</x-dragable-list>
			<x-slot name="footer">
				<x-form.button type="submit" icon="bx bx-save" label="Save" />
			</x-slot>
		</x-card>
	</form>
</x-app-layout>