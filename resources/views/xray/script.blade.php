<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    $(document).ready(function() {
        $('[name="type_id"]').change(function() {
            $_this = $(this);
            $_option_selected = $(this).find('option:selected');
            $_price = $_option_selected.data('price');

            $('[name="price"]').val($_price);
        });
    });
</script>