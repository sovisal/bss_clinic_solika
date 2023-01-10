<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{{ route('setting.medicine.index') }}" />
    </x-slot>
    <form action="{{ route('setting.medicine.update', $row->id) }}" method="POST" autocomplete="off">
        @method('PUT')
        @csrf
        <x-card bodyClass="pb-0">
            <x-slot name="action">
                <x-form.button type="submit" icon="bx bx-save" label="Save" />
            </x-slot>
            <x-slot name="footer">
                <x-form.button type="submit" icon="bx bx-save" label="Save" />
            </x-slot>
            
            @include('medicine.form')
            
        </x-card>
    </form>
</x-app-layout>