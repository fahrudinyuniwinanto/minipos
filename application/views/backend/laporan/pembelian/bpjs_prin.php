<?php $jenis=$this->input->get('jenis')?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="<?= base_url() ?>assets/vendor/inspinia/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/paper.min.css">
        <title>Laporan Pembelian <?=$jenis?> PerShift</title>
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
                    <td width="20%"> <img src="<?= base_url() . '/assets/img/logowar.png' ?>" alt=""></td>
                    <td width="80%">
                        <h2 style="font-size: 28px;">APOTEK WARINGIN MULYO</h2>
                        <p style="font-size: 20px;">Jl. Diponegoro No.26 Temanggung Temanggung Telp: 0293-491019
                            Fax:0293-491019</p>
                    </td>
                </tr>
            </table>
            <hr style="border: double;">
            </hr>

            <div class="table-responsive">
                <div class="text-bold">REKAP PEMBELIAN <?=strtoupper($jenis)?></div>
                <div class="text-bold"><?= $header; ?></div>
                <table class="table  table-bordered">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>TANGGAL</th>
                            <th>SUPLIER</th>
                            <th>NO FAKTUR</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; 
                        $grandtotal=0;
                    ?>

                        <?php foreach ($h as $k => $v) : ?>
                        <!-- <tr>
                            <td colspan='3'>JUMLAH</td>
                            <td></td>
                        </tr> -->
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= date_format(date_create($v->tanggal),'d-m-Y') ?></td>
                            <td><?= $v->nama_suplier ?></td>
                            <td align="right"><?=$v->no_faktur?></td>
                            <td align="right"><?=number_format($v->total,0)?></td>
                            </td>
                        </tr>
                        <?php
                        $grandtotal=$grandtotal+$v->total;
                         endforeach ?>
                        <tr>
                            <td colspan='4'><strong>JUMLAH</strong></td>
                            <td align="right"><strong><?=number_format($grandtotal,0)?></strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </d iv>
    </body>
