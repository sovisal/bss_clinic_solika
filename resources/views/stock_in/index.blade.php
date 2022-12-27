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
                    <th width="5%">Unit</th>
                    <th width="8%">Price</th>
                    <th width="8%">Total</th>
                    <th width="5%">Base Qty</th>
                    <th width="5%">Unit</th>
                    <th width="5%">Used</th>
                    <th width="5%">Remain</th>
                    <th width="8%">Expire</th>
                    <th>Reciept no</th>
                    <th width="8%">User</th>
                    <th width="5%">Status</th>
                    <th width="8%">Action</th>
                </tr>
            </x-slot>
            @foreach($rows as $i => $row)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ d_date($row->date, 'Y-m-d') }}</td>
                <td>{!! $row->productLink !!}</td>
                <td>{!! $row->supplierLink !!}</td>
                <td>{{ d_number($row->qty) }}</td>
                <td>{!! $row->unitLink !!}</td>
                <td>{{ d_currency($row->price) }}</td>
                <td>{{ d_currency($row->total) }}</td>
                <td>{{ d_number($row->qty_based) }}</td>
                <td>{!! $row->productUnitLink !!}</td>
                <td>{{ d_number($row->qty_used) }}</td>
                <td>{{ d_number($row->qty_remain) }}</td>

                @if ($row->exp_date >= date('Y-m-d')) 
                    <td>{!! d_status(true, '', d_date($row->exp_date, 'Y-m-d'), '', 'badge-success') !!}</td>
                @else
                    <td>{!! d_status(false, d_date($row->exp_date, 'Y-m-d')) !!}</td>
                @endif
                
                <td>{{ $row->reciept_no }}</td>
                <td>{{ d_obj($row, 'user', 'name') }}</td>
                @if ($row->qty_remain > 0)
                    <td>{!! d_status(true, '', 'Stock Active') !!}</td>
                @else
                    <td>{!! d_status(false, 'Stock Closed', '', 'badge-light') !!}</td>
                @endif
                <td>
                    <x-table-action-btn
                        module="inventory.stock_in"
                        module-ability="StockIn"
                        :id="$row->id"
                        :is-trashed="$row->trashed()"
                        :disable-edit="$row->trashed()"
                        :disable-delete="$row->stock_outs_count > 0"
                        :show-btn-show="false"
                    />
                </td>
            </tr>
            @endforeach
        </x-table>
    </x-card>
    <x-modal-confirm-delete />
</x-app-layout>