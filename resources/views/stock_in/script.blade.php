<script src="{{ asset('js/dragula.min.js') }}"></script>
<script>
    const item = `<tr class="stock-in-item widget-todo-item"><td class="tw-py-3">${$('#stock-in-new-item').html()}</td></tr>`;
    if ('{{ isset($row) }}'=='') { $('#form-item-container').append(item); }
    redefine()

    function redefine() {
        // Redefine select2 and date-picker
        $('#form-item-container select').each((_i, e) => {
            $(e).select2({
                dropdownAutoWidth: !0,
                width: "100%",
                dropdownParent: $(e).parent()
            });
        });
        $("#form-item-container .date-picker").datetimepicker({
            icons: {
                time: "bx bx-time",
                date: "bx bx-calendar",
                up: "bx bx-chevron-up",
                down: "bx bx-chevron-down",
                previous: "bx bx-chevron-left",
                next: "bx bx-chevron-right",
                today: "bx bx-screenshot",
                clear: "bx bx-trash",
                close: "bx bx-x",
            },
            format: "YYYY-MM-DD",
            showTodayButton: true,
        });
    }

    $(document).on('click', '#btn-add-stock-in', function () {
        $('#form-item-container').append(item);
        redefine();
    });

    function calculateBaseQtyAndTotal($this_row){
        let price = bss_number($this_row.find('.price').val());
        let qty = bss_number($this_row.find('.qty').val());
        let pk_qty = bss_number($this_row.find('select.unit_id option:selected').data('qty'));
        $this_row.find('[name="qty_based[]"],[name="qty_based"]').val(qty * (pk_qty==0 ? 1 : pk_qty));
        $this_row.find('[name="total[]"],[name="total"]').val(qty * price);
    }

    $(document).on('change', '[name="supplier_id[]"],[name="supplier_id"]', function () {
        const $this_row = $(this).closest('table.table-stock-in-item');
        $this_row.find('[name="product_id[]"],[name="product_id"]').html('<option value="">---- None ----</option>');
        $this_row.find('[name="unit_id[]"],[name="unit_id"]').html('<option value="">---- None ----</option>');
        $this_row.find('[name="price[]"],[name="price"]').val('0');
        if ($(this).val() != '') {
            $.ajax({
                url: "{{ route('inventory.supplier.getProduct') }}",
                type: "post",
                data: {
                    id: bss_number($(this).val()),
                },
                success: function (rs) {
                    if (rs.success) {
                        $this_row.find('[name="product_id[]"],[name="product_id"]').html(rs.options);
                    }
                },
                error: function (rs) {
                    flashMsg("danger", 'Error', rs.message)
                },
            })
        }
        calculateBaseQtyAndTotal($this_row);
    });

    $(document).on('change', '[name="product_id[]"],[name="product_id"]', function () {
        const $this_row = $(this).closest('table.table-stock-in-item');
        $this_row.find('[name="unit_id[]"],[name="unit_id"]').html('<option value="">---- None ----</option>');
        // $this_row.find('[name="price[]"],[name="price"]').val('0');
        if ($(this).val() != '') {
            $.ajax({
                url: "{{ route('inventory.product.getUnit') }}",
                type: "post",
                data: {
                    id: bss_number($(this).val()),
                },
                success: function (rs) {
                    if (rs.success) {
                        $this_row.find('[name="unit_id[]"],[name="unit_id"]').html(rs.options);
                        // $this_row.find('[name="price[]"],[name="price"]').val(rs.product.price);
                    }
                },
                error: function (rs) {
                    flashMsg("danger", 'Error', rs.message)
                },
            })
        }
        calculateBaseQtyAndTotal($this_row);
    });

    $(document).on('change', '[name="unit_id[]"],[name="unit_id"]', function () {
        const $this_row = $(this).closest('table.table-stock-in-item');
        calculateBaseQtyAndTotal($this_row);
    });

    $(document).on('keyup', '[name="qty[]"],[name="qty"]', function () {
        const $this_row = $(this).closest('table.table-stock-in-item');
        calculateBaseQtyAndTotal($this_row);
    });

    $(document).on('keyup', '[name="price[]"],[name="price"]', function () {
        const $this_row = $(this).closest('table.table-stock-in-item');
        calculateBaseQtyAndTotal($this_row);
    });

    dragula([document.getElementById("form-item-container")], {
        moves: function (e, o, t) {
            return t.classList.contains("cursor-move");
        },
    });
</script>