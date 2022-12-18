<script>
$(document).ready(function () {
    // Labor
    $('.labor_row').hide();
    $(document).on('change', '.btnCheckRow', function () {
        $this_row = $(this).parents('tr.labor_row');
        $this_row.find('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
    });
    $(document).on('change', '#btnShowRow', function () {
        $('.labor_row_' + $(this).val()).show();
        $('.labor_rows_of_' + $(this).val()).show();
    });
    $(document).on('click', '.btnHideRow', function () {
        $this_row = $(this).parents('tr.labor_row');
        $this_row.find('input[type="checkbox"]').prop('checked', false);
        $this_row.hide();
    });
    
    $('[name="type"]').change(function () {
        $_this = $(this);
        $_option_selected = $(this).find('option:selected');
        $_amount = $_option_selected.data('price');
        
        $('#amount_label').html($_amount);
        $('[name="amount"]').val($_amount);
    });
});
</script>