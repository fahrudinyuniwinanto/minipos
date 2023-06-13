<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?= base_url() ?>assets/vendor/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/paper.min.css">
    <title>Laporan Kas Masuk</title>
    <style>
        html * {
            font-family: arial;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="paper container" id="laporan_stock">
        <!-- <div class="text-bold">LAPORAN KAS MASUK RENTANG TANGGAL <?= $date1 ?> s/d <?= $date2 ?></div>
        <div class="text-bold">APOTEK WARINGIN MULYO</div> -->
        <table style="width: 520">
            <tr>
                <td width="20%"> <img src="<?= base_url() . '/assets/img/logowar.png' ?>" alt=""></td>
                <td width="80%">
                    <h3>APOTEK WARINGIN MULYO</h3>
                    Jl. Diponegoro No.26 Temanggung Temanggung Telp: 0293-491019 Fax:0293-491019
                </td>
            </tr>
        </table>
        <hr style="border: double;"></hr>
        <div class="table-responsive">
            <div class="text-bold">TAGIHAN BPJS</div>
            <table class="table  table-bordered">

                <thead>
                    <tr>
                        <!-- <th>NO</th> -->
                        <th>NO</th>
                        <th>BULAN</th>
                        <th>TAGIHAN</th>
                        <th>JUMLAH TRANSAKSI</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($h as $k => $v) : ?>
                       
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $v->bulan?></td>
                            <td align="right"><?= number_format($v->total) ?></td>
                            <td align="right"><?= $v->count_transaksi ?></td>
                        </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>