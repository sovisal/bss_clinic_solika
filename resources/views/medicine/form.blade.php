<div class="row">
    <table class="table-form striped">
        <tr>
            <th colspan="4" class="text-left tw-bg-gray-100">
                <label>Medicine Information</label>
            </th>
        </tr>
        <x-bss-form.input-row name="name_kh" :value="old('name_kh', @$row->name_kh)" required label="Name in Khmer" />
        <x-bss-form.input-row name="name_en" :value="old('name_en', @$row->name_en)" label="Name in English" />
        <x-bss-form.input-row name="cost" class="is_number" :value="old('cost', @$row->cost) ?? 0" required label="Cost" />
        <x-bss-form.input-row name="price" class="is_number" :value="old('price', @$row->price) ?? 0" required label="Price" />
    </table>
</div>
