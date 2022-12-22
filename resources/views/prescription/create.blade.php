<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{{ route('prescription.index') }}"/>
    </x-slot>
    <x-slot name="js">
        @include('prescription.script')
    </x-slot>
    <form action="{{ route('prescription.store') }}" method="POST" id="form_prescription" autocomplete="off" enctype="multipart/form-data">
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

            @include('prescription.form_input')
            <br>
            @include('prescription.form_medicine')
        
        </x-card>
    </form>
    <div>
        <table id="sample_prescription" class="hidden">
            @include('prescription.form_medicine_sample')
        </table>
    </div>
</x-app-layout>