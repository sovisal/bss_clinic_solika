<table class="table-stock-out-item table-form striped {{ ((isset($row->error) && $row->error !== '')? 'is-invalid' : '') }}">
    <tr>
        <th colspan="6" class="tw-bg-gray-100">
            <div class="d-flex justify-content-between align-items-center">
                <div><i class='bx bx-grid-vertical mr-25 font-medium-4 cursor-move'></i> Information</div>
                <x-form.button href="javascript:void(0)" color="danger" class="btn-remove-stock-out" icon="bx bx-trash" onclick="$(this).closest('tr.stock-out-item').remove();" label="Remove"/>
            </div>
        </th>
    </tr>
    <tr>
        <x-bss-form.input-row name="date[]" id="" labelWidth="15%" :tr="false" class="date-picker" value="{{ $row->date ?? date('Y-m-d') }}" required hasIcon="right" icon="bx bx-calendar" label="Date" />
        <x-bss-form.select-row name="product_id[]" id="" labelWidth="15%" :tr="false" :select2="false" required label="Product">
            <option value="">---- None ----</option>
            @foreach ($products as $product)
            <option value="{{ $product->id }}" data-price="{{ $product->price }}" @selected($product->id==@$row->product_id)>{{ d_obj($product, ['name_en', 'name_kh']) }}</option>
            @endforeach
        </x-bss-form.select-row>
        <x-bss-form.input-row name="qty[]" id="" labelWidth="15%" :tr="false" class="is_number qty" value="{{ @$row->qty }}" required label="QTY Out" />
    </tr>
    <tr>
        <x-bss-form.input-row name="reciept_no[]" id="" labelWidth="15%" :tr="false" value="{{ @$row->reciept_no }}" label="Reciept Number" />
        <x-bss-form.select-row name="unit_id[]" id="" labelWidth="15%" :tr="false" class="unit_id" :select2="false" label="Unit">
            <option value="">---- None ----</option>
            @if (isset($row) && $row->unit_option != '')
                {!! $row->unit_option !!}
            @endif
        </x-bss-form.select-row>
        <x-bss-form.input-row name="price[]" id="" labelWidth="15%" :tr="false" class="is_number price" value="{{ @$row->price }}" required label="Price" />
    </tr>
    <input type="hidden" name="qty_based[]" value="{{ @$row->qty_based }}" readonly/>
    <tr>
        @if (isset($module) && $module == 'inventory.stock_adjustment')
            <td class="text-right">
                <label for="note">Reason <small class="required">*</small></label>
            </td>
            <td colspan="3">
                <x-bss-form.textarea name="note[]" rows="1" required>{!! @$row->note !!}</x-bss-form.textarea>
            </td>
        @else
            <td class="text-right">
                <label for="note">Reason</label>
            </td>
            <td colspan="3">
                <x-bss-form.textarea name="note[]" rows="1">{!! @$row->note !!}</x-bss-form.textarea>
            </td>
        @endif
        <x-bss-form.input-row name="total[]" id="" labelWidth="15%" :tr="false" class="is_number total" value="{{ @$row->total }}" readonly label="Total" />
    </tr>
</table>
@if(isset($row->error) && $row->error !== '')
    <small class="text-danger"><i class="bx bx-radio-circle tw-text-base"></i> {!! $row->error !!}</small>
@endif