<x-app-layout>
    <x-slot name="header">
        @can('CreateMedicine')
        <x-form.button href="{{ route('setting.medicine.create') }}" icon="bx bx-plus" label="Create" />
        @endcan
    </x-slot>
    <x-card :foot="false" :head="false">
        <x-table class="table-hover table-striped" id="datatables">
            <x-slot name="thead">
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Usage</th>
                    <th>Price</th>
                    <th>Modify at</th>
                    <th>Modify by</th>
                    <th>Action</th>
                </tr>
            </x-slot>
            @foreach($medicines as $medicine)
            <tr>
                <td class="text-center">
                    MD-{!! str_pad($medicine->id, 6, '0', STR_PAD_LEFT) !!}
                </td>
                <td>{{ $medicine->name }}</td>
                <td>{{ render_synonyms_name($medicine->usage_name_en, $medicine->usage_name_kh) }}</td>
                <td class="text-right"><span class="float-left">$</span> {{ number_format($medicine->price, 2) }}</td>
                <td>{!! date('d-M-Y H:i', strtotime($medicine->updated_at)) !!}</td>
                <td>{!! $medicine->updated_by_name !!}</td>
                <td class="text-center">
                    <x-table-action-btn
                        module="setting.medicine"
                        module-ability="Medicine"
                        :id="$medicine->id"
                        :is-trashed="$medicine->trashed()"
                        :disable-edit="$medicine->trashed()"
                        :show-btn-show="false"
                    />
                </td>
            </tr>
            @endforeach
        </x-table>
    </x-card>
    <x-modal-confirm-delete />
</x-app-layout>