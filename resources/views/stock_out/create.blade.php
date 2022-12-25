<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{{ route('inventory.stock_out.index') }}" />
    </x-slot>
    <x-slot name="js">
        @include('stock_out.script')
    </x-slot>
    <form action="{{ route('inventory.stock_out.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
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
                        <th class="tw-bg-gray-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>Stock Out</div>
                                <div>
                                    <x-form.button href="javascript:void(0)" color="dark" id="btn-add-stock-in" icon="bx bx-plus" label="Add Stock In"/>
                                </div>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody id="form-item-container" class="widget-todo-list-wrapper">
                </tbody>
            </table>
        </x-card>
    </form>

    @include('stock_out.form_stock_out_sample')
    <x-modal-image-crop />
</x-app-layout>