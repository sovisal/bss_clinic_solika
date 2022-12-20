<x-app-layout>
    <x-slot name="header">
        <x-form.button href="{{ route('invoice.service.create') }}" label="Create" icon="bx bx-plus" />
    </x-slot>
    <x-card :foot="false" :action-show="false">
        <x-slot name="header"></x-slot>
        <x-table class="table-hover table-striped" id="datatables" data-table="patients">
            <x-slot name="thead">
                <tr>
                    <th>N<sup>o</sup></th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </x-slot>
            @php
            $i = 0;
            @endphp
            @foreach($services as $row)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ d_text($row->name) }}</td>
                <td>{{ d_currency($row->price) }}</td>
                <td>{{ d_text($row->description) }}</td>
                <td>{{ d_obj($row, 'user', 'name') }}</td>
                <td>{!! d_status($row->status) !!}</td>
                <td>
                    @can('UpdateService')
                    <x-form.button color="secondary" class="btn-sm" href="{{ route('invoice.service.edit', $row->id) }}" icon="bx bx-edit-alt" />
                    @endcan
                    @can('DeleteService')
                    <x-form.button color="danger" class="confirmDelete btn-sm" data-id="{{ $row->id }}" icon="bx bx-trash" />
                    <form class="sr-only" id="form-delete-{{ $row->id }}" action="{{ route('invoice.service.delete', $row->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="sr-only" id="btn-{{ $row->id }}">Delete</button>
                    </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </x-table>
    </x-card>
    <x-modal-confirm-delete />
</x-app-layout>