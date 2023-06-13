<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?= base_url() ?>assets/vendor/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <title>Laporan Detil Penjualan</title>
    <style>
        html * {
            font-family: arial;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="paper container" id="laporan">
        <table style="width: 520">
            <tr>
                <td width="20%"> <img src="<?= base_url() . '/assets/img/logoakasia.png' ?>" style="margin-top: 30px;;" alt=""></td>
                <td width="80%">
                    <h3>POS AKASIA</h3>Satrio Tower Lt.6 Unit 1,
                    Jl. Prof.Dr Satrio Kav.C4,
                    Kuningan – Setiabudi,
                    Jakarta Selatan
                </td>
            </tr>
        </table>
        <hr style="border: double;">
        </hr>
        <div class="table-responsive">
            <div class="text-bold">LAPORAN PENJUALAN</div>
            <div class="text-bold"><?= $header ?></div>
            <table class="table  table-bordered" style="width: 600">
                
                <thead>
                    <tr>
                        <!-- <th>NO</th> -->
                        <th style="text-align:center;">TANGGAL</th>
                        <th style="text-align:center;">JUMLAH TRANSAKSI</th>
                        <th style="text-align:center;">TOTAL</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <?php $i = 1;
                    $grandTotal=0; ?>
                    <?php foreach ($h as $k => $v) : ?>
                        <tr>
                            <td align="center"><?= tanggal_indo($v->tanggal) ?></td>
                            <td align="right"><?= $v->jml_transaksi ?></td>
                            <td align="right"><?= number_format($v->total, 0) ?></td>
                        </tr>
                <?php
            $grandTotal = $grandTotal+$v->total;
            endforeach; ?>
                <tr>
                    <td colspan="2"> <b> SUBTOTAL</b></td>
                    <td align="right"> <b> <?=number_format($grandTotal,0)?></b></td>
                    
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>