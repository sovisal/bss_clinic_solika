<x-app-layout>
    <x-slot name="header">
        @can('CreateXRayType')
        <x-form.button href="{{ route('setting.xray-type.create') }}" label="Create" icon="bx bx-plus" />
        @endcan
        <x-form.button color="dark" href="{!! route('setting.xray-type.sort_order') !!}" label="Sort Order" icon="bx bx-sort-alt-2" />
    </x-slot>
    <x-card :foot="false" :head="false">
        <x-table class="table-hover table-striped" id="datatables" data-table="patients">
            <x-slot name="thead">
                <tr>
                    <th width="8%">No</th>
                    <th>Name</th>
                    <th width="15%">Price</th>
                    <th width="10%">Order</th>
                    <th width="15%">User</th>
                    <th width="12%">Status</th>
                    <th width="15%">Action</th>
                </tr>
            </x-slot>
            @php($i=0)
            @foreach($rows as $row)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ d_obj($row, ['name_kh', 'name_en']) }}</td>
                <td>{{ d_currency($row->price) }}</td>
                <td>{{ d_number($row->index) }}</td>
                <td>{{ d_obj($row, 'user', 'name') }}</td>
                <td>{!! d_status($row->status) !!}</td>
                <td>
                    <x-table-action-btn
                        module="setting.xray-type"
                        module-ability="XRayType"
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