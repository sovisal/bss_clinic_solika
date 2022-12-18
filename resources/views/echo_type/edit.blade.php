<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{{ route('setting.echo-type.index') }}"/>
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    </x-slot>
    <form action="{{ route('setting.echo-type.update', $row) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <x-card bodyClass="pb-0">
            <x-slot name="action">
                <x-form.button type="submit" icon="bx bx-save" label="Save" />
            </x-slot>
            <x-slot name="footer">
                <x-form.button type="submit" icon="bx bx-save" label="Save" />
            </x-slot>
            
            <table class="table-form striped">

                @include('shared.setting_service.form')

                @if (view()->exists('echo_type.extra_form.' . $row->id))
                    @include('echo_type.extra_form.' . $row->id)
                @else
                    @include('echo_type.extra_form.0')
                @endif
            </table>
        </x-card>
    </form>

</x-app-layout>