<tr>
    <th colspan="4" class="text-left tw-bg-gray-100">Product Information</th>
</tr>

<x-bss-form.input-row name="name_kh" :value="old('name_kh', @$row->name_kh)" required autofocus label="Name in Khmer" />
<x-bss-form.input-row name="name_en" :value="old('name_en', @$row->name_en)" label="Name in English" />
<x-bss-form.input-row name="cost" class="is_number" :value="old('cost', @$row->cost)" label="Cost" />
<x-bss-form.input-row name="price" class="is_number" :value="old('price', @$row->price)" label="Price" />
<x-bss-form.select-row name="category_id" required label="Category">
    <option value="">Please choose</option>
    @foreach ($categories as $category)
    <option value="{{ $category->id }}" {{ old('category_id', @$row->category_id) == $category->id ? 'selected' : '' }}>{{ d_obj($category, ['name_en', 'name_kh']) }}</option>
    @endforeach
</x-bss-form.select-row>
<x-bss-form.select-row name="unit_id" required label="Unit">
    <option value="">Please choose</option>
    @foreach ($units as $unit)
    <option value="{{ $unit->id }}" {{ old('unit_id', @$row->unit_id) == $unit->id ? 'selected' : '' }}>{{ d_obj($unit, ['name_en', 'name_kh']) }}</option>
    @endforeach
</x-bss-form.select-row>

<x-bss-form.input-file-image-row
    name="image"
    path="{{ asset('images/products/') }}"
    image-container-style="width: 128px;"
    :value="@$row->image"
    label="Image"
/>

<x-modal-image-crop width="200" height="200" previewWidth="128" previewHeight="128"/>