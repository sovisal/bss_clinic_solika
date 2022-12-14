<x-app-layout>
    <x-slot name="header">
        <x-form.button color="danger" href="{{ route('setting.labor-type.index') }}" label="Back" icon="bx bx-left-arrow-alt" />
        <x-form.button href="{{ route('setting.labor-item.create', $laborType->id) }}" label="Create" icon="bx bx-plus" />
        <x-form.button color="dark" href="{!! route('setting.labor-item.sort_order', $laborType->id) !!}" label="Sort Order" icon="bx bx-sort-alt-2" />
    </x-slot>
    <x-card :foot="false" :head="false">
        <x-table class="table-hover table-striped" id="datatables" data-table="patients">
            <x-slot name="thead">
                <tr>
                    <th width="7%">No</th>
                    <th>Name</th>
                    <th width="10%">Range - Unit</th>
                    <th width="6%">Order</th>
                    <th width="15%">Labor Type</th>
                    <th width="10%">Item Type</th>
                    <th width="8%">Status</th>
                    <th width="10%">User</th>
                    <th width="10%">Action</th>
                </tr>
            </x-slot>
            @foreach($rows as $i => $row)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ d_obj($row, ['name_en', 'name_kh']) }}</td>
                <td>{!! d_labor_range($row->min_range, $row->max_range) .' '. apply_markdown_character($row->unit) !!}</td>
                <td>{!! d_number(Str::after($row->index, '.')) !!}</td>
                <td>{!! d_obj($row, 'type', ['name_en', 'name_kh']) !!}</td>
                <td>{!! d_text($row->other) !!}</td>
                <td>{!! d_status($row->status) !!}</td>
                <td>{!! d_obj($row, 'user', 'name') !!}</td>
                <td>
                    <x-form.button color="secondary" href="{{ route('setting.labor-item.edit', [$laborType->id, $row->id]) }}" icon="bx bx-edit-alt" />
                    @if ($row->trashed())
                        @can('RestoreLaborItem')
                            <x-form.button
                                color="success"
                                data-id="{{ $row->id }}"
                                data-toggle="tooltip"
                                data-placement="top"
                                onclick="if(confirm('Do you really want to restore this record?')){$('#restore-form-{{ $row->id }}').submit()}"
                                title="{{ __('button.crud.restore') }}"
                                icon="bx bx-refresh"
                            />
                            <form class="d-inline" id="restore-form-{{ $row->id }}" action="{{ route('setting.labor-item.restore', $row->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                            </form>
                        @endcan
                        @can('ForceDeleteLaborItem')
                            <x-form.button
                                color="danger"
                                class="confirmDelete"
                                data-id="{{ $row->id }}"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="{{ __('button.crud.force_delete') }}"
                                icon="bx bx-x"
                            />
                            <form class="sr-only" id="form-delete-{{ $row->id }}" action="{{ route('setting.labor-item.force_delete', $row->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="sr-only" id="btn-{{ $row->id }}">Delete</button>
                            </form>
                        @endcan
                    @else
                        @can('DeleteLaborItem')
                            <x-form.button
                                color="danger"
                                class="confirmDelete"
                                data-id="{{ $row->id }}"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="{{ __('button.crud.delete') }}"
                                icon="bx bx-trash"
                            />
                            <form class="sr-only" id="form-delete-{{ $row->id }}" action="{{ route('setting.labor-item.delete', [$laborType->id, $row->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="sr-only" id="btn-{{ $row->id }}">Delete</button>
                            </form>
                        @endcan
                    @endif
                </td>
            </tr>
            @endforeach
        </x-table>
    </x-card>
    {{--
    <pre>
		Syntax : 
			OUT_RANGE_COLOR_RED : when value out of range the color will red on the print labor-test
			VALUE_POSITIVE_NEGATIVE : when input the test result value can put POSITIVE and NEGATIVE
			NEGATIVE_COLOR_RED : when value equal to NEGATIVE will display color red on print labor-test
			VALUE_160_320 : when input the test result value can put 1/160 and 1/320
	</pre> --}}

    <x-modal-confirm-delete />

</x-app-layout>