@push('scripts')
    <!-- Push Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.confirm-btn', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            Swal.fire({
                title: 'Apakah Anda yakin mengkonfirmasi pembayaran ini ?',
                text: "Setelah mengkonfirmasi pembayaran ini, status invoice akan berubah menjadi paid",
                showCancelButton: true,
                confirmButtonColor: '#6E11F4',
                cancelButtonColor: '#9E9E9E',
                confirmButtonText: 'Konfirmasi',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
