<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{{ route('patient.index') }}"/>
    </x-slot>

    <x-card :head="false" :foot="false">
        <table class="table-form border-none table-padding-sm">
            <tr>
                <td width="150px" rowspan="4" style="vertical-align: top; padding-left: 1.2rem !important; padding-right: 1.2rem !important;" class="text-center">
                    <img src="{{ (($patient->photo)? asset('images/patients/'. $patient->photo) : asset('images/browse-image.jpg') ) }}" alt="..." class="m-auto">
                </td>
                <th width="150px"><label>Patient Code</label> <span class="float-right">:</span></th>
                <td width="20%">PT-{{ str_pad($patient->id, 6, '0', STR_PAD_LEFT) }}</td>
                <th width="150px"><label>Registered</label> <span class="float-right">:</span></th>
                <td>{{ date('d-M-Y H:m', strtotime($patient->registered_at)) }}</td>
                <td width="150px" class="text-center" rowspan="4" style="vertical-align: top;">
                    <x-form.button href="{{ route('patient.edit', $patient->id) }}" class="btn-block" icon="bx bx-edit-alt" label="Edit" />
                </td>
            </tr>
            <tr>
                <th><label>Name KH</label> <span class="float-right">:</span></th>
                <td>{{ $patient->name_kh }}</td>
                <th><label>Name EN</label> <span class="float-right">:</span></th>
                <td>{{ $patient->name_en }}</td>
            </tr>
            <tr>
                <th><label>Gender</label> <span class="float-right">:</span></th>
                <td>{{ d_obj($patient, 'gender', ['title_kh', 'title_en']) }}</td>
                <th><label>Phone</label> <span class="float-right">:</span></th>
                <td>{{ $patient->phone }}</td>
            </tr>
            <tr>
                <th><label>Age</label> <span class="float-right">:</span></th>
                <td>{{ $patient->age }}</td>
                <th><label>E-mail</label> <span class="float-right">:</span></th>
                <td>{{ $patient->email }}</td>
            </tr>
        </table>
    </x-card>

    
    <ul class="nav nav-tabs mt-3 mb-0" role="tablist">
        <li class="nav-item">
            <a class="nav-link btn-sm active" id="detail-tab" data-toggle="tab" href="#detail" aria-controls="detail" role="tab" aria-selected="true">
                <span class="align-middle">Detail</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn-sm" id="history-tab" data-toggle="tab" href="#history" aria-controls="history" role="tab" aria-selected="false">
                <span class="align-middle">History</span>
            </a>
        </li>
    </ul>
    <x-card :foot="false" :head="false">
        <div class="tab-content">
            <div class="tab-pane active" id="detail" aria-labelledby="detail-tab" role="tabpanel">
                <table class="table-form">
                    <tr>
                        <th colspan="4" class="text-center tw-bg-gray-100"><label>Patient Information</label></th>
                    </tr>
                    <tr>
                        <th width="200px"><label>ID Card Number</label> <span class="float-right">:</span></th>
                        <td>{{ $patient->id_card_no }}</td>
                        <th width="200px"><label>Nationality</label> <span class="float-right">:</span></th>
                        <td>{{ d_obj($patient, 'nationality', ['title_kh', 'title_en']) }}</td>
                    </tr>
                    <tr>
                        <th><label>Date of birth</label> <span class="float-right">:</span></th>
                        <td>{{ $patient->date_of_birth ? date('d-M-Y', strtotime($patient->date_of_birth)) : '' }}</td>
                        <th><label>Position</label> <span class="float-right">:</span></th>
                        <td>{{ $patient->position }}</td>
                    </tr>
                    <tr>
                        <th><label>Education</label> <span class="float-right">:</span></th>
                        <td>{{ $patient->education }}</td>
                        <th><label>Marital Status</label> <span class="float-right">:</span></th>
                        <td>{{ d_obj($patient, 'marital_status', ['title_kh', 'title_en']) }}</td>
                    </tr>
                    <tr>
                        <th><label>Position</label> <span class="float-right">:</span></th>
                        <td>{{ $patient->position }}</td>
                        <th><label>Enterprise</label> <span class="float-right">:</span></th>
                        <td>{{ d_obj($patient, 'enterprise', ['title_kh', 'title_en']) }}</td>
                    </tr>
                    <tr>
                        <th><label>Blood Type</label> <span class="float-right">:</span></th>
                        <td>{{ d_obj($patient, 'blood_type', ['title_kh', 'title_en']) }}</td>
                        <td colspan="2"></td>
                    </tr>

                    <tr>
                        <th colspan="4" class="text-center tw-bg-gray-100"><label>Patient Address</label></th>
                    </tr>
                    <tr>
                        <th><label>House</label> <span class="float-right">:</span></th>
                        <td>{{ $patient->house_no }}</td>
                        <th><label>Street</label> <span class="float-right">:</span></th>
                        <td>{{ $patient->street_no }}</td>
                    </tr>
                    <tr>
                        <th><label>Villsage</label> <span class="float-right">:</span></th>
                        <td>{{ $patient->address ? render_synonyms_name($patient->address->village_en, $patient->address->village_kh) : 'N/A' }}</td>
                        <th><label>Commune</label> <span class="float-right">:</span></th>
                        <td>{{ $patient->address ? render_synonyms_name($patient->address->commune_en, $patient->address->commune_kh) : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th><label>District</label> <span class="float-right">:</span></th>
                        <td>{{ $patient->address ? render_synonyms_name($patient->address->district_en, $patient->address->district_kh) : 'N/A' }}</td>
                        <th><label>Province</label> <span class="float-right">:</span></th>
                        <td>{{ $patient->address ? render_synonyms_name($patient->address->province_en, $patient->address->province_kh) : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th><label>Zip Code</label> <span class="float-right">:</span></th>
                        <td>{{ $patient->postal_code }}</td>
                        <td colspan="2"></td>
                    </tr>
                </table>
            </div>
            <div class="tab-pane" id="history" aria-labelledby="history-tab" role="tabpanel">
                <x-table class="table-hover table-striped" id="datatables" data-table="patients">
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Code</th>
                            <th>Patient</th>
                            <th>Requested By</th>
                            <th>Requested Date</th>
                            <th>Analysis By</th>
                            <th>Price</th>
                            <th>Payment</th>
                        <th>User</th>
                        <th>Status</th>
                        </tr>
                    </x-slot>
                    @foreach($patient->history() as $key => $row)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>
                                <a href="javascript:void(0);" onclick="previewPopup('{{ $row->url }}')">
                                    {{ Str::upper($row->row_type) }} / {{ $row->code }}
                                </a>
                            </td>
                            <td>PT-{!! str_pad($patient->id, 6, '0', STR_PAD_LEFT) !!} / {!! $patient->link !!}</td>
                            <td>{!! d_obj($row, 'doctor_requested', 'link') !!}</td>
                            <td>{{ render_readable_date($row->requested_at) }}</td>
                            <td>{!! d_obj($row, 'doctor', 'link') !!}</td>
                            <td>{!! d_currency($row->price) !!}</td>
                            <td>{!! d_paid_status($row->payment_status) !!}</td>
                            <td>{{ d_obj($row, 'user', 'name') }}</td>
                            <td>{!! d_para_status($row->status) !!}</td>
                        </tr>
                    @endforeach
                </x-table>
            </div>
        </div>
    </x-card>

</x-app-layout>
