<x-app-layout>
    <x-slot name="header">
        <x-form.button href="{{ route('para_clinic.ecg.create') }}" label="Create" icon="bx bx-plus"/>
        <x-report-filter url="{{ route('para_clinic.ecg.index') }}"/>
    </x-slot>
    <x-card :foot="false" :action-show="false" :head="false">
        <x-table class="table-hover table-striped" id="datatables" data-table="patients">
            <x-slot name="thead">
                <tr>
                    <th>No</th>
                    <th>Code</th>
                    <th>Form</th>
                    <th>Patient</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Requested Date</th>
                    <th>Physician</th>
                    <th>Price</th>
                    <th>Payment</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </x-slot>
            @foreach($rows as $i => $row)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{!! d_link($row->code, "javascript:getDetail(" . $row->id . ", '" . route('para_clinic.ecg.getDetail', 'ECG Detail') . "')") !!}</td>
                <td>{!! $row->ecgTypeLink !!}</td>
                <td>{!! $row->patientLink !!}</td>
                <td>{{ d_obj($row, 'gender', ['title_en', 'title_kh']) }}</td>
                <td>{{ d_obj($row, 'age') }}</td>
                <td>{{ d_obj($row, 'address', ['village_kh', 'commune_kh', 'district_kh', 'province_kh']) }}</td>
                <td>{{ render_readable_date($row->requested_at) }}</td>
                <td>{!! $row->doctorLink !!}</td>
                <td>{{ d_currency($row->price) }}</td>
                <td>{!! d_paid_status($row->payment_status) !!}</td>
                <td>{{ d_obj($row, 'user', 'name') }}</td>
                <td>{!! d_status($row->status) !!}</td>
                <td>
                    <x-table-action-btn
                        module="para_clinic.ecg"
                        module-ability="Ecg"
                        :id="$row->id"
                        :is-trashed="$row->trashed()"
                        :disable-edit="$row->trashed() || !($row->status=='1' && $row->payment_status == 0)"
                        :disable-delete="!($row->status=='1' && $row->payment_status == 0)"
                        :show-btn-show="false"
                        :show-btn-force-delete="true"
                    >
                        <x-form.button color="dark" class="btn-sm" onclick="printPopup('{{ route('para_clinic.ecg.print', $row->id) }}')" icon="bx bx-printer" />
                    </x-table-action-btn>
                </td>
            </tr>
            @endforeach
        </x-table>
    </x-card>

    <x-para-clinic.modal-detail />
    <x-modal-confirm-delete />
</x-app-layout>
