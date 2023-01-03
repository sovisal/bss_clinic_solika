<x-app-layout>
    <x-slot name="header">
        @can('CreateDataParent')
            <x-form.button href="{{ route('setting.data-parent.create') }}" label="Create" icon="bx bx-plus" />
        @endcan
    </x-slot>
    <x-card :foot="false" :head="false">
        @foreach(data_parent_selection_conf() as $key => $val)
            @if (empty($val['is_invisible']) || $val['is_invisible'] == false)
                <a href="?type={{ $key }}" style="{{ $type == $key ? 'text-decoration: underline; font-weight: bold;' : '' }}"
                    color="{{ $type == $key ? 'secondary' : 'primary' }}">{{ $val['label'] }}</a>&nbsp;
            @endif
        @endforeach
        <hr>
        <x-table class="table-hover table-striped" id="datatables" data-table="patients">
            <x-slot name="thead">
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    @if ($module_conf['is_child'] ?? false)
                    <th>{{ $parent_module_conf['label'] }}</th>
                    @endif
                    <th>Description</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </x-slot>
            @php($i = 0)
            @foreach($rows as $row)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ d_obj($row, ['title_en', 'title_kh']) }}</td>
                @if ($module_conf['is_child'] ?? false)
                <td>{{ d_text($row->parent_id ? $parent_list[$row->parent_id] : 'N/A') }}</td>
                @endif
                <td>{{ d_text($row->description) }}</td>
                <td>{{ d_obj($row, 'user', 'name') }}</td>
                <td>{!! d_status($row->status) !!}</td>
                <td>
                    <x-table-action-btn
                        module="setting.data-parent"
                        module-ability="DataParent"
                        :id="$row->id"
                        :is-trashed="$row->trashed()"
                        :disable-edit="$row->trashed()"
                        :show-btn-show="false"
                    />
                </td>
            </tr>
            @endforeach
        </x-table>
    </x-card>

    <x-modal-confirm-delete />

</x-app-layout>