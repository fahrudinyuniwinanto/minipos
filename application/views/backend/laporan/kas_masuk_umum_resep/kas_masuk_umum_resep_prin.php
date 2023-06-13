<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="<?= base_url() ?>assets/vendor/inspinia/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/paper.min.css">
        <title>Laporan Penjualan PerShift</title>
        <style>
        html * {
            font-family: arial;
            font-size: 14px;
        }
        </style>
    </head>

    <body>
        <div class="paper container-lg" id="laporan">
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
                <div class="text-bold">REKAP KAS MASUK PEMBELI UMUM DAN RESEP</div>
                <div class="text-bold"><?= $header; ?></div>
                <table class="table  table-bordered">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>TANGGAL</th>
                            <th>SHIFT</th>
                            <th>TOTAL UMUM</th>
                            <th>TOTAL MK</th>
                            <th>TOTAL RESEP</th>
                            <th>TOTAL DOKEL</th>
                            <th>LEMBAR UMUM</th>
                            <th>LEMBAR MK</th>
                            <th>LEMBAR RESEP</th>
                            <th>LEMBAR DOKEL</th>
                            <th>R RESEP</th>
                            <th>R DOKEL</th>
                            <th>EMBALASE RESEP</th>
                            <th>EMBALASE DOKEL</th>
                            <th>PPN UMUM</th>
                            <th>PPN RESEP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; 
                    // wfDebug($h);
                    ?>

                        <?php foreach ($h as $k => $v) : ?>
                        <!-- <tr>
                            <td colspan='3'>JUMLAH</td>
                            <td></td>
                        </tr> -->
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= date_format(date_create($v->tanggal),'d-m-Y') ?></td>
                            <td><?= $v->shift ?></td>
                            <td align="right"><?= number_format($v->umum-$v->ppn_umum, 0) ?></td>
                            <td align="right"><?= number_format(($v->mk), 0) ?></td>
                            <td align="right">
                                <?= number_format(($v->resep-$v->racik_resep-$v->embalase_resep-$v->ppn_resep), 0) ?>
                            </td>
                            <td align="right">
                                <?= number_format(($v->dokel-$v->racik_dokel-$v->embalase_dokel), 0) ?>
                            </td>
                            <td align="right"><?= number_format($v->jml_lembar_umum, 0) ?></td>
                            <td align="right"><?= number_format($v->jml_lembar_mk, 0) ?></td>
                            <td align="right"><?= number_format($v->jml_lembar_resep, 0) ?></td>
                            <td align="right"><?= number_format($v->jml_lembar_dokel, 0) ?></td>
                            <td align="right"><?= number_format($v->racik_resep, 0) ?></td>
                            <td align="right"><?= number_format($v->racik_dokel, 0) ?></td>
                            <td align="right"><?= number_format($v->embalase_resep, 0) ?></td>
                            <td align="right"><?= number_format($v->embalase_dokel, 0) ?></td>
                            <td align="right"><?= number_format($v->ppn_umum, 0) ?></td>
                            <td align="right"><?= number_format($v->ppn_resep, 0) ?></td>
                            </td>
                        </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </body>