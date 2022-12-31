<x-app-layout>
    <x-slot name="js">
        <script>
            localStorage.setItem("treament_plan_tab", '');
        </script>
    </x-slot>
    <x-slot name="header">
        <x-form.button href="{{ route('patient.create') }}" class="btn-sm" icon="bx bx-plus" label="Create" />
    </x-slot>
    <x-card :foot="false" :head="false">
        <x-table class="table-hover table-striped table-padding-sm" id="datatables" data-table="patients">
            <x-slot name="thead">
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Registered at</th>
                    <th>User</th>
                    <th>Status</th>
                    <th width="10%">{!! __('table.action') !!}</th>
                </tr>
            </x-slot>
            @foreach ($patients as $key => $patient)
                <tr>
                    <td class="text-center">
                        @if($patient->hasOneConsultation)
                            {!! d_link('PT-' . str_pad($patient->id, 6, '0', STR_PAD_LEFT), route('patient.consultation.edit', $patient->hasOneConsultation->id)) !!}
                        @else 
                            {!! 'PT-' . str_pad($patient->id, 6, '0', STR_PAD_LEFT) !!}
                        @endif
                    </td>
                    <td>{{ d_obj($patient, ['name_en', 'name_kh']) }}</td>
                    <td>{{ d_obj($patient, 'gender', ['title_en', 'title_kh']) }}</td>
                    <td>{{ d_number($patient->age) }}</td>
                    <td>{{ d_text($patient->phone) }}</td>
                    <td>{{ d_obj($patient, 'address', ['village_kh', 'commune_kh', 'district_kh', 'province_kh'] ) }}</td>
                    <td>{{ d_date_time($patient->registered_at) }}</td>
                    <td>{{ d_obj($patient, 'user', 'name') }}</td>
                    <td>{!! d_status($patient->lastedConsultation()->status ?? 1) !!}</td>
                    <td>
                        <x-table-action-btn
                            module="patient"
                            :id="$patient->id"
                            :is-trashed="$patient->trashed()"
                            :disable-show="$patient->trashed()"
                            :disable-edit="$patient->trashed()"
                            :disable-delete="$patient->hasOneConsultation"
                        />
                    </td>
                </tr>
            @endforeach
        </x-table>
    </x-card>
    
    <x-modal-confirm-delete />

</x-app-layout>
