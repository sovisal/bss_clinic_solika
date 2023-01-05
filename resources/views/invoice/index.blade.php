<x-app-layout>
    <x-slot name="header">
        @if(isset($_GET['back']))
        <x-form.button-back href="{!! route('setting.xray-type.index') !!}"/>
        @endif
        @can('CreateInvoice')
        <x-form.button href="{{ route('invoice.create') }}" label="Create" icon="bx bx-plus" />
        @endcan
        <x-report-filter url="{{ route('invoice.index') }}" />
    </x-slot>
    <x-card :foot="false" :action-show="false" :head="false">
        <x-table class="table-hover table-striped" id="datatables" data-table="patients">
            <x-slot name="thead">
                <tr>
                    <th>N<sup>o</sup></th>
                    <th>Code</th>
                    <th>Patient</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Date</th>
                    <th>Doctor</th>
                    <th>Exchange</th>
                    <th>Amount</th>
                    <th>Payment</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </x-slot>
            @php
            $i = 0;
            @endphp
            @foreach($rows as $row)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{!! d_link($row->code, "javascript:getDetail(" . $row->id . ", '" . route('invoice.getDetail', 'Invoice Detail') . "')") !!}</td>
                <td>{!! d_obj($row, 'patient', 'link') !!}</td>
                <td>{{ d_obj($row, 'gender', ['title_en', 'title_kh']) }}</td>
                <td>{{ d_text($row->age) }}</td>
                <td>{{ d_obj($row, 'address', ['village_kh', 'commune_kh', 'district_kh', 'province_kh']) }}</td>
                <td>{{ render_readable_date($row->inv_date) }}</td>
                <td>{!! d_obj($row, 'doctor', 'link') !!}</td>
                <td>{{ d_number($row->exchange_rate) }}</td>
                <td>
                    {{ d_currency($row->total, 2, '$') }}
                    {{-- {{ d_currency($row->total * $row->exchange_rate, 0, 'KHR') }} --}}
                </td>
                <td>{!! d_paid_status($row->payment_status) !!}</td>
                <td>{!! d_obj($row, 'user', 'name') !!}</td>
                <td>{!! d_para_status($row->status) !!}</td>
                <td>
                    <x-table-action-btn
                        module="invoice"
                        module-ability="Invoice"
                        :id="$row->id"
                        :is-trashed="$row->trashed()"
                        :disable-edit="$row->trashed() || !$row->status == 1"
                        :disable-delete="!$row->status == 1"
                        :show-btn-show="false"
                    >
                        @can('PrintInvoice')
                        <x-form.button color="dark" class="btn-sm" onclick="printPopup('{{ route('invoice.print', $row->id) }}')" icon="bx bx-printer" />
                        @endcan
                    </x-table-action-btn>
                </td>
            </tr>
            @endforeach
        </x-table>
    </x-card>

    <x-para-clinic.modal-detail />

    <x-modal-confirm-delete />
</x-app-layout>
