<x-app-layout>
    @php
    $back_addr = substr_replace($addr, '', -2);
    $code_length = $addr ? strlen($addr) : 0;
    $_addr = $addr;
    @endphp
    <x-slot name="header">
        @if ($code_length >=2)
        <x-form.button href="?addr={{ $back_addr }}" label="Back" color="danger" />
        @endif
        <x-form.button href="{{route('setting.address.create')}}?addr={{ @$addr }}" icon="bx bx-plus" label="Create" />
    </x-slot>
    <x-card :foot="false" :head="false">
        <x-table class="table-hover table-striped" id="datatables" data-table="patients">
            <x-slot name="thead">
                <tr>
                    <th>No</th>
                    <th>Name ({{ $code_length == 2 ? 'District' : ($code_length == 4 ? 'Commune' : ($code_length == 6 ? 'Village' : 'Province')) }})</th>
                    <th>Type</th>
                    <th>
                        {{ $code_length == 2 ? 'Commune' : ($code_length == 4 ? 'Village' : ($code_length == 6 ? '' : 'District')) }}
                    </th>
                    <th width="10%">Action</th>
                </tr>
            </x-slot>
            @foreach($address as $i => $addr)
            <tr>
                <td class="text-center">{{ ++$i }}</td>
                <td>{{ d_combine_array($addr, ['_name_en', '_name_kh']) }}</td>
                <td>{{ d_combine_array($addr, ['_type_en', '_type_kh']) }}</td>
                <td class="text-center">
                    {!! ($code_length < 6) ? '<a href="?addr=' . $addr['_code'] .'"><i class="bx bx-folder-open"></i></a>' : '--' !!}
                </td>
                <td class="text-center">
                    <x-form.button color="secondary" class="btn-sm" href="{{ route('setting.address.edit', $addr['_code']) }}?addr={{ $_addr }}" icon="bx bx-edit-alt" />
                </td>
            </tr>
            @endforeach
        </x-table>
    </x-card>

    <x-modal-confirm-delete />

</x-app-layout>