@push('scripts')
    <!-- Push Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.upload-btn', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            Swal.fire({
                title: 'Apakah Anda yakin ingin mengirimkan data pembayaran ini?',
                text: "Pastikan Anda telah memeriksa kembali data yang diinputkan sebelum melakukan pembayaran ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6E11F4',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kirim',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>

<style>
    .swal2-confirm {
        margin-right: 10px;
    }
</style>

@endpush