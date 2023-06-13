<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?=base_url()?>assets/vendor/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/paper.min.css">
    <title>Laporan BARANG</title>
    <style>
    html * {
        font-family: arial;
        font-size: 14px;
    }
    </style>
</head>
<body>
<div class="paper container" id="laporan_stock">
    <div class="text-bold">LAPORAN BARANG <?=$y?></div>
    <div class="text-bold">APOTEK WARINGIN MULYO</div>

    <div class="table-responsive">
        <div class="text-bold">REKAP PENJUALAN</div>
        <table class="table  table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>BARCODE</th>
                    <th>NAMA BARANG</th>
                    <th>JENIS</th>
                    <th>HARGA JUAL</th>
                    <th>SATUAN</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1?>
                <?php foreach ($h as $k => $v): ?>
                <tr>
                    <td align='center'><?=$i++?></td>
                    <td><?=$v->barcode?></td>
                    <td><?=$v->nama?></td>
                    <td align='center'><?=$v->tipe?></td>
                    <td align='right'><?=number_format($v->harga_jual)?></td>
                    <td align='center'><?=$v->id_satuan?></td>
                </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>

</div>
                </body>
