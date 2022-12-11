<table class="table-form striped">
    <tr>
        <td colspan="4" class="text-left tw-bg-gray-100">Service Information</td>
    </tr>
    <x-bss-form.input-row name="name" :value="old('name', @$user->name)" required autofocus label="{!! __('form.name') !!}" />
    <x-bss-form.choices-row type="radio" name="gender_id" :checked="old('gender_id', @$user->gender_id) ?? 2" :data="$genders" required label="{!! __('form.gender') !!}" />
    <x-bss-form.input-row name="phone" :value="old('phone', @$user->phone)" label="{!! __('form.phone') !!}" />
    <x-bss-form.input-row name="position" :value="old('position', @$user->position)" label="{!! __('form.user.position') !!}" />
    <x-bss-form.input-row name="address" :value="old('address', @$user->address)" label="{!! __('form.address') !!}" />
    <x-bss-form.textarea-row name="bio" rows="3" label="{!! __('form.user.bio') !!}" >{{ old('bio', @$user->bio) }}</x-bss-form.textarea-row>
    <x-bss-form.select-row name="doctor_id" label="{!! __('form.user.doctor') !!}">
        <option value="">{!! __('form.please_select') !!}</option>
        @foreach ($doctors as $doctor)
        <option value="{{ $doctor->id }}" @selected(old('doctor_id', @$user->doctor_id) == $doctor->id)>{{ $doctor->name_en }}</option>
        @endforeach
    </x-bss-form.select-row>
    @if (!isset($user))
        <tr>
            <td colspan="4" class="text-left tw-bg-gray-100">User Log</td>
        </tr>
        <x-bss-form.input-row name="username" required label="{!! __('form.username') !!}"/>
        <x-bss-form.input-row type="password" name="password" autocomplete="new-password" required label="{!! __('form.user.password') !!}"/>
        <x-bss-form.input-row type="password" name="password_confirmation" required label="{!! __('form.user.password_confirmation') !!}"/>
    @endif
</table>