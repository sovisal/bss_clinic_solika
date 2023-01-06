<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{{ route(($module ?? 'inventory.stock_out') . '.index') }}" />
    </x-slot>
    <x-slot name="js">
        @include('stock_out.script')
    </x-slot>
    <form action="{{ route(($module ?? 'inventory.stock_out') . '.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <x-card bodyClass="pb-0">
            <x-slot name="action">
                <x-form.button type="submit" class="btn-submit" icon="bx bx-save" label="Save" />
            </x-slot>
            <x-slot name="footer">
                <x-form.button type="submit" class="btn-submit" icon="bx bx-save" label="Save" />
            </x-slot>

            <table class="table-form striped">
                <thead>
                    <tr>
                        <th class="tw-bg-gray-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>{{ $title ?? 'Stock Out' }}</div>
                                <div>
                                    <x-form.button href="javascript:void(0)" color="dark" id="btn-add-stock-out" icon="bx bx-plus"
                                        label="Add {{ $title ?? 'Stock Out' }}" />
                                </div>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody id="form-item-container" class="widget-todo-list-wrapper">
                    @foreach (session()->get('stockOuts') ?? [] as $row)
                    <tr>
                        <td>
                            <x-stock-out-form :module="($module ?? 'inventory.stock_out')" :row="$row"/>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </x-card>
    </form>

    @include('stock_out.form_stock_out_sample')
</x-app-layout>