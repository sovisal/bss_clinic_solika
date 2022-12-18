<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{{ route('para_clinic.ecg.index') }}"/>
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        @include('echography.script')
    </x-slot>
    <form action="{{ route('para_clinic.ecg.update', $row) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <input type="hidden" name="status" value="{{ $row->status ?: 1 }}" />
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

            @include('ecg.form_input')

            <br>
            <table class="table-form striped">
                <tr>
                    <th colspan="4" class="text-left tw-bg-gray-100">Result</th>
                </tr>
                @if (view()->exists('ecg_type.extra_form.' . $row->type))
                @include('ecg_type.extra_form.' . $row->type)
                @else
                @include('ecg_type.extra_form.0')
                @endif
            </table>
        </x-card>
    </form>

</x-app-layout>