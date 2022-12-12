<x-app-layout>
    <x-slot name="js">
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    </x-slot>
    <x-slot name="header">
        <x-form.button href="{{ route('setting.ecg-type.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
    </x-slot>
    <form action="{{ route('setting.ecg-type.update', $row) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <x-card bodyClass="pb-0">			
            <table class="table-form striped">
                @include('ecg_type.form')
                @if (view()->exists('ecg_type.extra_form.' . $row->id))
                    @include('ecg_type.extra_form.' . $row->id)
                @else	
                    @include('ecg_type.extra_form.0')
                @endif
            </table>
            <x-slot name="footer">
                <x-form.button type="submit" icon="bx bx-save" label="Save" />
            </x-slot>
        </x-card>
    </form>
</x-app-layout>
