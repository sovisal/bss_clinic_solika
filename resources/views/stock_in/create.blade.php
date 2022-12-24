<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{{ route('inventory.stock_in.index') }}" />
    </x-slot>
    <x-slot name="js">
        @include('stock_in.script')
    </x-slot>
    <form action="{{ route('inventory.stock_in.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <x-card bodyClass="pb-0">
            <x-slot name="action">
                <x-form.button type="submit" value="Progress" icon="bx bx-save" label="Save" />
            </x-slot>
            <x-slot name="footer">
                <x-form.button type="submit" value="Progress" icon="bx bx-save" label="Save" />
            </x-slot>
            @include('stock_in.form')
        </x-card>
    </form>

    @include('stock_in.form_stock_in_sample')
    <x-modal-image-crop />
</x-app-layout>