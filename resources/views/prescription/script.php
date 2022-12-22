<script>
    $(document).ready(function() {
        <?php if (!$is_edit) { ?>
            $('.table-medicine').append($('#sample_prescription').html());
        <?php } ?>
        $('.table-medicine select').each((_i, e) => {
            $(e).select2({
                dropdownAutoWidth: !0,
                width: "100%",
                dropdownParent: $(e).parent()
            });
        });
        $(document).on('click', '.btn-add-medicine', function() {
            $('.table-medicine').append($('#sample_prescription').html());
            $('.table-medicine select').each((_i, e) => {
                $(e).select2({
                    dropdownAutoWidth: !0,
                    width: "100%",
                    dropdownParent: $(e).parent()
                });
            });
        });
        $(document).on('change', '[name="qty[]"], [name="upd[]"], [name="nod[]"]', function() {
            $this_row = $(this).parents('tr');
            $total = bss_number($this_row.find('[name="qty[]"]').val()) *
                bss_number($this_row.find('[name="upd[]"]').val()) *
                bss_number($this_row.find('[name="nod[]"]').val());

            $this_row.find('[name="total[]"]').val(bss_number($total));
        });
    });

    $(document).on('submit', '#form_prescription', function(evt) {
        $('[name^="time_usage_"]').each(function(i, e) {
            if (!$(e).prop('checked')) {
                $(e).val('OFF').prop('checked', true);
            }
        });
    });
</script>