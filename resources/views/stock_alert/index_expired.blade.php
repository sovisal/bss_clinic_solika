<x-app-layout>
    <x-slot name="header">
        <x-form.button href="{{ route('inventory.stock_alert.index') }}" class="btn-danger" icon="bx bx-bell" label="Out of stock ({{ $_POST['nb_out_of_stock'] }})" />
        <x-form.button href="{{ route('inventory.stock_alert.index') }}?expired=1" class="btn-danger active" icon="bx bx-bell" label="Expired ({{ $_POST['nb_stock_expired'] }})" />
    </x-slot>
    <x-card :foot="false" :head="false">
        <x-table class="table-hover table-striped" id="datatables">
            <x-slot name="thead">
                <tr>
                    <th width="3%">No</th>
                    <th width="8%">Date</th>
                    <th width="10%">Code</th>
                    <th width="10%">Product</th>
                    <th width="10%">Supplier</th>
                    <th width="5%">Qty_In</th>
                    <th width="5%">Unit</th>
                    <th width="5%">Base_Qty</th>
                    <th width="5%">Unit</th>
                    <th width="5%">Used</th>
                    <th width="5%">Remain</th>
                    <th width="8%">Expire Date</th>
                    <th width="8%">Status</th>
                </tr>
            </x-slot>
            @foreach($rows as $i => $row)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ d_date($row->date, 'Y-m-d') }}</td>
                <td>{!! d_obj($row, 'product', 'code') !!}</td>
                <td>{!! d_obj($row, 'product', 'link') !!}</td>
                <td>{!! d_obj($row, 'supplier', 'link') !!}</td>
                <td>{{ d_number($row->qty) }}</td>
                <td>{!! d_obj($row, 'unit', 'link') !!}</td>
                <td>{{ d_number($row->qty_based) }}</td>
                <td>{!! d_obj($row, 'product', 'unit', 'link') !!}</td>
                <td>{{ d_number($row->qty_used) }}</td>
                <td>{{ d_number($row->qty_remain) }}</td>

                <td>{!! d_date($row->exp_date, 'Y-m-d') !!}</td>
                @if ($row->exp_date > date('Y-m-d')) 
                    <td>--</td>
                @else
                    <td>{!! d_status(false, 'Expired') !!}</td>
                @endif
            </tr>
            @endforeach
        </x-table>
    </x-card>
</x-app-layout>