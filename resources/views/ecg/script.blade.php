<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    $(document).ready(function () {
        $('[name="type"]').change(function () {
            $_this = $(this);
            $_option_selected = $(this).find('option:selected');
            $_amount = $_option_selected.data('price');
            
            $('#amount_label').html($_amount);
            $('[name="amount"]').val($_amount);
        });
    });
    
    $('.btn-submit').click(function (){
        $('[name="status"]').val($(this).val());
    });
</script>