<x-app-layout>
    <x-slot name="header">
        <x-form.button href="{{ route('user.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
    </x-slot>

    <form action="{{ route('user.assign_role', $user) }}" method="POST" autocomplete="off">
        @method('PUT')
        @csrf
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <x-card bodyClass="pb-1">
                    <x-slot name="footer">
                        <div>
                            <x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-save" label="Save" />
                        </div>
                    </x-slot>
                    <table class="table-form striped">
                        <x-bss-form.select-row name="role" label="{!! __('form.user.role') !!}">
                            <option value=""> {{ __('form.please_select') }} </option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->name }}" @selected(( $user->hasRoles->first()->id ?? '' ) == $role->id)>{{ $role->name }}</option>
                            @endforeach
                        </x-bss-form.select-row>
                    </table>
                </x-card>
            </div>
        </div>
    </form>
</x-app-layout>