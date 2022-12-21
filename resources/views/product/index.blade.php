<x-app-layout>
    <x-slot name="header">
        <x-form.button href="{{ route('inventory.product.create') }}" icon="bx bx-plus" label="Create" />
    </x-slot>
    <x-card :foot="false" :head="false">
        <x-table class="table-hover table-striped" id="datatables">
            <x-slot name="thead">
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Usage</th>
                    <th>Price</th>
                    <th>Modify at</th>
                    <th>Modify by</th>
                    <th>Action</th>
                </tr>
            </x-slot>
            @foreach($rows as $row)

            @endforeach
        </x-table>
    </x-card>
    <x-modal-confirm-delete />
</x-app-layout>