<x-app-layout>
    <x-slot name="header">
        <x-form.button href="{{ route('inventory.product_unit.create') }}" icon="bx bx-plus" label="Create" />
    </x-slot>
    <x-card :foot="false" :head="false">
        <x-table class="table-hover table-striped" id="datatables">
            <x-slot name="thead">
                <tr>
                    <th width="8%">No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th width="13%">Total Product</th>
                    <th width="15%">User</th>
                    <th width="12%">Status</th>
                    <th width="15%">Action</th>
                </tr>
            </x-slot>
            @foreach($rows as $i => $row)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ d_obj($row, ['name_kh', 'name_en']) }}</td>
                <td>{!! $row->description !!}</td>
                <td><x-badge>{{ $row->products_count }}</x-badge></td>
                <td>{!! d_obj($row, 'user', 'name') !!}</td>
                <td>{!! d_status($row->status) !!}</td>
                <td>
                    <x-table-action-btn
                        module="inventory.product_unit"
                        module-ability="ProductUnit"
                        :id="$row->id"
                        :is-trashed="$row->trashed()"
                        :disable-edit="$row->trashed()"
                        :show-btn-show="false"
                    />
                </td>
            </tr>
            @endforeach
        </x-table>
    </x-card>
    <x-modal-confirm-delete />
</x-app-layout>