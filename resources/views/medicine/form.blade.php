<div class="row">
    <div class="col-7">
        <table class="table-form striped">
            <tr>
                <th colspan="4" class="text-left tw-bg-gray-100">
                    <label>Medicine Information</label>
                </th>
            </tr>
            <x-bss-form.input-row name="code" :value="old('code', @$row->code) ?? $code" required autofocus label="Code" />
            <x-bss-form.input-row name="name_kh" :value="old('name_kh', @$row->name_kh)" required label="Name in Khmer" />
            <x-bss-form.input-row name="name_en" :value="old('name_en', @$row->name_en)" label="Name in English" />
            <x-bss-form.select-row name="category_id" required label="Category">
                <option value="">Please choose</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', @$row->category_id) == $category->id ? 'selected' : '' }}>{{ d_obj($category, ['name_en', 'name_kh']) }}</option>
                @endforeach
            </x-bss-form.select-row>
            <x-bss-form.select-row name="type_id" required label="Type">
                @foreach ($types as $type)
                <option value="{{ $type->id }}" {{ old('type_id', @$row->type_id) == $type->id ? 'selected' : '' }}>{{ d_obj($type, ['name_en', 'name_kh']) }}</option>
                @endforeach
            </x-bss-form.select-row>
            <x-bss-form.input-file-image-row name="image" path="{{ asset('images/products/') }}" image-container-style="width: 128px;" :value="@$row->image" label="Image" />
            <x-modal-image-crop width="200" height="200" previewWidth="128" previewHeight="128" />
        </table>
    </div>
    <div class="col-5">
        <table class="table-form striped">
            <tr>
                <th colspan="4" class="text-left tw-bg-gray-100">
                    <label>Price and Quantity</label>
                </th>
            </tr>
            <x-bss-form.select-row name="unit_id" required label="Base Unit" :disabled="@$row->unit_id">
                <option value="">Please choose</option>
                @foreach ($units as $unit)
                <option value="{{ $unit->id }}" {{ old('unit_id', @$row->unit_id) == $unit->id ? 'selected' : '' }}>{{ d_obj($unit, ['name_en', 'name_kh']) }}</option>
                @endforeach
            </x-bss-form.select-row>
            <x-bss-form.input-row name="cost" class="is_number" :value="old('cost', @$row->cost) ?? 0" required label="Cost" />
            <x-bss-form.input-row name="price" class="is_number" :value="old('price', @$row->price) ?? 0" required label="Price" />
            <!-- <x-bss-form.input-row name="qty_begin" class="is_integer" :value="old('qty_begin', @$row->qty_begin) ?? 0" required label="QTY Begin" :disabled="@$row->qty_begin"/> -->
            <x-bss-form.input-row name="qty_alert" class="is_integer" :value="old('qty_alert', @$row->qty_alert) ?? 10" required label="QTY Alert" />
        </table>
    </div>
</div>

