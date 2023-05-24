<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tagihan Invoice {{ $invoice->customer->name_unit }}</title>
</head>

<style>
    .body {
        font-family: "Bookman Old Style", serif;
    }

    .unpaid {
        text-align: right;
        font-weight: bold;
        font-size: 30px;
        margin-bottom: 20px;
        text-decoration: underline;
        color: red;
        text-decoration-color: black;
    }

    .paid {
        text-align: right;
        font-weight: bold;
        font-size: 30px;
        margin-bottom: 20px;
        text-decoration: underline;
        color: green;
        text-decoration-color: black;
    }

    .processing {
        text-align: right;
        font-weight: bold;
        font-size: 30px;
        margin-bottom: 20px;
        text-decoration: underline;
        color: orange;
        text-decoration-color: black;
    }

    .invoice {
        text-align: center;
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 20px;
        letter-spacing: 5px;
        text-decoration: underline;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 5px;
        border: 1px solid black;
    }

    .header {
        text-align: center;
        font-weight: bold;
        font-size: 24px;
        padding: 10px;
    }

    .address {
        width: 350px;
    }

    .title {
        font-weight: bold;
        font-size: 18px;
        padding: 10px 0;
    }

    .dokumen_pendukung {
        text-align: center;
    }

    .keterangan th {
        font-weight: 900;
        text-align: center;
    }

    .subtotal {
        height: 80px;
        position: relative;
        font-weight: 900;
    }

    .subtotal p {
        position: absolute;
        top: 50%;
        right: 0;
        transform: translate(0, -50%);
        margin: 0;
        padding-right: 5px;
        font-weight: 900;
    }

    .total {
        text-align: center;
        font-weight: bold;
    }

    .terbilang {
        font-family: "Bookman Old Style", serif;
        ;

    }


    .note {
        font-size: 12px;
    }
</style>


<?php
function terbilang($angka)
{
    $angka = abs($angka);
    $huruf = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];
    $terbilang = '';
    if ($angka < 12) {
        $terbilang = ' ' . $huruf[$angka];
    } elseif ($angka < 20) {
        $terbilang = terbilang($angka - 10) . ' Belas';
    } elseif ($angka < 100) {
        $terbilang = terbilang($angka / 10) . ' Puluh' . terbilang($angka % 10);
    } elseif ($angka < 200) {
        $terbilang = ' Seratus' . terbilang($angka - 100);
    } elseif ($angka < 1000) {
        $terbilang = terbilang($angka / 100) . ' Ratus' . terbilang($angka % 100);
    } elseif ($angka < 2000) {
        $terbilang = ' Seribu' . terbilang($angka - 1000);
    } elseif ($angka < 1000000) {
        $terbilang = terbilang($angka / 1000) . ' Ribu' . terbilang($angka % 1000);
    } elseif ($angka < 1000000000) {
        $terbilang = terbilang($angka / 1000000) . ' Juta' . terbilang($angka % 1000000);
    } elseif ($angka < 1000000000000) {
        $terbilang = terbilang($angka / 1000000000) . ' Miliar' . terbilang(fmod($angka, 1000000000));
    } elseif ($angka < 1000000000000000) {
        $terbilang = terbilang($angka / 1000000000000) . ' Triliun' . terbilang(fmod($angka, 1000000000000));
    }
    return $terbilang;
}

$invoiceItems = $invoice->invoiceItems;
$total = 0;
foreach ($invoiceItems as $invoiceitem) {
    $total += $invoiceitem->nominal;
}

$terbilang = terbilang($total);
?>


<body>

    @php($total = 0)
    @if ($invoice->is_paid == false && $invoice->payment_receipt == null)
        <div class="unpaid">UNPAID</div>
    @elseif($invoice->is_paid == true)
        <div class="paid">PAID</div>
    @else
        <div class="processing">PROCESSING</div>
    @endif


    <div class="invoice">INVOICE</div>

    <table>

        <tr>
            <td rowspan="3">
                <p class="mt-3">Kepada :</p>
                <h3 class="name_unit">{{ $invoice->customer->name_unit }}</h3>
                <p class="address">{{ $invoice->customer->address }}</p>
                <p class="mt-5 mb-5">UP: Bagian Keuangan</p>
            </td>
            <td colspan="5">
                No Invoice: {{ $invoice->invoice_number }} <br>
                Tanggal Invoice: {{ $invoice->invoice_date }} <br>
                Tanggal Jatuh Tempo: {{ $invoice->due_date }} <br>
            </td>
        </tr>
        <tr>
            <td colspan="5" class="dokumen_pendukung">Dokumen Pendukung</td>
        </tr>
        <tr>
            <td colspan="3">Dokumen : <br> {{ $invoice->title }}</td>
            <td colspan="2">Tanggal : {{ $invoice->invoice_date }}</td>
        </tr>
        <tr class="keterangan">
            <th style="width: 25%;" colspan="3">Uraian</th>
            <th style="width: 25%;">Kuantitas</th>
            <th style="width: 50%;">Harga (Rp)</th>
            <th style="width: 50%;">Jumlah (Rp)</th>
        </tr>

        @php($total = 0)
        @foreach ($invoice->invoiceItems as $invoiceitem)
            <tr>
                <td colspan="3">{{ $invoiceitem->description }}</td>
                <td class="text-center">{{ $invoiceitem->stock }}</td>
                <td class="text-center">{{ \App\Helper\Util::rupiah($invoiceitem->price) }}</td>
                <td class="text-center">{{ \App\Helper\Util::rupiah($invoiceitem->nominal) }}</td>
            </tr>
            @php($total += $invoiceitem->nominal)
        @endforeach
        <tr>
            <td class="subtotal" colspan="6">TOTAL
                <p style="">{{ \App\Helper\Util::rupiah($total) }}</p>

            </td>
        </tr>


        <tr>
            <td colspan="6" class="terbilang">
                <p>TERBILANG</p><br>
                <p style="text-align: center; padding-top: 20px;"><?php echo $terbilang; ?> Rupiah</p>
            </td>
        </tr>
    </table>


    Note:<br>
    1. Pembayaran ini mohon ditransfer ke rekening:<br>
    &nbsp;&nbsp;&nbsp;&nbsp;Bank Mandiri Kayutangi<br>
    &nbsp;&nbsp;&nbsp;&nbsp;No. Rek. 031 00 404 78888<br>
    &nbsp;&nbsp;&nbsp;&nbsp;a/n. Yayasan Hasnur Centre<br>
    2. Mohon mencantumkan nama perusahaan anda dan no.invoice saat mentransfer
    pembayaran.<br>
    3. Bukti pembayaran (bukti transfer) harap di email ke siti.aisyah@hasnurgroup.com<br>
    <br>
    YAYASAN HASNUR CENTRE
    <br><br>
    Yani Hadiyani<br>
    Finance Manager




</body>


</html>
