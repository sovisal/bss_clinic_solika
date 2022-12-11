<x-app-layout>
    <x-slot name="header">
        <x-form.button href="{{ route('setting.doctor.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
    </x-slot>
    <form action="{{ route('setting.doctor.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
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
</x-app-layout>

