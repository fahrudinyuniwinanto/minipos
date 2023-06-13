<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="<?= base_url() ?>assets/vendor/inspinia/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/paper.min.css">
        <title>Laporan Mutasi</title>
        <style>
        html * {
            font-family: arial;
            font-size: 14px;
        }
        </style>
    </head>

    <body>
        <div class="paper container" id="laporan_stock">
            <table style="width: 520">
                <tr>
                    <td width="20%"> <img src="<?= base_url() . '/assets/img/logowar.png' ?>" alt=""></td>
                    <td width="80%">
                        <h3>APOTEK WARINGIN MULYO</h3>
                        Jl. Diponegoro No.26 Temanggung Temanggung Telp: 0293-491019 Fax:0293-491019
                    </td>
                </tr>
            </table>
            <hr style="border: double; overflow: hidden;">
            </hr>

            <div class="table-responsive">
                <div class="text-bold">LAPORAN MUTASI DARI <?=$_GET['cabang']?></div>
                <div class="text-bold">ASAL <?=$_GET['cabang']=='WR001'?'TEMANGGUNG':'TEMBARAK'?> TUJUAN <?=$_GET['cabang']=='WR001'?'TEMBARAK':'TEMANGGUNG'?></div>
                <table class="table table-bordered" id="laporan">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>BULAN</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; 
                    ?>
                        <?php foreach ($h as $k => $v) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= date_format(date_create($v->bulan),"m-Y") ?></td>
                            <td align='right'><?= number_format($v->total) ?></td>
                        </tr>
                        <?php
                         endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>