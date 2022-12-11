@props([
	'id',
	'module' => '',
	'isTrashed' => false,
	'disableShow' => false,
	'disableEdit' => false,
	'disableDelete' => false,
	'disableRestore' => false,
	'showBtnShow' => true,
	'showBtnEdit' => true,
	'showBtnDetele' => true,
	'showBtnRestore' => true,
])

{!! $slot !!}
@if($showBtnShow)
    @can('Show'. Str::ucfirst($module))
        <x-form.button
            class="btn-sm"
            href="{{ route($module .'.show', $id) }}"
            data-toggle="tooltip"
            data-placement="top"
            title="{{ __('button.crud.show') }}"
            icon="bx bx-detail"
            :disabled="$disableShow"
        />
    @endcan
@endif

@if($showBtnEdit)
    @can('Update'. Str::ucfirst($module))
        <x-form.button
            class="btn-sm"
            color="secondary"
            href="{{ route($module .'.edit', $id) }}"
            data-toggle="tooltip"
            data-placement="top"
            title="{{ __('button.crud.edit') }}"
            icon="bx bx-edit-alt"
            :disabled="$disableEdit"
        />
    @endcan
@endif

@if ($isTrashed)
    @if($showBtnRestore)
        @can('Restore'. Str::ucfirst($module))
            <x-form.button
                color="success"
                class="btn-sm"
                data-id="{{ $id }}"
                data-toggle="tooltip"
                data-placement="top"
                onclick="if(confirm('Do you really want to restore this record?')){$('#restore-form-{{ $id }}').submit()}"
                title="{{ __('button.crud.restore') }}"
                icon="bx bx-refresh"
				:disabled="$disableRestore"
            />
            <form class="d-inline" id="restore-form-{{ $id }}" action="{{ route($module .'.restore', $id) }}" method="POST">
                @csrf
                @method('PUT')
            </form>
        @endcan
    @endif
@else
    @if($showBtnDetele)
        @can('Delete'. Str::ucfirst($module))
            <x-form.button
                color="danger"
                class="confirmDelete btn-sm"
                data-id="{{ $id }}"
                data-toggle="tooltip"
                data-placement="top"
                title="{{ __('button.crud.delete') }}"
                icon="bx bx-trash"
				:disabled="$disableDelete"
            />
            <form class="sr-only" id="form-delete-{{ $id }}" action="{{ route($module .'.delete', $id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="sr-only" id="btn-{{ $id }}">Delete</button>
            </form>
        @endcan
    @endif
@endif