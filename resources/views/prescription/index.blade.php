<x-app-layout>
    <x-slot name="header">
        <x-form.button href="{{ route('prescription.create') }}" label="Create" icon="bx bx-plus" />
        <x-report-filter url="{{ route('prescription.index') }}" />
    </x-slot>
    <x-card :foot="false" :action-show="false">
        <x-table class="table-hover table-striped" id="datatables" data-table="patients">
            <x-slot name="thead">
                <tr>
                    <th>NO</th>
                    <th>Code</th>
                    <th>Patient</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Requested Date</th>
                    <th>Physician</th>
                    {{-- <th>Diagnosis</th> --}}
                    <th>Price</th>
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
                <td>{!! d_link($row->code, "javascript:getDetail(" . $row->id . ", '" . route('prescription.getDetail', 'Priscription Detail') . "')") !!}</td>
                <td>{!! $row->patientLink !!}</td>
                <td>{{ d_obj($row, 'gender', ['title_en', 'title_kh']) }}</td>
                <td>{{ d_obj($row, 'age') }}</td>
                <td>{{ d_obj($row, 'address', ['village_kh', 'commune_kh', 'district_kh', 'province_kh']) }}</td>
                <td>{{ render_readable_date($row->requested_at) }}</td>
                <td>{!! $row->doctorLink !!}</td>
                <td>{{ d_currency($row->price) }}</td>
                <td>{!! d_paid_status($row->payment_status) !!}</td>
                <td>{{ d_obj($row, 'user', 'name') }}</td>
                <td>{!! d_para_status($row->status, 'Active', 'Complete') !!}</td>
                <td>
                    <x-form.button color="dark" class="btn-sm" onclick="printPopup('{{ route('prescription.print', $row->id) }}')" icon="bx bx-printer" />
                    @if ($row->status == 1)
                    <x-form.button color="secondary" class="btn-sm" href="{{ route('prescription.edit', $row->id) }}" icon="bx bx-edit-alt" />
                    <x-form.button color="danger" class="confirmDelete btn-sm" data-id="{{ $row->id }}" icon="bx bx-trash" />
                    <form class="sr-only" id="form-delete-{{ $row->id }}" action="{{ route('prescription.delete', $row->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="sr-only" id="btn-{{ $row->id }}">Delete</button>
                    </form>
                    @else
                    <x-form.button color="secondary" class="btn-sm" icon="bx bx-edit-alt" disabled />
                    <x-form.button color="danger" class="btn-sm" icon="bx bx-trash" disabled />
                    @endif
                </td>
            </tr>
            @endforeach
        </x-table>
    </x-card>

    <x-para-clinic.modal-detail />

    <x-modal-confirm-delete />
</x-app-layout>
