<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?= base_url() ?>assets/vendor/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/paper.min.css">
    <title>Laporan Mutasi Stock</title>
    <style>
        html * {
            font-family: arial;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="paper container-fluid" id="laporan_stock">
        <div class="text-bold">LAPORAN STOCK <?= $header ?></div>
        <div class="text-bold">APOTEK WARINGIN MULYO</div>

        <div class="table-responsive">
            <!-- <div class="text-bold">REKAP STOCK</div> -->
            <table class="table  table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>BARCODE BARANG</th>
                        <th>NAMA BARANG</th>
                        <!-- <th>QTY STOCK AWAL</th>
                        <th>STOCK MASUK</th>
                        <th>STOCK KELUAR</th> -->
                        <th>SALDO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($h as $k => $v) : ?>
                        <?php
                        $stock_in = $v->beli + $v->mutasi_in;
                        $stock_out = $v->jual + $v->mutasi_out;
                        ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $v->barcode ?></td>
                            <td><?= $v->nama ?></td>
                            <td class="text-right">
                                <?= number_format(intVal($v->qty_sawal+$v->beli + $stock_in - $stock_out-$v->jual_bpjs-$v->jual), 0) ?>
                            </td>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </div>
</body>