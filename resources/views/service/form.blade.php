<table class="table-form striped">
    <tr>
        <th colspan="4" class="text-left tw-bg-gray-100">Service Information</th>
    </tr>

    <x-bss-form.input-row name="name" :value="old('name', @$row->name)" required autofocus label="Name" />
    <x-bss-form.input-row name="price" :value="old('price', @$row->price)" class="is_number" required label="Price" />
    <x-bss-form.input-row name="description" :value="old('description', @$row->description)" label="Description" />
</table>