<table class="table-form striped">
    <tr>
        <th colspan="4" class="text-left tw-bg-gray-100">Address Information</th>
    </tr>
    <x-bss-form.input-row name="_name_kh" :value="old('_name_kh', @$province->_name_kh)" required autofocus label="Name KH" />
    <x-bss-form.input-row name="_name_en" :value="old('_name_en', @$province->_name_en)" required label="Name EN" />
    <x-bss-form.input-row name="_path_kh" :value="old('_path_kh', @$province->_path_kh)" required label="Path KH" />
    <x-bss-form.input-row name="_path_en" :value="old('_path_en', @$province->_path_en)" required label="Path EN" />
</table>
