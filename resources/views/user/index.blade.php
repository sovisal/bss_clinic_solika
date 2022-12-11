<x-app-layout>
    <x-slot name="header">
        <x-form.button href="{{ route('user.create') }}" icon="bx bx-plus" label="Create" />
    </x-slot>

    <x-card :foot="false" :head="false">
        <x-table id="datatables" class="table-hover table-striped" data-table="users">
            <x-slot name="thead">
                <tr>
                    <th width="6%" class="no-sort">
                        {!! __('table.no') !!}
                    </th>
                    <th>{!! __('table.name') !!}</th>
                    <th>{!! __('table.username') !!}</th>
                    <th>{!! __('table.role') !!}</th>
                    <th>{!! __('table.position') !!}</th>
                    <th>Doctor</th>
                    <th>{!! __('table.status') !!}</th>
                    <th width="15%">{!! __('table.action') !!}</th>
                </tr>
            </x-slot>
            @foreach ($users as $key => $user)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{!! d_text($user->name) !!}</td>
                <td>{!! d_text($user->username) !!}</td>
                <td>{!! d_obj($user->hasRoles->first(), 'name') !!}</td>
                <td>{!! d_text($user->position) !!}</td>
                <td>{!! d_obj($user, 'doctor', ['name_kh', 'name_en']) !!} </td>
                <td>
                    {!! d_status(!$user->is_suspended) !!}
                </td>
                <td>
                    <x-table-action-btn module="user" :id="$user->id" :is-trashed="$user->trashed()" :show-btn-show="false">
                        @can('UpdateUserPassword')
                            <x-form.button
                                class="btn-sm"
                                color="dark"
                                href="{{ route('user.password', $user->id) }}"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="{{ __('button.change_password') }}"
                                icon="bx bx-key"
                            />
                        @endcan
                        @can('AssignUserRole')
                            <x-form.button
                                class="btn-sm"
                                color="dark"
                                href="{{ route('user.role', $user->id) }}"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="{{ __('button.role') }}"
                                icon="bx bxs-graduation"
                            />
                        @endcan
                        @can('AssignUserAbility')
                            <x-form.button
                                class="btn-sm"
                                color="dark"
                                href="{{ route('user.ability', $user->id) }}"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="{{ __('button.specific_ability') }}"
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