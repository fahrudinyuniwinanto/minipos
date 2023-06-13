<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
    * {
        font-size: 10px;
        font-family: 'Times New Roman';
    }

    td,
    th,
    tr,
    table {
        border-top: 1px solid black;
        border-collapse: collapse;
    }

    td.description,
    th.description {
        width: 75px;
        max-width: 75px;
    }

    td.quantity,
    th.quantity {
        width: 25px;
        max-width: 25px;
        word-break: break-all;
    }

    td.price,
    th.price {
        width: 40px;
        max-width: 40px;
        word-break: break-all;
    }

    .centered {
        text-align: center;
        align-content: center;
    }

    .ticket {
        width: 185px;
        max-width: 185px;
    }

    img {
        max-width: inherit;
        width: inherit;
    }

    @media print {

        .hidden-print,
        .hidden-print * {
            display: none !important;
        }
    }
    </style>
    <title>Receipt example</title>
</head>

<body>
    <div class="ticket">
        <!-- <img src="<?=base_url()?>/assets/img/logo.png" alt="Logo"> -->
        <p class="centered">APOTEK WARINGIN MULYO
            <br>jL. Diponegoro No. 26
            <br>Telp: 0293 - 491019
        </p>

        <table>
            <tbody>
                <tr>
                    <td><?=date_format(date_create($h->tanggal), "d/m/Y")?></td>
                    <td><?="Nota: " . $h->id?></td>
                </tr>
                <tr>
                    <td><?=$h->jenis?></td>
                    <td><?="Kasir: " . $h->created_by?></td>
                </tr>
            </tbody>
            <table>
                <thead>
                    <tr>
                        <th class="quantity">Qty</th>
                        <th class="description">Desc</th>
                        <th class="price">Hrg</th>
                        <th class="price">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$grandTotal = 0;
foreach ($d as $k => $v) {
    ?>
                    <tr>
                        <td class="quantity"><?=$v->qty_entry?></td>
                        <td class="description"><?=$v->barang?></td>
                        <td class="price" align="right"><?=number_format($v->harga_satuan)?></td>
                        <td class="price" align="right"><?=number_format($v->harga_satuan * $v->qty_entry)?></td>
                    </tr>
                    <?php
$grandTotal = ($grandTotal + ($v->harga_satuan * $v->qty_entry));
}?>
                    <tr>
                        <td colspan='2'>TOTAL BELANJA</td>
                        <td>:</td>
                        <td><?=number_format($grandTotal)?></td>
                    </tr>
                    <tr>
                        <td colspan='2'>DISCOUNT</td>
                        <td>:</td>
                        <td><?=number_format($grandTotal)?></td>
                    </tr>
                    <tr>
                        <td colspan='2'>PPN (10%)</td>
                        <td>:</td>
                        <td><?=number_format($grandTotal)?></td>
                    </tr>
                    <tr>
                        <td colspan='2'>NETTO</td>
                        <td>:</td>
                        <td><?=number_format($grandTotal)?></td>
                    </tr>

                </tbody>
            </table>
            <p class="centered">TERIMA KASIH ATAS KUNJUNGAN DAN KEPERCAYAAN ANDA
                <br>SEMOGA CEPAT SEMBUH
            </p>
    </div>
</body>

</html>