<x-app-layout>
    <x-slot name="header">
        @can(('Create'. ($module_ability ?? 'StockOut')))
        <x-form.button href="{{ route(($module ?? 'inventory.stock_out') . '.create') }}" icon="bx bx-plus" label="Create" />
        @endcan
        <x-stock-filter url="{{ route(($module ?? 'inventory.stock_out') . '.index') }}">
            @if (!isset($module))
                <div class="col-sm-3 col-md-2">
                    <x-form.select name="ft_type" label="{{ __('form.stock.type') }}">
                        <option value="">{{ __('form.all') }}</option>
                        @foreach ([
                            'StockOut' => 'Stock Out',
                            'StockAdjustment' => 'Stock Adjustment',
                            'Prescription' => 'Prescription',
                            'Invoice' => 'Invoice',
                        ] as $key => $name)
                            <option value="{{ $key }}" @selected($key == request()->ft_type)>{{ d_text($name) }}</option>
                        @endforeach
                    </x-form.select>
                </div>
            @endif
        </x-stock-filter>
    </x-slot>
    <x-card :foot="false" :head="false">
        <x-table class="table-hover table-striped" id="datatables">
            <x-slot name="thead">
                <tr>
                    <th width="3%">No</th>
                    <th width="8%">Date</th>
                    <th>Doc.no</th>
                    <th>Code</th>
                    <th>Product</th>
                    <th width="8%">QTY_Out</th>
                    <th width="10%">Unit</th>
                    <th width="8%">Price</th>
                    <th width="8%">Total</th>
                    <th width="8%">Base_QTY</th>
                    <th width="8%">Unit</th>
                    <th width="8%">Type</th>
                    <th width="8%">User</th>
                    <th width="8%">Action</th>
                </tr>
            </x-slot>
            @foreach($rows as $i => $row)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ d_date($row->date, 'Y-m-d') }}</td>
                <td>{{ d_text($row->document_no) }}</td>
                <td>{!! d_obj($row, 'product', 'code') !!}</td>
                <td>{!! d_obj($row, 'product', 'link') !!}</td>
                <td>{!! d_number($row->qty) !!}</td>
                <td>{!! d_obj($row, 'unit', 'link') !!}</td>
                <td>{!! d_currency($row->price) !!}</td>
                <td>{!! d_currency($row->total) !!}</td>
                <td>{!! d_number($row->qty_based) !!}</td>
                <td>{!! d_obj($row, 'product', 'unit', 'link') !!}</td>
                <td>{!! d_text($row->type) !!}</td>
                <td>{!! d_obj($row, 'user', 'name') !!}</td>
                <td>
                    <x-table-action-btn
                        module="{{ $module ?? 'inventory.stock_out' }}"
                        module-ability="{{ $module_ability ?? 'StockOut' }}"
                        :id="$row->id"
                        :is-trashed="$row->trashed()"
                        :disable-edit="$row->trashed()"
                        :show-btn-show="false"
                        :show-btn-restore="false"
                    />
                </td>
            </tr>
            @endforeach
        </x-table>
    </x-card>
    <x-modal-confirm-delete />
</x-app-layout>