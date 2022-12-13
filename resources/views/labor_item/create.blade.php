<x-app-layout>
    <x-slot name="header">
        <x-form.button href="{!! route('setting.labor-type.index', $laborType->id) !!}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
    </x-slot>
    <form action="{!! route('setting.labor-item.store', $laborType->id) !!}" method="POST" autocomplete="off">
        @method('PUT')
        @csrf
        <x-card bodyClass="pb-0">
            <x-slot name="action">
                <x-form.button type="submit" icon="bx bx-save" label="Save" />
            </x-slot>
            <x-slot name="footer">
                <x-form.button type="submit" icon="bx bx-save" label="Save" />
            </x-slot>

            <table class="table-form striped">
                {{-- <tr>
                    <th colspan="4" class="text-left tw-bg-gray-100">Create New Information</th>
                </tr>
                <tr>
                    <td width="20%" class="text-right">Name <small class='required'>*</small></td>
                    <td>
                        <x-bss-form.input name="name" required autofocus />
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="text-right">Min Range <small class='required'>*</small></td>
                    <td>
                        <x-bss-form.input name="min_range" required />
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="text-right">Max Range <small class='required'>*</small></td>
                    <td>
                        <x-bss-form.input name="max_range" required />
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="text-right">Unit</td>
                    <td>
                        <x-bss-form.input name="unit" />
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="text-right">Category <small class='required'>*</small></td>
                    <td>
                        <x-bss-form.select name="type" :select2="false" readonly>
                            <option value="{{ $type->id }}">{{ $type->name_en }}</option>
                        </x-bss-form.select>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="text-right">Index</td>
                    <td>
                        <x-bss-form.input name="index" value="9999" type="number" />
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="text-right">Syntax</td>
                    <td>
                        <x-bss-form.select name="other" data-no_search="true">
                            <option value="OUT_RANGE_COLOR_RED">NORMAL</option>
                            <option value="VALUE_POSITIVE_NEGATIVE">POSITIVE / NEGATIVE</option>
                            <option value="VALUE_160_320">160 / 320</option>
                        </x-bss-form.select>
                    </td>
                </tr> --}}
            </table>
        </x-card>
    </form>
</x-app-layout>