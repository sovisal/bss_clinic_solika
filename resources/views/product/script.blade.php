<script>
    $(document).ready(function() {
        <?php if (!$is_edit) { ?>
            $('.table-unit').append($('#sample_unit').html());
        <?php } ?>
        $('.table-unit select').each((_i, e) => {
            $(e).select2({
                dropdownAutoWidth: !0,
                width: "100%",
                dropdownParent: $(e).parent()
            });
        });
        $(document).on('click', '.btn-add-package', function() {
            $('.table-unit').append($('#sample_unit').html());
            $('.table-unit select').each((_i, e) => {
                $(e).select2({
                    dropdownAutoWidth: !0,
                    width: "100%",
                    dropdownParent: $(e).parent()
                });
            });
        });
    });
</script>