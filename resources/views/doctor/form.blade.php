<table class="table-form striped">
    <tr>
        <th colspan="4" class="text-left tw-bg-gray-100">Doctor Information</th>
    </tr>
    <x-bss-form.input-row name="name_kh" :value="old('name_kh', @$doctor->name_kh)" required autofocus label="Name in Khmer" />
    <x-bss-form.input-row name="name_en" :value="old('name_en', @$doctor->name_en)" required label="Name in English" />
    <x-bss-form.input-row name="id_card_no" :value="old('id_card_no', @$doctor->id_card_no)" label="Identity Card Number" />
    <x-bss-form.choices-row type="radio" name="gender_id" :checked="old('gender_id', @$doctor->gender_id) ?? 2" :data="$genders" required label="Gender" />
    <x-bss-form.input-row name="email" :value="old('email', @$doctor->email)" label="E-mail" />
    <x-bss-form.input-row name="phone" :value="old('phone', @$doctor->phone)" label="Phone" />
    
    <tr>
        <td colspan="4" class="text-left tw-bg-gray-100">Address</td>
    </tr>
    <input type="hidden" name="address_id" value="{{ @$doctor->address_id }}" />
    <x-bss-form.select-row name="pt_province_id" label="Province">{!! $addresses[0] !!}</x-bss-form.select-row>
    <x-bss-form.select-row name="pt_district_id" label="District">{!! $addresses[1] !!}</x-bss-form.select-row>
    <x-bss-form.select-row name="pt_commune_id" label="Commune">{!! $addresses[2] !!}</x-bss-form.select-row>
    <x-bss-form.select-row name="pt_village_id" label="Village">{!! $addresses[3] !!}</x-bss-form.select-row>
</table>

