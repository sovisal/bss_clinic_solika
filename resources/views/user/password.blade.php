<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{{ route('user.index') }}"/>
    </x-slot>
    <form action="{{ route('user.update_password', $user) }}" method="POST" autocomplete="off">
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
                        <x-bss-form.input-row type="password" name="current_password" autocomplete="password" required
                            label="{!! __('form.user.current_password') !!}" />
                        <x-bss-form.input-row type="password" name="password" autocomplete="new-password" required
                            label="{!! __('form.user.password') !!}" />
                        <x-bss-form.input-row type="password" name="password_confirmation" required
                            label="{!! __('form.user.password_confirmation') !!}" />
                    </table>
                </x-card>
            </div>
        </div>
    </form>

</x-app-layout>