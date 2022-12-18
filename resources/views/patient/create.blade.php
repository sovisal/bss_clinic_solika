<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{{ route('patient.index') }}"/>
    </x-slot>
    <form action="{{ route('patient.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <x-card bodyClass="pb-0">
            <x-slot name="action">
                <div>
                    <x-form.button type="submit" value="Progress" icon="bx bx-save" label="Save" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <div>
                    <x-form.button type="submit" value="Progress" icon="bx bx-save" label="Save" />
                </div>
            </x-slot>
            <table class="table-form striped">
                @include('patient.form')
            </table>
        </x-card>
    </form>

    <x-modal-image-crop />
</x-app-layout>