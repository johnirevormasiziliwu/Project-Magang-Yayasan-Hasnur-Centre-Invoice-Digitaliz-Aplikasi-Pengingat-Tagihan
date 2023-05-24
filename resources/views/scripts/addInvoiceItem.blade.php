@push('scripts')
    <script>
        // start script untuk form tambah invoice item

        var invoiceItemCount = 0;

        function addInvoiceItem() {
            invoiceItemCount++;

            var invoiceItemHtml = ` 
        <div id="invoice-item-${invoiceItemCount}" class="mt-8"> <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="description" class="form-label fs-4 fw-bold">Keterangan</label>
                            <input type="text" name="invoiceItems[${invoiceItemCount}][description]"
                                class="form-control"
                                placeholder="Masukan Keterangan Tagihan" required>
                        </div>
                        <div class="col-md-4">
                            <label for="stock" class="form-label fs-4 fw-bold">Kuantitas</label>
                            <input type="number" name="invoiceItems[${invoiceItemCount}][stock]" id="invoice-item-${invoiceItemCount}-stock"
                                class="form-control" placeholder="Type here..." required>
                        </div>
                        <div class="col-md-2">
                            <label for="unit" class="form-label fs-4 fw-bold">Pilih Unit</label>
                            <!-- Select -->

                            <select class="form-select fs-5 fw-bold"
                                name="invoiceItems[${invoiceItemCount}][unit]" required>
                                <option value="" style="background: #6e11f4">Unit</option>
                                <option value="pcs" @if (old('unit', @$invoice->unit) == 'pcs') selected @endif>
                                    PCS</option>
                                <option value="jam" @if (old('unit', @$invoice->unit) == 'jam') selected @endif>
                                    Jam</option>
                                <option value="meter" @if (old('unit', @$invoice->unit) == 'meter') selected @endif>
                                    Meter</option>
                                <option value="ls" @if (old('unit', @$invoice->unit) == 'ls') selected @endif>
                                    LS</option>
                            </select>
                            <!-- End Select -->
                            
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="images" class="form-label fs-4 fw-bold">File Tambahan</label>
                            <input type="file" name="invoiceItems[${invoiceItemCount}][images][]" class="form-control" multiple>
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label fs-4 fw-bold">Harga Satuan</label>
                            <input type="number" name="invoiceItems[${invoiceItemCount}][price]"  id="invoice-item-${invoiceItemCount}-price" class="form-control" placeholder="Rp" required>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="nominal" class="form-label fs-4 fw-bold">Nominal</label>
                        <input type="number" name="invoiceItems[${invoiceItemCount}][nominal]" id="invoice-item-${invoiceItemCount}-nominal"  class="form-control" placeholder="Rp">
                    </div>
        </div>
    `;


            $('#invoice-items-container').append(invoiceItemHtml);

            var closeButton = $(
                '<div class="d-flex justify-content-end"><span type="button" class="avatar avatar-xs avatar-danger avatar-circle"><span class="avatar-initials">X</span></span></div>'
            );
            $('#invoice-item-' + invoiceItemCount).prepend(closeButton);

            closeButton.click(function() {
                $(this).parent().remove();
            });

            $('#invoice-item-' + invoiceItemCount + '-stock').on('input', function() {
                var stock = $(this).val();
                var price = $('#invoice-item-' + invoiceItemCount + '-price').val();
                var nominal = stock * price;
                $('#invoice-item-' + invoiceItemCount + '-nominal').val(nominal);
            });

            $('#invoice-item-' + invoiceItemCount + '-price').on('input', function() {
                var stock = $('#invoice-item-' + invoiceItemCount + '-stock').val();
                var price = $(this).val();
                var nominal = stock * price;
                $('#invoice-item-' + invoiceItemCount + '-nominal').val(nominal);
            });





        }
        // end script untuk form tambah invoice item 


        // mengambil data user secara otomatis ketika di select

        const selectElement = document.getElementById('my-select');
        const relatedDataContainer = document.getElementById('related-data-container');


        function getCustomer(id) {
            const addressInput = document.getElementById('address');
            const emailInput = document.getElementById('email');
            const no_handphoneInput = document.getElementById('no_handphone');
            const name_picInput = document.getElementById('name_pic');


            $.ajax({
                type: 'POST',
                url: '{{ route('admin.getCustomer') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function(response) {
                    console.log('success');
                    addressInput.value = response.address
                    emailInput.value = response.email
                    no_handphoneInput.value = response.no_handphone
                    name_picInput.value = response.name_pic
                }
            })
        }
        // end mengambil data user secara otomatis ketika di select


        // star menghitung stock,price dan nominal secara otomatis
        const priceInput = document.getElementById('price');
        const stockInput = document.getElementById('stock');
        const totalPriceInput = document.getElementById('nominal');

        function calculateTotalPrice() {
            const price = parseInt(priceInput.value) || 0;
            const stock = parseInt(stockInput.value) || 0;
            const totalPrice = price * stock;
            totalPriceInput.value = totalPrice;
        }

        priceInput.addEventListener('input', calculateTotalPrice);
        stockInput.addEventListener('input', calculateTotalPrice);

        // end menghitung stock,price dan nominal secara otomatis
    </script>
@endpush
