<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{{ route('setting.doctor.index') }}"/>
    </x-slot>
    <form action="{{ route('setting.doctor.update', $doctor->id) }}" method="POST" autocomplete="off">
        @method('PUT')
        @csrf
        <x-card bodyClass="pb-0">
            <x-slot name="action">
                <div>
                    <x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-save" label="Save" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <div>
                    <x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-save" label="Save" />
                </div>
            </x-slot>

			@include('doctor.form')
        </x-card>
    </form>

    <x-modal-image-crop />
</x-app-layout>

