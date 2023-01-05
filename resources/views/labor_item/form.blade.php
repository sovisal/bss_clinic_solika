<x-bss-form.input-row name="name_kh" :value="old('name_kh', @$row->name_kh)" required autofocus label="Name in Khmer" />
<x-bss-form.input-row name="name_en" :value="old('name_en', @$row->name_en)" label="Name in English" />
<x-bss-form.input-row name="min_range" class="is_number" :value="old('min_range', @$row->min_range)" label="Min Range" />
<x-bss-form.input-row name="max_range" class="is_number" :value="old('max_range', @$row->max_range)" label="Max Range" />
<x-bss-form.input-row name="unit" :value="old('unit', @$row->unit)" label="Unit" />
<x-bss-form.input-row name="index" class="is_integer" :value="old('index', $row->index ?? ($index ?? 1))" label="Sort Order" />
<x-bss-form.select-row name="other" label="Item Type" data-no_search="true">
    @foreach ([
    'OUT_RANGE_COLOR_RED' => 'NORMAL',
    'VALUE_POSITIVE_NEGATIVE' => 'POSITIVE / NEGATIVE',
    'VALUE_160_320' => '160 / 320'
    ] as $k => $v)
    <option value="{{ $k }}" {{ old('other', @$row->other) == $k ? 'selected' : ''}}>{{ $v }}</option>
    @endforeach
</x-bss-form.select-row>
<x-bss-form.input-row name="type" :value="render_synonyms_name($laborType->name_en, $laborType->name_kh)" label="Labor Type" readonly />