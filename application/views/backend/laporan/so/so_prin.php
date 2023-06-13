<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="<?= base_url() ?>assets/vendor/inspinia/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/paper.min.css">
        <title>Laporan Stock Opname</title>
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
            <hr style="border: double;">
            </hr>

            <div class="table-responsive">
                <div class="text-bold">REKAP STOCK OPNAME</div>
                <div class="text-bold">TANGGAL <?= $date1; ?></div>
                <table class="table table-bordered" id="laporan">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>TANGGAL SO</th>
                            <th>CABANG</th>
                            <th>BARANG</th>
                            <th>QTY SISTEM</th>
                            <!-- <th>QTY FISIK</th> -->
                            <th>QTY SELISIH</th>
                            <th>HARGA SATUAN</th>
                            <th>HARGA SELISIH</th>
                            <th>KETERANGAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; 
                        // wfDebug($h);
                    ?>
                        <?php foreach ($h as $k => $v) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= date_format(date_create($v->tanggal_so),"d-m-Y") ?></td>
                            <td><?= $v->id_cabang ?></td>
                            <td><?= $v->nama ?></td>
                            <td align='right'><?= $v->qty_fisik+$v->qty_selisih ?></td>
                            <!-- <td align='right'><?//= $v->qty_fisik ?></td> -->
                            <td align='right'><?= $v->qty_selisih ?></td>
                            <td align='right'><?= number_format($v->harga) ?></td>
                            <td align='right'><?= number_format($v->harga*$v->qty_selisih) ?></td>
                            <td><?= $v->keterangan ?></td>
                        </tr>
                        <?php
                         endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>