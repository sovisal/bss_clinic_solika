<x-app-layout>
	<x-slot name="header">
        <x-form.button-back href="{{ route('inventory.product_category.index') }}"/>
	</x-slot>
	<form action="{{ route('inventory.product_category.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
		@csrf
		<x-card bodyClass="pb-0">
			<x-slot name="action">
                <x-form.button type="submit" value="Progress" icon="bx bx-save" label="Save" />
			</x-slot>
			<x-slot name="footer">
                <x-form.button type="submit" value="Progress" icon="bx bx-save" label="Save" />
			</x-slot>
			<table class="table-form striped">
                @include('product_category.form')
			</table>
		</x-card>
	</form>

	<x-modal-image-crop />
</x-app-layout>
