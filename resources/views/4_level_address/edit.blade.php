<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{route('setting.address.index')}}?addr={{ @$addr }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('setting.address.update', $province->_code) }}" method="POST" autocomplete="off">
		@method('PUT')
		@csrf
		<x-card bodyClass="pb-0" :actionShow="false">
			@include('4_level_address.form')

			<x-slot name="footer">
				<x-form.button type="submit" icon="bx bx-save" label="Save" />
			</x-slot>
		</x-card>
	</form>

	<x-modal-image-crop />
</x-app-layout>