<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?=base_url()?>assets/vendor/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/paper.min.css">
    <title>Laporan Penjualan Resep</title>
    <style>
    html * {
        font-family: arial;
        font-size: 14px;
    }
    </style>
</head>
<body>
<div class="paper container" id="laporan_stock">
    <div class="text-bold">LAPORAN PENJUALAN RESEP RENTANG TANGGAL <?=$date1?> s/d <?=$date2?></div>
    <div class="text-bold">APOTEK WARINGIN MULYO</div>

    <div class="table-responsive">
        <div class="text-bold">REKAP PENJUALAN PEMBELI RESEP</div>
        <table class="table  table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>TANGGAL</th>
                    <th>TOTAL UMUM</th>
                    <th>TOTAL RESEP</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1?>
                <?php foreach ($h as $k => $v): ?>
                    <tr>
                        <td><?=$i++?></td>
                        <td><?=$v->tanggal?></td>
                        <td><?=$v->umum?></td>
                        <td><?=$v->resep?></td>
                        </td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>
</body>