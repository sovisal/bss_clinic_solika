<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{!! route('setting.labor-type.index', request()->only(['type', 'old'])) !!}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('setting.labor-type.update', ['laborType' => $row, 'type' => request()->type, 'old' => request()->old]) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<x-card bodyClass="pb-0">
			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Create New Information</th>
				</tr>
				<tr>
					<td width="20%" class="text-right">Name<small class='required'>*</small></td>
					<td>
						<x-bss-form.input name="name" value="{{ $row->name_en }}" required autofocus />
					</td>
				</tr>
			</table>
			<x-slot name="footer">
				<x-form.button type="submit" icon="bx bx-save" label="Save" />
			</x-slot>
		</x-card>
	</form>

</x-app-layout>