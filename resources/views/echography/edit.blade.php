<x-app-layout>
    <x-slot name="js">
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        @include('echography.script')
    </x-slot>
    <x-slot name="header">
        <x-form.button href="{{ route('para_clinic.echography.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
    </x-slot>
    <form action="{{ route('para_clinic.echography.update', $row) }}" id="echography-form" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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

            @include('echography.form_input')

            <br>
            <table class="table-form striped">
                <tr>
                    <th colspan="4" class="text-left tw-bg-gray-100">Result</th>
                </tr>

                @includeFirst(['echo_type.extra_form.' . $row->type_id, 'echo_type.extra_form.0'])

            </table>
        </x-card>
    </form>

</x-app-layout>