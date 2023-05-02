@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script type="text/javascript">
        $('.addInvoiceItem').on('click', function() {
            addInvoiceItem();
        });
        function addInvoiceItem() {
            var invoiceItem = '<div><div class="form-group row mb-1"><label class="col-sm-2 col-form-label text-end">Description</label><div class="col-sm-9"><input type="text" class="form-control" name="description[]" value="{{ @$achievements->invoiceItem->name }}"placeholder="Enter Name, Ex: Fulan" required></div><div class="col-sm-1"><a href="javascript:;" class="remove link-danger" style="float:right;"><i class="bi-x-circle"></i></a></div></div>'
        $('.invoiceItem').append(invoiceItem);
        };
        $('.remove').live('click', function() {
            $(this).parent().parent().parent().remove();
        });
    </script>
    @endpush