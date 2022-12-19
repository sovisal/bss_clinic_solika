<script>
    $(document).ready(function () {
        calculate_total_table();
        $(document).on('click', '#btn_add_service', append_render_service);
        $(document).on('change', '[name*="qty"], [name*="price"]', calculate_total_row);
        $(document).on('change', 'input[name$="[chk]"]', calculate_total_table);
        $(document).on('click', '.btn_delete_row', item_delete_row);
        
        $(document).on('change', '[name="service_id[]"]', function () {
            let selected = $(this).find(":selected");
            $(this).parents('tr').find('[name="service_name[]"]').val(selected.data('name'));
            $(this).parents('tr').find('[name="price[]"]').val(bss_number(selected.data('price'))).trigger('change');
            $(this).parents('tr').find('[name="description[]"]').val(selected.data('description'));
        });

        $(document).on('change', '[name="patient_id"]', function () {
            let selected = $(this).find(":selected");
            $('[name="pt_code"]').val(selected.data('pt_code'));
            $('[name="pt_gender"]').val(selected.data('gender')).trigger('change');
            $('[name="pt_age"]').val(selected.data('age'));
        });

        $('.btn-submit').click(function (){
            $('[name="status"]').val($(this).val());
        });

        function append_render_service() {
            $('#table_service_result').append($('#sample_service_row').html()).find('select').each((_i, e) => {
                $(e).select2({
                    dropdownAutoWidth: !0,
                    width: "100%",
                    dropdownParent: $(e).parent()
                });
            });
        }

        function calculate_total_row () {
            let tr = $(this).parents('tr');
            let total = bss_number(tr.find('[name*="qty"]').val()) * bss_number(tr.find('[name*="price"]').val());
            tr.find('[name*="total"]').val(bss_number(total));
            calculate_total_table();
        }

        function calculate_total_table () {
            var total = 0;
            $("[name*='total[]']").each(function() {
                total = bss_number(total * 1 + bss_number($(this).val()) * 1);
            });

            $('input[name$="[chk]"]:checked').parents('tr').find("[name*='total']").each(function() {
                total = bss_number(total * 1 + bss_number($(this).val()) * 1);
            });

            $('#table_sub_total').html(total + ' USD');
        }

        $(document).on('keyup', 'select[name="service_id[]"] + span + span input.select2-search__field', function(e) {
            if(e.keyCode === 13) {
                let current_select = $(this);
                if (current_select.val()) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    let name = current_select.val();
                    let price = prompt('please input service price : ', 0);
                    if (price) {
                        $.ajax({
                            url: window.route_service,
                            type: 'POST',
                            data: {
                                _token : CSRF_TOKEN,
                                name : name,
                                price : price
                            },
                            dataType: 'JSON',
                            success: function (data) { 
                                if (data.id) {
                                    let newOption = new Option(name, data.id, false, false);
                                    newOption.setAttribute('data-name', name);
                                    newOption.setAttribute('data-price', price);
                                    $('select[name="service_id[]"').append(newOption);
                                    current_select.closest('tr').find('select[name="service_id[]"]').val(data.id).trigger('change');
                                }
                            }
                        }); 
                    } else {
                        alert('New service was not created!');
                    }
                }
            }
        });

        function item_delete_row () {
            $(this).parents('tr').remove();
            calculate_total_table();
        }
    });

    // Item para clinic check all
    function item_check_all () {
        let el = $('input[name$="[chk]"]');
        let el_checked = $('input[name$="[chk]"]:checked');
        el.prop('checked', el.length > el_checked.length);

        $('input[name$="[chk]"]').trigger('change');
    }
</script>