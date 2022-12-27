<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{{ route('inventory.stock_in.index') }}" />
    </x-slot>
    <x-slot name="js">
        @include('stock_in.script')
    </x-slot>
    <form action="{{ route('inventory.stock_in.update', $row->id) }}" method="POST" autocomplete="off">
        @method('PUT')
        @csrf
        <x-card bodyClass="pb-0">
            <x-slot name="action">
                <x-form.button type="submit" icon="bx bx-save" label="Save" />
            </x-slot>
            <x-slot name="footer">
                <x-form.button type="submit" icon="bx bx-save" label="Save" />
            </x-slot>

            <table class="table-stock-in-item table-form striped">
                <tr>
                    <th colspan="4" class="tw-bg-gray-100">
                        Stock In Information
                    </th>
                </tr>
                <x-bss-form.input-row name="date" id="" labelWidth="15%" :value="old('date', $row->date)" class="date-picker" hasIcon="right"
                    icon="bx bx-calendar" required label="Date" />
                <x-bss-form.input-row name="exp_date" id="" labelWidth="15%" :value="old('exp_date', $row->exp_date)" class="date-picker"
                    hasIcon="right" icon="bx bx-calendar" label="Expire Date" />
                <x-bss-form.input-row name="reciept_no" id="" labelWidth="15%" :value="old('reciept_no', $row->reciept_no)" required
                    label="Reciept Number" />
                <x-bss-form.input-row name="price" id="" labelWidth="15%" class="is_number price" :value="old('price', $row->price) ?? 0" required
                    label="Price" />
            </table>
        </x-card>
    </form>

    <x-modal-image-crop />
</x-app-layout>