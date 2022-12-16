<script>
    $(document).ready(function() {
        $('[name="type_id"]').change(function() {
            $_this = $(this);
            $_option_selected = $(this).find('option:selected');
            $_price = $_option_selected.data('price');

            $('#price_label').html($_price);
            $('[name="price"]').val($_price);
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