<tr>
    <th colspan="4" class="text-left tw-bg-gray-100">Supplier Information</th>
</tr>

<x-bss-form.input-row name="name_kh" :value="old('name_kh', @$row->name_kh)" required label="Name in Khmer" />
<x-bss-form.input-row name="name_en" :value="old('name_en', @$row->name_en)" label="Name in English" />
<x-bss-form.select-row name="category_id" required label="Category">
    <option value="">Please choose</option>
    @foreach ($categories as $category)
    <option value="{{ $category->id }}" {{ old('category_id', @$row->category_id) == $category->id ? 'selected' : '' }}>{{ d_obj($category, ['name_en', 'name_kh']) }}</option>
    @endforeach
</x-bss-form.select-row>
<x-bss-form.select-row name="type_id" required label="Type">
    {{-- <option value="">Please choose</option> --}}
    @foreach ($types as $type)
    <option value="{{ $type->id }}" {{ old('type_id', @$row->type_id) == $type->id ? 'selected' : '' }}>{{ d_obj($type, ['name_en', 'name_kh']) }}</option>
    @endforeach
</x-bss-form.select-row>

<x-bss-form.input-file-image-row
    name="logo"
    path="{{ asset('images/suppliers/') }}"
    image-container-style="width: 128px;"
    :value="@$row->logo"
    label="Logo"
/>

<tr>
    <th colspan="4" class="text-left tw-bg-gray-100">Contact Information</th>
</tr>
<x-bss-form.input-row name="contact_name" :value="old('contact_name', @$row->contact_name)" label="Contact Name" />
<x-bss-form.input-row name="contact_number" :value="old('contact_number', @$row->contact_number)" label="Contact Number" />

<tr>
    <th colspan="4" class="text-left tw-bg-gray-100">Address</th>
</tr>
<x-bss-form.address name="address_id" :value="old('address_id', @$row->address_id)"/>
<x-modal-image-crop width="200" height="200" previewWidth="128" previewHeight="128"/>

<tr>
    <th colspan="4" class="text-left tw-bg-gray-100">Other Information</th>
</tr>
<x-bss-form.input-row name="payment_info" :value="old('payment_info', @$row->payment_info)" label="Payment Info" />
<x-bss-form.textarea-row name="other" label="Other" >{!! old('other', @$row->other) !!}</x-bss-form.textarea-row>