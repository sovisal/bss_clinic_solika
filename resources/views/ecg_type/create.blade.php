<x-app-layout>
    <x-slot name="header">
        <x-form.button href="{{ route('setting.ecg-type.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
    </x-slot>
    <form action="{{ route('setting.ecg-type.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <x-card bodyClass="pb-0">			
            <table class="table-form striped">
                <tr>
                    <th colspan="4" class="text-left tw-bg-gray-100">Create New Information</th>
                </tr>
                @include('ecg_type.form')
                @include('ecg_type.extra_form.0')
            </table>
            <x-slot name="footer">
                <x-form.button type="submit" icon="bx bx-save" label="Save" />
            </x-slot>
        </x-card>
    </form>

</x-app-layout>
