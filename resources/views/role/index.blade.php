<x-app-layout>
    <x-slot name="header">
        @can('CreateRole')
        <x-form.button href="{{ route('user.role.create') }}" icon="bx bx-plus" label="Create" />
        @endcan
    </x-slot>

    <x-card :foot="false" :head="false">
        <x-table class="table-hover" id="datatables" data-table="roles">
            <x-slot name="thead">
                <tr>
                    <th>{!! __('table.label') !!}</th>
                    <th>{!! __('table.name') !!}</th>
                    <th width="10%">{!! __('table.action') !!}</th>
                </tr>
            </x-slot>
            @foreach ($roles as $key => $role)
            <tr>
                <td>{!! $role->label !!}</td>
                <td>{!! $role->name !!}</td>
                <td>
                    <x-table-action-btn
                        module="user.role"
                        module-ability="Role"
                        :id="$role->id"
                        :is-trashed="$role->trashed()"
                        :disable-edit="$role->trashed()"
                        :show-btn-show="false"
                    >
                        @can('AssignRoleAbility')
                            <x-form.button
                                class="btn-sm"
                                color="dark"
                                href="{{ route('user.role.ability', $role->id) }}"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="{{ __('button.ability') }}"
                                icon="bx bxs-check-shield"
                            />
                        @endcan
                    </x-table-action-btn>
                </td>
            </tr>
            @endforeach
        </x-table>
    </x-card>

    <x-modal-confirm-delete />

</x-app-layout>