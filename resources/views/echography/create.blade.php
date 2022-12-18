<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{{ route('para_clinic.echography.index') }}"/>
    </x-slot>
    <x-slot name="js">
        @include('echography.script')
    </x-slot>
    <form action="{{ route('para_clinic.echography.store') }}" method="POST" id="echography-form" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" value="1" />
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

            @include('echography.form_input')
            
        </x-card>
    </form>

</x-app-layout>