@props([
    'width' => 200,
    'height' => 200,
    'previewWidth' => 200,
    'previewHeight' => 200,
])

<x-modal id="modal-crop-image" :animated="false">
	<x-slot name="header">
		{{ __('alert.modal.crop_image') }}
	</x-slot>
	<div id="image-cropping" data-width="{{ $width }}" data-height="{{ $height }}" data-prev-width="{{ $previewWidth }}" data-prev-height="{{ $previewHeight }}"></div>
	<x-slot name="footer">
		<x-form.button id="btn-crop-image" :hideLabelOnXS="true" icon="bx bx-crop" label="{{ __('button.crop') }}" />
	</x-slot>
</x-modal>
