<x-app-layout>
    <x-slot name="header">
        <x-form.button-back href="{{ route('prescription.index') }}"/>
    </x-slot>
    <x-slot name="js">
        <script>
            $(document).ready(function () {
				$('.table-medicine').append($('#sample_prescription').html());
				$('.table-medicine select').each((_i, e) => {
					$(e).select2({
						dropdownAutoWidth: !0,
						width: "100%",
						dropdownParent: $(e).parent()
					});
				});
				$(document).on('click', '.btn-add-medicine', function () {
					$('.table-medicine').append($('#sample_prescription').html());
					$('.table-medicine select').each((_i, e) => {
						$(e).select2({
							dropdownAutoWidth: !0,
							width: "100%",
							dropdownParent: $(e).parent()
						});
					});
				});
				$(document).on('change', '[name="qty[]"], [name="upd[]"], [name="nod[]"]', function () {
					$this_row = $(this).parents('tr');
					$total = 	bss_number($this_row.find('[name="qty[]"]').val()) * 
								bss_number($this_row.find('[name="upd[]"]').val()) * 
								bss_number($this_row.find('[name="nod[]"]').val());

					$this_row.find('[name="total[]"]').val(bss_number($total));
				});
			});

			$(document).on('submit', '#form_prescription', function (evt) {
				$('[name^="time_usage_"]').each(function (i, e) {
					if (!$(e).prop('checked')) {
						$(e).val('OFF').prop('checked', true);
					}
				});
			})
        </script>
    </x-slot>
    <form action="{{ route('prescription.store') }}" method="POST" id="form_prescription" autocomplete="off" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <input type="hidden" name="status" value="1" />
        <x-card bodyClass="pb-0">
            <x-slot name="action">
                <div>
                    <x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-save" label="Save" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <div>
                    <x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-save" label="Save" />
                </div>
            </x-slot>

            @include('prescription.form_input')
            <br>
            @include('prescription.form_medicine')
        
        </x-card>
    </form>
    <div>
        <table id="sample_prescription" class="hidden">
            @include('prescription.form_medicine_sample')
        </table>
    </div>
</x-app-layout>