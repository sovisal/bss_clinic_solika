<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{{ route('inventory.product.index') }}" />
    </x-slot>
    <x-slot name="js">
        @include('product.script')
    </x-slot>
    <form action="{{ route('inventory.product.update', $row->id) }}" method="POST" autocomplete="off">
        @method('PUT')
        @csrf
        <x-card bodyClass="pb-0">
            <x-slot name="action">
                <x-form.button type="submit" icon="bx bx-save" label="Save" />
            </x-slot>
            <x-slot name="footer">
                <x-form.button type="submit" icon="bx bx-save" label="Save" />
            </x-slot>
            
            @include('product.form')
            <br />
            @include('product.form_unit')
            
        </x-card>
    </form>

    <div>
        <table id="sample_unit" class="hidden">
            @include('product.form_unit_sample')
        </table>
    </div>

    <x-modal-image-crop />
</x-app-layout>