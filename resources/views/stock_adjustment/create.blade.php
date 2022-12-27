<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{{ route('inventory.stock_adjustment.index') }}" />
    </x-slot>
    <x-slot name="css">
        <style>
            #form-item-container td{
                vertical-align: top;
            }
        </style>
    </x-slot>
    <x-slot name="js">
        @include('stock_adjustment.script')
    </x-slot>
    <form action="{{ route('inventory.stock_adjustment.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <x-card bodyClass="pb-0">
            <x-slot name="action">
                <x-form.button type="submit" value="Progress" icon="bx bx-save" label="Save" />
            </x-slot>
            <x-slot name="footer">
                <x-form.button type="submit" value="Progress" icon="bx bx-save" label="Save" />
            </x-slot>
            
            <table class="table-form striped">
                <thead>
                    <tr>
                        <th colspan="5" class="tw-bg-gray-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>Stock Out Information</div>
                                <div>
                                    <x-form.button href="javascript:void(0)" color="dark" id="btn-add-stock-adjustment" icon="bx bx-plus" label="Add Stock Adjustment"/>
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>Date <small class="required">*</small></th>
                        <th>Product <small class="required">*</small></th>
                        <th>Qty Remove <small class="required">*</small></th>
                        <th>Reason <small class="required">*</small></th>
                        <th width="70px">Action</th>
                    </tr>
                </thead>
                <tbody id="form-item-container" class="widget-todo-list-wrapper">
                </tbody>
            </table>
        </x-card>
    </form>

    @include('stock_adjustment.form_stock_adjustment_sample')
    <x-modal-image-crop />
</x-app-layout>