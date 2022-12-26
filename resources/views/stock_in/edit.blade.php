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
                <tr>
                    <x-bss-form.input-row name="date" id="" labelWidth="15%" :tr="false" :value="old('date', $row->date)" class="date-picker" hasIcon="right" icon="bx bx-calendar" required label="Date" />
                    <x-bss-form.select-row name="supplier_id" id="" labelWidth="15%" :tr="false" required label="Supplier">
                        <option value="">---- None ----</option>
                        @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id', $row->supplier_id) == $supplier->id ? 'selected' : '' }}>{{ d_obj($supplier, ['name_en', 'name_kh']) }}</option>
                        @endforeach
                    </x-bss-form.select-row>
                </tr>
                <tr>
                    <x-bss-form.input-row name="exp_date" id="" labelWidth="15%" :tr="false" :value="old('exp_date', $row->exp_date)" class="date-picker" hasIcon="right" icon="bx bx-calendar" label="Expire Date" />
                    <x-bss-form.select-row name="product_id" id="" labelWidth="15%" :tr="false" required label="Product">
                        <option value="">---- None ----</option>
                        @if ($row->product_id)
                            <option value="{{ $row->product_id }}" selected>{{ d_obj($row, 'product', ['name_en', 'name_kh']) }}</option>
                        @endif
                    </x-bss-form.select-row>
                </tr>
                <tr>
                    <x-bss-form.input-row name="reciept_no" id="" labelWidth="15%" :tr="false" :value="old('reciept_no', $row->reciept_no)" required label="Reciept Number" />
                    <x-bss-form.select-row name="unit_id" id="" labelWidth="15%" :tr="false" class="unit_id" label="Unit">
                        <option value="">---- None ----</option>
                        @if ($row->unit_id)
                            <option value="{{ $row->unit_id }}" selected>{{ d_obj($row, 'unit', ['name_en', 'name_kh']) }}</option>
                        @endif
                    </x-bss-form.select-row>
                </tr>
                <tr>
                    <x-bss-form.input-row name="qty_based" id="" labelWidth="15%" :tr="false" class="is_number" :value="old('qty', $row->qty_based)" readonly label="Base Qty" />
                    <x-bss-form.input-row name="price" id="" labelWidth="15%" :tr="false" class="is_number" :value="old('price', $row->price) ?? 0" required label="Price" />
                </tr>
                <tr>
                    <x-bss-form.input-row name="total" id="" labelWidth="15%" :tr="false" class="is_number qty" :value="old('qty', $row->total)" readonly label="Total" />
                    <x-bss-form.input-row name="price" id="" labelWidth="15%" :tr="false" class="is_number price" :value="old('price', $row->price) ?? 0" required label="Price" />
                </tr>
            </table>
        </x-card>
    </form>

    <x-modal-image-crop />
</x-app-layout>