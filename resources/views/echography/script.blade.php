<script>
    $(document).ready(function() {
        $('[name="type"]').change(function() {
            $_this = $(this);
            $_option_selected = $(this).find('option:selected');
            $_amount = $_option_selected.data('price');

            $('#amount_label').html($_amount);
            $('[name="amount"]').val($_amount);
        });
    });

    const swalWithBootstrapBtns = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-danger tw-ml-1",
            cancelButton: "btn btn-light tw-mr-1",
        },
        buttonsStyling: false,
    });

    $('.btn-submit').click(function() {
        $('[name="status"]').val($(this).val());
    });
</script>