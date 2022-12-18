<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-bottom">
            <div>
                <x-form.button href="{!! route('setting.labor-type.create', ['type' => request()->type]) !!}" label="Create" icon="bx bx-plus" />
                <x-form.button color="dark" href="{!! route('setting.labor-type.sort_order') !!}" label="Sort Order" icon="bx bx-sort-alt-2" />
            </div>
        </div>
    </x-slot>
    <x-slot name="js">
        <script>
            
        </script>
    </x-slot>

    @if (!request()->old)
    <x-card :foot="false" :head="false">
        <x-slot name="header">
            <h5>Labor Service</h5>
        </x-slot>
        <x-table class="table-hover table-striped" id="datatables">
            <x-slot name="thead">
                <tr>
                    <th width="8%">No</th>
                    <th>Name</th>
                    <th width="10%">Order</th>
                    <th width="15%">Parent</th>
                    <th width="12%">Status</th>
                    <th width="15%">User</th>
                    <th width="15%">Action</th>
                </tr>
            </x-slot>
            @php($i=0)
            @foreach($rows as $row)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ d_obj($row, ['name_en', 'name_kh']) }}</td>
                    <td>{{ d_number($row->index) }}</td>
                    <td>{!! d_obj($row, 'parent', ['name_en', 'name_kh']) !!}</td>
                    <td>{!! d_status($row->status) !!}</td>
                    <td>{!! d_obj($row, 'user', 'name') !!}</td>
                    <td>
                        <x-table-action-btn
                            module="setting.labor-type"
                            module-ability="LaborType"
                            :id="$row->id"
                            :is-trashed="$row->trashed()"
                            :disable-edit="$row->trashed()"
                            :show-btn-show="false"
                        >
                            <x-form.button href="{!! route('setting.labor-item.index', $row->id) !!}" icon="bx bx-detail" />
                        </x-table-action-btn>
                    </td>
                </tr>
            @endforeach
        </x-table>
    </x-card>
    @endif

    <x-modal-confirm-delete />
</x-app-layout>