<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{!! route('setting.xray-type.index') !!}"/>
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    </x-slot>
    <form action="{{ route('setting.xray-type.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
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

                @include('xray_type.extra_form.0')
            </table>
        </x-card>
    </form>

</x-app-layout>