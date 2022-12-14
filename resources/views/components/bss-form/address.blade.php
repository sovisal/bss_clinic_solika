@props([
    'name',
    'value'
])

<?php
    if ($old_id = old('pt_village_id') ?: old('pt_commune_id') ?: old('pt_district_id') ?: old('pt_province_id')) {
        $data = get4LevelAdressSelector($old_id, 'option');
    } elseif ($value) {
        $data = get4LevelAdressSelectorByID($value, ...['xx', 'option']);
    } else {
        $data = get4LevelAdressSelector('xx', 'option');
    }
?>

<input type="hidden" name="{{ $name }}" value="{{ $value }}">
<x-bss-form.select-row name="pt_province_id" label="Province">{!! $data[0] !!}</x-bss-form.select-row>
<x-bss-form.select-row name="pt_district_id" label="District">{!! $data[1] !!}</x-bss-form.select-row>
<x-bss-form.select-row name="pt_commune_id" label="Commune">{!! $data[2] !!}</x-bss-form.select-row>
<x-bss-form.select-row name="pt_village_id" label="Village">{!! $data[3] !!}</x-bss-form.select-row>