<x-bss-form.input-row name="name_kh" :value="old('name_kh', @$row->name_kh)" required autofocus label="Name in Khmer" />
<x-bss-form.input-row name="name_en" :value="old('name_en', @$row->name_en)" label="Name in English" />
<x-bss-form.input-row name="price" class="is_number" :value="old('price', @$row->price)" label="Price" />
<x-bss-form.input-row name="index" class="is_number" :value="old('index', @$row->index) ?? $index ?? 1" label="Sort Order" />