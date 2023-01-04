<x-app-layout>
    <x-slot name="js">
        <script>
            localStorage.setItem("treament_plan_tab", '');

            let table_columns   = [
                {data: 'dt.code', name: 'id'},
                {data: 'dt.patient', name: 'name_kh'},
                {data: 'dt.gender', name: 'gender.title_kh', orderable: false, searching: false}, 
                {data: 'dt.age', name: 'age'}, 
                {data: 'dt.phone', name: 'phone'}, 
                {data: 'dt.address', name: 'id', orderable: false, searching: false},
                {data: 'dt.registered_at', name: 'registered_at'},
                {data: 'dt.user', name: 'user.name', orderable: false, searching: false},
                {data: 'dt.status', name: 'status', searching: false },
                {data: 'dt.action', name: 'id', orderable: false, searching: false },
            ];

            initDatatableDynamic('#datatables_server', '', table_columns);
        </script>
    </x-slot>
    <x-slot name="header">
        <x-form.button href="{{ route('patient.create') }}" class="btn-sm" icon="bx bx-plus" label="Create" />
    </x-slot>
    <x-card :foot="false" :head="false">
        <x-table class="table-hover table-striped table-padding-sm" id="datatables_server" data-table="patients">
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
            <!-- Dynamic data table -->
        </x-table>
    </x-card>
    <x-modal-confirm-delete />
    
</x-app-layout>
