<x-app-layout>
    <x-slot name="css">
        <style>

        </style>
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        <script>

        </script>
    </x-slot>

    <form action="{{ route('setting.update') }}" method="POST" autocomplete="off">
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

            <table class="table-form striped">
                <tr>
                    <th colspan="4" class="text-left tw-bg-gray-100">Logo</th>
                </tr>
                <x-bss-form.input-file-image-row name="logo" path="{{ asset('images/site') }}" :value="$setting->logo" label="Logo" />
                <tr>
                    <th colspan="4" class="text-left tw-bg-gray-100">Setting information</th>
                </tr>
                <x-bss-form.input-row name="clinic_name_kh" :value="old('clinic_name_kh', $setting->clinic_name_kh)" required autofocus label="Clinic Name (KH)" />
                <x-bss-form.input-row name="clinic_name_en" :value="old('clinic_name_en', $setting->clinic_name_en)" required label="Clinic Name (EN)" />

                <x-bss-form.input-row name="sign_name_kh" :value="old('sign_name_kh', $setting->sign_name_kh)" required label="Signator Name (KH)" />
                <x-bss-form.input-row name="sign_name_en" :value="old('sign_name_en', $setting->sign_name_en)" required label="Signator Name (EN)" />

                <x-bss-form.textarea-row name="description" class="my-editor" :value="old('sign_name_en', $setting->sign_name_en)" required label="Description">
                    {{ old('description', $setting->description) }}
                </x-bss-form.textarea-row>

                <tr>
                    <th colspan="4" class="text-left tw-bg-gray-100">Footer information</th>
                </tr>
                <x-bss-form.input-row name="address" :value="old('address', $setting->address)" required label="Address" />
                <x-bss-form.input-row name="phone" :value="old('phone', $setting->phone)" required label="Phone Number" />
            </table>
        </x-card>
    </form>
	<x-modal-image-crop width="500" height="320" previewWidth="200" previewHeight="128"/>
</x-app-layout>

