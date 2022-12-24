<script>
    $(document).on('click', '#btn-add-stock-in', function () {
        const item = `<tr class="stock-in-item"><td>${$('#stock-in-new-item').html()}</td></tr>`;
        $('#form-item-container').append(item);
        
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
    });
</script>