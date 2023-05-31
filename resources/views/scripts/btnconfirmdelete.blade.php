<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Mendapatkan referensi ke checkbox "Select All"
        var selectAllCheckbox = $('#select-all');

        // Mendapatkan referensi ke semua checkbox item
        var checkboxItems = $('.checkbox-item');

        // Mendapatkan referensi ke button konfirmasi pembayaran
        var btnConfirm = $('#btn-confirm');

        // Mendapatkan referensi ke button delete
        var btnDelete = $('#btn-delete');

        // Menggunakan event handler untuk checkbox "Select All"
        selectAllCheckbox.on('change', function() {
            // Mengatur status semua checkbox item sesuai dengan status checkbox "Select All"
            checkboxItems.prop('checked', $(this).is(':checked'));

            // Mengatur status button konfirmasi pembayaran berdasarkan jumlah checkbox item yang terceklis
            btnConfirm.prop('disabled', checkboxItems.filter(':checked').length !== 1);

            // Mengatur status button delete berdasarkan jumlah checkbox item yang terceklis
            btnDelete.prop('disabled', checkboxItems.filter(':checked').length === 0);
        });

        // Menggunakan event handler untuk checkbox item
        checkboxItems.on('change', function() {
            // Mengatur status checkbox "Select All" berdasarkan status checkbox item
            selectAllCheckbox.prop('checked', checkboxItems.length === checkboxItems.filter(':checked')
                .length);

            // Mengatur status button konfirmasi pembayaran berdasarkan jumlah checkbox item yang terceklis
            btnConfirm.prop('disabled', checkboxItems.filter(':checked').length !== 1);

            // Mengatur status button delete berdasarkan jumlah checkbox item yang terceklis
            btnDelete.prop('disabled', checkboxItems.filter(':checked').length === 0);
        });
    });

    function setAction(action) {
        $('input[name=action]').val(action);
    }

    // start javascript sumbit filter
    document.getElementById('filter').addEventListener('change', function() {
        this.form.submit();
    });
    // end javascript sumbit filter
</script>
