<x-app-layout>
    <x-slot name="header">
        <x-form.button href="{{ route('inventory.stock_alert.index') }}" class="btn-danger active" icon="bx bx-bell" label="Out of stock ({{ $_POST['nb_out_of_stock'] }})" />
        <x-form.button href="{{ route('inventory.stock_alert.index') }}?expired=1" class="btn-danger" icon="bx bx-bell" label="Expired ({{ $_POST['nb_stock_expired'] }})" />
    </x-slot>
    <x-card :foot="false" :head="false">
        <x-table class="table-hover table-striped" id="datatables">
            <x-slot name="thead">
                <tr>
                    <th width="4%">No</th>
                    <th width="8%">Code</th>
                    <th>Name</th>
                    <th width="10%">Base Unit</th>
                    <th width="10%">Type</th>
                    <th width="10%">Category</th>
                    <th width="8%">QTY Alert</th>
                    <th width="8%">QTY Remain</th>
                    <th width="8%">Status</th>
                </tr>
            </x-slot>
            @foreach($rows as $i => $row)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{!! $row->code !!}</td>
                    <td>{!! $row->link !!}</td>
                    <td>{!! d_obj($row, 'unit', 'link') !!}</td>
                    <td>{!! d_obj($row, 'type', 'link') !!}</td>
                    <td>{!! d_obj($row, 'category', 'link') !!}</td>
                    <td>{!! d_number($row->qty_alert) !!}</td>
                    <td><span style="color: {{ d_number($row->qty_remain) == 0 ? 'red' : 'green' }};">
                        {!! d_number($row->qty_remain) !!}
                    </span></td>

                    @if ($row->qty_remain == 0)
                        <td>{!! d_status(false, 'Out of Stock') !!}</td>
                    @elseif ($row->qty_remain > 0 && $row->qty_remain <= $row->qty_alert) 
                        <td>{!! d_status(false, 'Almost Out of Stock', '', 'badge-warning') !!}</td>
                    @else
                        <td>{!! d_status(true) !!}</td>
                    @endif
                </tr>
            @endforeach
        </x-table>
    </x-card>
</x-app-layout>