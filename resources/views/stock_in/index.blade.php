<x-app-layout>
    <x-slot name="header">
        <x-form.button href="{{ route('inventory.stock_in.create') }}" icon="bx bx-plus" label="Create" />
    </x-slot>
    <x-card :foot="false" :head="false">
        <x-table class="table-hover table-striped" id="datatables">
            <x-slot name="thead">
                <tr>
                    <th width="3%">No</th>
                    <th width="8%">Date</th>
                    <th width="10%">Product</th>
                    <th width="10%">Supplier</th>
                    <th width="5%">Qty In</th>
                    <th width="8%">Price</th>
                    <th width="8%">Total</th>
                    <th width="5%">Base Qty</th>
                    <th width="5%">Unit</th>
                    <th width="5%">Used</th>
                    <th width="5%">Remain</th>
                    <th width="8%">Expire Date</th>
                    <th>Reciept no</th>
                    <th width="8%">User</th>
                    <th width="5%">Status</th>
                    {{-- <th width="8%">Action</th> --}}
                </tr>
            </x-slot>
            @foreach($rows as $i => $row)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ d_date($row->date, 'Y-m-d') }}</td>
                <td>{!! $row->productLink !!}</td>
                <td>{!! $row->supplierLink !!}</td>
                <td>{!! d_number($row->qty) !!}</td>
                <td>{!! d_currency($row->price) !!}</td>
                <td>{!! d_number($row->total) !!}</td>
                <td>{!! d_number($row->qty_based) !!}</td>
                <td>{!! $row->ProductUnitLink !!}</td>
                <td>{!! d_number($row->qty_used) !!}</td>
                <td>{!! d_number($row->qty_remain) !!}</td>
                <td>{{ d_date($row->exp_date, 'Y-m-d') }}</td>
                <td>{{ $row->reciept_no }}</td>
                <td>{!! d_obj($row, 'user', 'name') !!}</td>
                <td>{!! d_status(d_number($row->qty_remain) <= 0, 'Stock Closed', 'Stock Active') !!}</td>
                {{-- <td>
                    <x-table-action-btn
                        module="inventory.stock_in"
                        module-ability="StockIn"
                        :id="$row->id"
                        :is-trashed="$row->trashed()"
                        :disable-edit="$row->trashed()"
                        :show-btn-show="false"
                    />
                </td> --}}
            </tr>
            @endforeach
        </x-table>
    </x-card>
    <x-modal-confirm-delete />
</x-app-layout>