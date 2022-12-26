<x-app-layout>
    <x-slot name="header">
        <x-form.button href="{{ route('inventory.product.create') }}" icon="bx bx-plus" label="Create" />
    </x-slot>
    <x-card :foot="false" :head="false">
        <x-table class="table-hover table-striped" id="datatables">
            <x-slot name="thead">
                <tr>
                    <th width="4%">No</th>
                    <th width="8%">Code</th>
                    <th>Name</th>
                    <th width="8%">Cost</th>
                    <th width="8%">Price</th>
                    <th width="10%">Unit</th>
                    <th width="10%">Type</th>
                    <th width="10%">Category</th>
                    <th width="8%">Remain</th>
                    <th width="8%">User</th>
                    <th width="8%">Status</th>
                    <th width="6%">Action</th>
                </tr>
            </x-slot>
            @foreach($rows as $i => $row)
                @php
                    $is_remain = d_number($row->qty_remain) > 0;
                @endphp
                <tr {!! !$is_remain ? 'style="background-color: #ccc;" title="Product remain 0, please stockin to active."' : '' !!}>
                    <td>{{ ++$i }}</td>
                    <td>{!! $row->code !!}</td>
                    <td>{!! d_obj($row, ['name_kh', 'name_en']) !!}</td>
                    <td>{!! d_currency($row->cost) !!}</td>
                    <td>{!! d_currency($row->price) !!}</td>
                    <td>{!! $row->productUnitLink !!}</td>
                    <td>{!! $row->productTypeLink !!}</td>
                    <td>{!! $row->productCategoryLink !!}</td>
                    <td><span {!! !$is_remain ? 'style="color: red;"' : '' !!}>
                        {!! d_number($row->qty_remain) !!}
                    </span></td>
                    <td>{!! d_obj($row, 'user', 'name') !!}</td>
                    <td>{!! d_status($is_remain) !!}</td>
                    <td>
                        <x-table-action-btn
                            module="inventory.product"
                            module-ability="Product"
                            :id="$row->id"
                            :is-trashed="$row->trashed()"
                            :disable-edit="$row->trashed()"
                            :show-btn-show="false"
                            :show-btn-force-delete="true"
                        />
                    </td>
                </tr>
            @endforeach
        </x-table>
    </x-card>

    <x-modal-confirm-delete />
</x-app-layout>