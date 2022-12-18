<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{!! route('setting.labor-item.index', $laborType->id) !!}"/>
    </x-slot>
    <form action="{!! route('setting.labor-item.store', $laborType->id) !!}" method="POST" autocomplete="off">
        @csrf
        <x-card bodyClass="pb-0">
            <x-slot name="action">
                <x-form.button type="submit" icon="bx bx-save" label="Save" />
            </x-slot>
            <x-slot name="footer">
                <x-form.button type="submit" icon="bx bx-save" label="Save" />
            </x-slot>

            <table class="table-form striped">
               @include('labor_item.form')
            </table>
        </x-card>
    </form>
</x-app-layout>