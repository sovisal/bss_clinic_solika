<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{{ route('para_clinic.labor.index') }}"/>
    </x-slot>
    <x-slot name="js">
        @include('labor.script')
    </x-slot>
    <form action="{{ route('para_clinic.labor.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
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

            @include('labor.form_input')
            <br/>
            @include('labor.form_input_new')
        </x-card>
    </form>
</x-app-layout>