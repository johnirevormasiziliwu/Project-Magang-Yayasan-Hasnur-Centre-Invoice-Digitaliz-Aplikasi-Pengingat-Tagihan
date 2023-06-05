@push('scripts')
    <!-- Push Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            Swal.fire({
                title: 'Apakah Anda yakin menghapus data ini?',
                text: "Data yang telah dihapus tidak bisa dikembalikan lagi",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#9E9E9E',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'swal2-delete-margin',
                    cancelButton: 'swal2-cancel-margin'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>

    <style>
        .swal2-delete-margin {
            margin-right: 10px; /* Jarak antara button Hapus dengan button Batal */
        }

        .swal2-cancel-margin {
            margin-left: 10px; /* Jarak antara button Batal dengan button Hapus */
        }
    </style>
@endpush
