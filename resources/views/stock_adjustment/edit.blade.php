<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{{ route('inventory.stock_adjustment.index') }}" />
    </x-slot>
    <x-slot name="js">
        @include('stock_adjustment.script')
    </x-slot>
    <form action="{{ route('inventory.stock_adjustment.update', $row->id) }}" method="POST" autocomplete="off">
        @method('PUT')
        @csrf
        <x-card bodyClass="pb-0">
            <x-slot name="action">
                <x-form.button type="submit" icon="bx bx-save" label="Save" />
            </x-slot>
            <x-slot name="footer">
                <x-form.button type="submit" icon="bx bx-save" label="Save" />
            </x-slot>

            <table class="table-stock-adjustment-item table-form striped">
                <tr>
                    <th colspan="6" class="tw-bg-gray-100">Stock Adjustment Information</th>
                </tr>

                <x-bss-form.input-row name="date" id="" class="date-picker" value="{{ old('date', $row->date) }}" required hasIcon="right" icon="bx bx-calendar" label="Date" />
                <x-bss-form.select-row name="product_id" id="" required label="Product">
                    <option value="">---- None ----</option>
                    @foreach ($products as $product)
                    <option value="{{ $product->id }}" @selected($product->id == old('product_id', $row->product_id))>{{ d_obj($product, ['name_en', 'name_kh']) }}</option>
                    @endforeach
                </x-bss-form.select-row>
                <x-bss-form.input-row name="qty" id="" class="is_number" value="{{ old('date', $row->qty) }}" required label="QTY Remove" />
                <x-bss-form.textarea-row name="reason" id="" required label="Reason" >{!! old('reason', $row->reason) !!}</x-bss-form.textarea-row>
            </table>
        </x-card>
    </form>

    <x-modal-image-crop />
</x-app-layout>