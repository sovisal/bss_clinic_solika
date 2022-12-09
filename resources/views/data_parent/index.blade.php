<x-app-layout>
    <x-slot name="header">
        <x-form.button href="{{ route('setting.data-parent.create') }}" label="Create" icon="bx bx-plus" />
    </x-slot>
    <x-card :foot="false" :head="false">
        @foreach(data_parent_selection_conf() as $key => $val)
        @if (empty($val['is_invisible']) || $val['is_invisible'] == false)
        <a href="?type={{ $key }}" style="{{ $type == $key ? 'text-decoration: underline; font-weight: bold;' : '' }}" color="{{ $type == $key ? 'secondary' : 'primary' }}">{{ $val['label'] }}</a>
        &nbsp;
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
            @php
            $i = 0;
            @endphp
            @foreach($rows as $row)
            <tr>
                <td class="text-center">{{ ++$i }}</td>
                <td>{{ d_obj($row, ['title_en', 'title_kh']) }}</td>
                @if ($module_conf['is_child'] ?? false)
                <td>{{ d_text($row->parent_id ? $parent_list[$row->parent_id] : 'N/A') }}</td>
                @endif
                <td>{{ d_text($row->description) }}</td>
                <td class="text-center">{{ d_obj($row, 'user', 'name') }}</td>
                <td class="text-center">{{ $row->status }}</td>
                <td class="text-center">
                    <x-form.button color="secondary" class="btn-sm" href="{{ route('setting.data-parent.edit', $row->id) }}" icon="bx bx-edit-alt" />
                    <x-form.button color="danger" class="confirmDelete btn-sm" data-id="{{ $row->id }}" icon="bx bx-trash" />
                    <form class="sr-only" id="form-delete-{{ $row->id }}" action="{{ route('setting.data-parent.delete', $row->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="sr-only" id="btn-{{ $row->id }}">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </x-table>
    </x-card>

    <x-modal-confirm-delete />

</x-app-layout>
