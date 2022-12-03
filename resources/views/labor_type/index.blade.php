<x-app-layout>
	<x-slot name="header">
		<div class="d-flex justify-content-between align-items-bottom">
			<div>
				@if (request()->type)
					<x-form.button color="danger" href="{!! route('setting.labor-type.index', ['type' => request()->old]) !!}" label="Back" icon="bx bx-left-arrow-alt" />
				@endif
				<x-form.button color="dark" href="{!! route('setting.labor-type.sort_order', request()->only(['type', 'old'])) !!}" label="Sort Type" icon="bx bx-sort-alt-2" />
				<x-form.button color="dark" href="{!! route('setting.labor-item.sort_order', request()->only(['type', 'old'])) !!}" label="Sort Item" icon="bx bx-sort-alt-2" />
			</div>

			<ul class="d-flex align-items-center tw-gap-2.5 mb-0">
				@foreach ($LaborLevel as $level)
				@if ($level)
				<li class="d-flex align-items-center">
					<i class="bx bxs-right-arrow tw-mr-0.5 tw-text-xs"></i>
					{{ $level->name_en }}
				</li>
				@endif
				@endforeach
			</ul>
		</div>
	</x-slot>
	<x-slot name="js">
		<script>
			$("#datatables-labor-type").DataTable({
				"columnDefs": [{
					"targets": 'no-sort',
					"orderable": false,
				}],
			});
			$("#datatables-labor-item").DataTable({
				"columnDefs": [{
					"targets": 'no-sort',
					"orderable": false,
				}],
			});
		</script>
	</x-slot>
	
	@if (!request()->old) 
		<x-card :foot="false" :actionShow="false">
			<x-slot name="header">
				<div>
					<x-form.button href="{!! route('setting.labor-type.create', ['type' => request()->type]) !!}" label="Create" icon="bx bx-plus" />
				</div>
				<h5>Labor Type</h5>
			</x-slot>
			<x-table class="table-hover table-striped" id="datatables-labor-type">
				<x-slot name="thead">
					<tr>
						<th width="8%">No</th>
						<th>Name</th>
						@if (request()->type)
						<th>Type</th>
						@endif
						<th>Index</th>
						<th width="15%">Action</th>
					</tr>
				</x-slot>
				@php
					$i=0;
				@endphp
				@foreach($rows as $row)
				<tr>
					<td class="text-center">{{ ++$i }}</td>
					<td>{{ $row->name_en }}</td>
					@if (request()->type)
					<th>{{ $row->type_name }}</th>
					@endif
					<td class="text-center">{{ $row->index }}</td>
					<td class="text-center">
						<x-form.button class="btn-sm" href="{!! route('setting.labor-type.index', ['type' => $row->id, 'old' => request()->type]) !!}" icon="bx bx-detail" />
						<x-form.button color="secondary" class="btn-sm" href="{!! route('setting.labor-type.edit', ['laborType' => $row->id, 'type' => request()->type]) !!}" icon="bx bx-edit-alt" />
						<x-form.button color="danger" class="confirmDelete btn-sm" data-id="{{ $row->id }}" icon="bx bx-trash" :disabled="(count($row->items) > 0 || count($row->types))" />
						<form class="sr-only" id="form-delete-{{ $row->id }}" action="{!! route('setting.labor-type.delete', ['laborType' => $row->id, 'type' => request()->type]) !!}" method="POST">
							@csrf
							@method('DELETE')
							<button class="sr-only" id="btn-{{ $row->id }}">Delete</button>
						</form>
					</td>
				</tr>
				@endforeach
			</x-table>
		</x-card>
	@endif
	
	@if (request()->type) 
		<x-card :foot="false" :actionShow="false">
			<x-slot name="header">
				<div>
					<x-form.button href="{!! route('setting.labor-item.create', request()->only(['type', 'old'])) !!}" label="Create" icon="bx bx-plus" />
				</div>
				<h5>Labor Item</h5>
			</x-slot>
			<x-table class="table-hover table-striped" id="datatables-labor-item">
				<x-slot name="thead">
					<tr>
						<th>No</th>
						<th>Name</th>
						<th class="text-right">Min</th>
						<th>Max</th>
						<th>Unit</th>
						<th>Category</th>
						<th>Index</th>
						<th>Status</th>
						<th>Syntax</th>
						<th width="15%">Action</th>
					</tr>
				</x-slot>
				@foreach($item_rows as $j => $item_row)
				<tr>
					<td class="text-center">{{ ++$j }}</td>
					<td>{{ $item_row->name_en }}</td>
					<td class="text-right">{{ $item_row->min_range }}</td>
					<td>{{ $item_row->max_range }}</td>
					<td class="text-center">{!! apply_markdown_character($item_row->unit) !!}</td>
					<td>{{ $item_row->type_en }}</td>
					<td class="text-center">{{ $item_row->index }}</td>
					<td class="text-center">{{ $item_row->status }}</td>
					<td>{{ $item_row->other }}</td>
					<td class="text-center">
						<x-form.button color="secondary" class="btn-sm" href="{!! route('setting.labor-item.edit', ['laborItem' => $item_row->id, 'type' => request()->type, 'old' => request()->old]) !!}" icon="bx bx-edit-alt" />
						<x-form.button color="danger" class="confirmDelete btn-sm" data-id="{{ $item_row->id }}" icon="bx bx-trash" />
						<form class="sr-only" id="form-delete-{{ $item_row->id }}" action="{!! route('setting.labor-item.delete', ['laborItem' => $item_row->id, 'type' => request()->type, 'old' => request()->old]) !!}" method="POST">
							@csrf
							@method('DELETE')
							<button class="sr-only" id="btn-{{ $item_row->id }}">Delete</button>
						</form>
					</td>
				</tr>
				@endforeach
			</x-table>
		</x-card>
	@endif

	<x-modal-confirm-delete />
</x-app-layout>