<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{{ route('patient.index') }}"/>
    </x-slot>
    <form action="{{ route('patient.update', $patient) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <input type="hidden" name="status" value="{{ $patient->status ?: 1 }}" />
        <x-card bodyClass="pb-0">
            <x-slot name="action">
                <div>
                    <x-form.button type="submit" class="btn-submit" value="Progress" icon="bx bx-save" label="Save" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <div>
                    <x-form.button type="submit" class="btn-submit" value="Progress" icon="bx bx-save" label="Save" />
                </div>
            </x-slot>
            <table class="table-form striped">
                @include('patient.form')
            </table>
        </x-card>
    </form>

</x-app-layout>