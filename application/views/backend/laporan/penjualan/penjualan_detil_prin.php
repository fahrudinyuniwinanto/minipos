<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?= base_url() ?>assets/vendor/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/css/paper.min.css"> -->
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
        <hr style="border: double;">
        </hr>
        <div class="table-responsive">
            <div class="text-bold">LAPORAN DETIL PENJUALAN</div>
            <div class="text-bold"><?= $header ?></div>
            <table class="table  table-bordered" style="width: 600">
                <colgroup>
                    <col style="width: 150px">
                    <col style="width: 50px">
                    <col style="width: 50px">
                    <col style="width: 50px">
                    <col style="width: 50px">
                    <col style="width: 100px">
                    <col style="width: 50px">
                    <col style="width: 50px">
                    <col style="width: 50px">
                </colgroup>
                <thead>
                    <tr>
                        <!-- <th>NO</th> -->
                        <th style="text-align:center;">TANGGAL</th>
                        <th style="text-align:center;">NO. BUKTI</th>
                        <th style="text-align:center;">CUSTOMER</th>
                        <th style="text-align:center;">SALES</th>
                        <th style="text-align:center;">DISKON</th>
                        <th style="text-align:center;">NAMA BARANG</th>
                        <th style="text-align:center;">QTY</th>
                        <th style="text-align:center;">HARGA</th>
                        <th style="text-align:center;">DISKON/BRG</th>
                        <th style="text-align:center;">JUMLAH</th>
                    </tr>
                    <tr>
                        <!-- <th>NO</th> -->
                        <th style="text-align:center;">1</th>
                        <th style="text-align:center;">2</th>
                        <th style="text-align:center;">3</th>
                        <th style="text-align:center;">4</th>
                        <th style="text-align:center;">5</th>
                        <th style="text-align:center;">6</th>
                        <th style="text-align:center;">7</th>
                        <th style="text-align:center;">8</th>
                        <th style="text-align:center;">9</th>
                        <th style="text-align:center;">10</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($h as $k => $v) : ?>
                        <?php
                        $query = "select jd.qty_entry, jd.total,mb.nama, mb.id_satuan, jd.harga_satuan, jd.total,
                        jd.diskon_rp, diskon_persen
                        from jual_d jd
                        left join m_barang mb on jd.id_barang = mb.id
                        where id_penjualan=$v->id and jd.isactive=1";
                        $jualDetail = $this->db->query($query)->result();

                        $jmlRow = $this->db->query($query)->num_rows() + 1;
                        $totalBarang = $this->db->query("select sum(qty_entry) as total from jual_d where id_penjualan=$v->id and isactive=1")->row();
                        $totalHarga = $this->db->query("select total  from jual_h where id=$v->id and isactive=1")->row();
                        ?>
                        <tr>
                            <!-- <td><?= $i++ ?></td> -->
                            <td rowspan="<? echo $jmlRow ?>"><?= tanggal_indo($v->tanggal) ?></td>
                            <td rowspan="<? echo $jmlRow ?>"><?= $v->no_trs ?></td>
                            <td rowspan="<? echo $jmlRow ?>"><?= $v->jenis ?></td>
                            <td rowspan="<? echo $jmlRow ?>"><?= $v->shift ?></td>
                            <td rowspan="<? echo $jmlRow ?>" align="right"><?= number_format($v->potongan_rp, 0) ?></td>
                            <?php foreach ($jualDetail as $kjd => $vjd) :
                                if ($kjd == 1) { ?>
                                    <td><?= $vjd->nama ?></td>
                                    <td><?= number_format($vjd->qty_entry, 0) . ' ' . $vjd->id_satuan ?></td>
                                    <td align="right"><?= number_format($vjd->harga_satuan, 0) ?></td>
                                    <td align="right"><?= number_format($vjd->diskon_rp, 0) ?></td>
                                    <td align="right"><?= number_format($vjd->total, 0) ?></td>
                                <?php } else {
                                ?>

                        <tr>
                            <td><?= $vjd->nama ?></td>
                            <td><?= number_format($vjd->qty_entry, 0) . ' ' . $vjd->id_satuan ?></td>
                            <td align="right"><?= number_format($vjd->harga_satuan, 0) ?></td>
                            <td align="right"><?= number_format($vjd->diskon_rp, 0) ?></td>
                            <td align="right"><?= number_format($vjd->total, 0) ?></td>
                        </tr>
                    <?php } ?>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5"></td>

                    <!-- <td bgcolor="#c0c0c0" style="border:2px solid #000000;">SUBTOTAL</td> -->
                    <td> <b> SUBTOTAL</b></td>
                    <td align="right"> <b> <?= number_format($totalBarang->total, 0) ?> </b></td>
                    <td></td>
                    <td></td>
                    <td align="right"> <b><?= number_format($totalHarga->total, 0) ?></b></td>

                </tr>
            <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</body>