<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{!! route('setting.labor-type.index', request()->only(['type', 'old'])) !!}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{!! route('setting.labor-item.update', ['type' => request()->type, 'old' => request()->old, $row->id]) !!}" method="POST" autocomplete="off" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<x-card bodyClass="pb-0">
			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Edit Information</th>
				</tr>
				<tr>
					<td width="20%" class="text-right">Name <small class='required'>*</small></td>
					<td>
						<x-bss-form.input name="name" :value="old('name', $row->name_en)" required autofocus />
					</td>
				</tr>
				<tr>
					<td width="20%" class="text-right">Min Range <small class='required'>*</small></td>
					<td>
						<x-bss-form.input name="min_range" :value="old('min_range', $row->min_range)" required />
					</td>
				</tr>
				<tr>
					<td width="20%" class="text-right">Max Range <small class='required'>*</small></td>
					<td>
						<x-bss-form.input name="max_range" :value="old('max_range', $row->max_range)" required />
					</td>
				</tr>
				<tr>
					<td width="20%" class="text-right">Unit <small class='required'>*</small></td>
					<td>
						<x-bss-form.input name="unit" :value="old('unit', $row->unit)" required />
					</td>
				</tr>
				<tr>
					<td width="20%" class="text-right">Category <small class='required'>*</small></td>
					<td>
						<x-bss-form.select name="type" :select2="false" disabled>
							<option value="{{ $row->hasType->id }}">{{ $row->hasType->name_en }}</option>
						</x-bss-form.select>
					</td>
				</tr>
				<tr>
					<td width="20%" class="text-right">Index</td>
					<td>
						<x-bss-form.input name="index" :value="old('index', $row->index)" type="number" />
					</td>
				</tr>
				<tr>
					<td width="20%" class="text-right">Syntax</td>
					<td>
						<x-bss-form.select name="other" data-no_search="true">
							<option value="OUT_RANGE_COLOR_RED" {{ old('other', $row->other) == 'OUT_RANGE_COLOR_RED' ? 'selected' : ''}}>NORMAL</option>
							<option value="VALUE_POSITIVE_NEGATIVE" {{ old('other', $row->other) == 'VALUE_POSITIVE_NEGATIVE' ? 'selected' : ''}}>POSITIVE / NEGATIVE</option>
							<option value="VALUE_160_320" {{ old('other', $row->other) == 'VALUE_160_320' ? 'selected' : ''}}>160 / 320</option>
						</x-bss-form.select>
					</td>
				</tr>
			</table>
			<x-slot name="footer">
				<x-form.button type="submit" icon="bx bx-save" label="Save" />
			</x-slot>
		</x-card>
	</form>

</x-app-layout>