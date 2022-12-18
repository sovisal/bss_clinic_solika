<table class="table-form striped">
    <tr>
        <td colspan="2" class="text-left tw-bg-gray-100">Personal Information</td>
    </tr>
    <x-bss-form.input-row name="name_kh" :value="old('name_kh', @$patient->name_kh)" required autofocus label="Name in Khmer" />
    <x-bss-form.input-row name="name_en" :value="old('name_en', @$patient->name_en)" label="Name in English" />
    <x-bss-form.input-row name="id_card_no" :value="old('id_card_no', @$patient->id_card_no)" label="Identity Card Number" />
    <x-bss-form.choices-row type="radio" name="gender_id" :checked="old('gender_id', @$patient->gender_id) ?? 2" :data="$genders" required label="Gender" />
    <x-bss-form.input-row type="email" name="email" :value="old('email', @$patient->email)" label="E-mail" />
    <x-bss-form.input-row name="phone" class="is_number" :value="old('phone', @$patient->phone)" label="Phone" />
    <x-bss-form.input-row name="age" class="is_number" :value="old('age', @$patient->age)" label="Age" />
    <x-bss-form.input-row name="date_of_birth" :value="old('date_of_birth', @$patient->date_of_birth)" class="date-picker" hasIcon="right" icon="bx bx-calendar" label="Date of Birth" />
    <x-bss-form.input-row name="registered_at" :value="old('registered_at', ($patient->registered_at ?? date('Y-m-d H:i:s')))" class="date-time-picker" hasIcon="right" icon="bx bx-calendar" label="Registered at" />
    <x-bss-form.input-row name="education" :value="old('education', @$patient->education)" label="Education" />
    <x-bss-form.select-row name="marital_status_id" :selected="old('marital_status_id', @$patient->marital_status_id)" :data="$marital_statuses" label="Marital Status" />
    <x-bss-form.select-row name="nationality_id" :selected="old('nationality_id', @$patient->nationality_id)" :data="$nationalities" label="Nationality" />
    <x-bss-form.select-row name="blood_type_id" :selected="old('blood_type_id', @$patient->blood_type_id)" :data="$blood_types" label="Blood Type" />
    <x-bss-form.input-row name="father_name" :value="old('father_name', @$patient->father_name)" label="Father Name" />
    <x-bss-form.input-row name="father_position" :value="old('father_position', @$patient->father_position)" label="Father Position" />
    <x-bss-form.input-row name="mother_name" :value="old('mother_name', @$patient->mother_name)" label="Mother Name" />
    <x-bss-form.input-row name="mother_position" :value="old('mother_position', @$patient->mother_position)" label="Mother Position" />
    <x-bss-form.input-file-custom-row name="photo" :value="old('photo', @$patient->photo)" label="Photo" />

    <tr>
        <td colspan="2" class="text-left tw-bg-gray-100">Working Information</td>
    </tr>
    <x-bss-form.input-row name="position" :value="old('position', @$patient->position)" label="position" />
    <x-bss-form.select-row name="enterprise_id" :selected="old('enterprise_id', @$patient->enterprise_id)" :data="$enterprises" label="Enterprise" />

    <tr><td colspan="2" class="text-left tw-bg-gray-100">Address</td></tr>
    <x-bss-form.address name="address_id" :value="old('address_id', @$patient->address_id)"/>

    <x-bss-form.input-row name="street_no" :value="old('street_no', @$patient->street_no)" label="Street No." />
    <x-bss-form.input-row name="house_no" :value="old('house_no', @$patient->house_no)" label="House No." />
    <x-bss-form.input-row name="postal_code" class="is_number" :value="old('postal_code', @$patient->postal_code)" label="Postal Code" />
</table>