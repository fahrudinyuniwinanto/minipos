<!doctype html>
<!--Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode-->
<html>
    <head>
        <title></title>
    </head>
    <body>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h2 style="margin-top:0px">CETAK LAPORAN PENERIMAAN</h2>
                </div>
        
        <div class="row" style="margin-bottom: 10px">
                        <div class="ibox-content">
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#formfilter" aria-expanded="false" aria-controls="formfilter">
                                <i class="fa fa-filter"></i> Filter data
                            </button>
                            <button onclick="exportExcel('div1')" class="btn btn-flat btn-warning" type="submit"><i class="fa fa-download"></i> Export Excel</button>
                            <div class="row collapse" id="formfilter" style="margin-bottom: 10px;margin-top:10px;">
                                <form action="<?php echo site_url('sia_transaksi_waringin/penerimaan'); ?>" method="get">
                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Bulan & Tahun</label>
                                            <div class="col-sm-10">
                                                <input type="month" class="form-control" name="thn" value="<?php echo @$_GET['thn']; ?>">
                                            </div>
                                        </div>

                                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Search</button>
                                        <button class="btn btn-primary" type="button" onclick="window.location.href='<?= base_url() ?>sia_transaksi_waringin/penerimaan'"><i class="fa fa-refresh"></i> Refresh</button>

                                    </div>
                                </form>
                            </div>
                        </div>
        </div>
        
                       
                    <style type="text/css">
    .tg {
        border-collapse: collapse;
        border-spacing: 0;
    }

    .tg td {
        border-color: black;
        border-style: solid;
        border-width: 1px;
        font-family: Arial, sans-serif;
        font-size: 12px;
        overflow: hidden;
        padding: 3px 5px;
        word-break: normal;
    }

    .tg th {
        border-color: black;
        border-style: solid;
        border-width: 1px;
        font-family: Arial, sans-serif;
        font-size: 12px;
        font-weight: normal;
        overflow: hidden;
        padding: 10px 5px;
        word-break: normal;
    }

    .tg .tg-z4i2 {
        border-color: #ffffff;
        text-align: left;
        vertical-align: middle
    }

    .tg .tg-km2t {
        border-color: #ffffff;
        font-weight: bold;
        text-align: left;
        vertical-align: top
    }

    .tg .tg-zv4m {
        border-color: #ffffff;
        text-align: left;
        vertical-align: top
    }

    .tg .tg-8jgo {
        border-color: #ffffff;
        text-align: center;
        vertical-align: top
    }

    .tg .tg-jm2p {
        border-color: #ffffff;
        font-weight: bold;
        text-align: left;
        text-decoration: underline;
        vertical-align: middle
    }

    .tg .tg-0w69 {
        border-color: #ffffff;
        text-align: right;
        vertical-align: middle
    }

    .tg .tg-v0mg {
        border-color: #ffffff;
        text-align: center;
        vertical-align: middle
    }

    .tg .tg-ung0 {
        border-color: #ffffff;
        font-weight: bold;
        text-align: right;
        vertical-align: middle
    }

    .tg .tg-ofj5 {
        border-color: #ffffff;
        text-align: right;
        vertical-align: top
    }

    .tg .tg-aw21 {
        border-color: #ffffff;
        font-weight: bold;
        text-align: center;
        vertical-align: top
    }

    @media print {
        body {
            width: 21cm;
            height: 33cm;
            margin: 0;
            /* change the margins as you want them to be. */
        }
    }
</style>
<div id="div1" class="table-responsive">
<table class="tg" style="undefined;table-layout: fixed; width: 845px">
    <colgroup>
        <col style="width: 30px">
        <col style="width: 260px">
        <col style="width: 30px">
        <col style="width: 150px">
        <col style="width: 30px">
        <col style="width: 150px">
        <col style="width: 30px">
        <col style="width: 150px">
    </colgroup>
    <tbody>
        <tr>
            <td class="tg-8jgo" colspan="8">LAPORAN</td>
        </tr>
        <tr>
            <td class="tg-8jgo" colspan="8">PENERIMAAN DAN PENGELUARAN KAS<br></td>
        </tr>
        <tr>
            <td class="tg-8jgo" colspan="8">BULAN:</td>
        </tr>
        <tr>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
        </tr>
        <?php 
        $kas = $this->db->query("select sum(saldo) as beban  from sia_transaksi_waringin aa LEFT JOIN sia_akun_waringin cc ON cc.id_akun = aa.id_akun where cc.query = 'KAS'   ")->row();
        $jumlah_penerimaan_manual = $this->db->query("select sum(saldo) as beban  from sia_transaksi_waringin aa LEFT JOIN sia_akun_waringin cc ON cc.id_akun = aa.id_akun where cc.parent = '45'")->row();
        $jumlah_bank = $this->db->query("select sum(saldo) as beban  from sia_transaksi_waringin aa LEFT JOIN sia_akun_waringin cc ON cc.id_akun = aa.id_akun where cc.query = 'BANK'   ")->row();
        $jumlah_diskon = $this->db->query("select sum(saldo) as beban  from sia_transaksi_waringin aa LEFT JOIN sia_akun_waringin cc ON cc.id_akun = aa.id_akun where cc.status = '16' and cc.parent = '44'  ")->row();
         $jumlah_tambahan_modal = $this->db->query("select sum(saldo) as beban  from sia_transaksi_waringin aa LEFT JOIN sia_akun_waringin cc ON cc.id_akun = aa.id_akun where cc.query = 'TAMBAHAN_MODAL'   ")->row();

        $jumlah_penerimaan = ($jumlah_penerimaan_manual->beban) + ($jumlah_bank->beban) +  ($jumlah_diskon->beban) + ($jumlah_tambahan_modal->beban) ;
        $JUMLAH = $jumlah_penerimaan +  ($jumlah_penerimaan_manual->beban) + ($kas->beban);
        //query automatis
        $umum = $this->db->query("SELECT SUM(total) AS penjualan_umum FROM jual_h WHERE isactive=1 AND jenis='UMUM' AND LEFT(tanggal,7)='2022-10'  ")->row();
        $MK = $this->db->query("SELECT SUM(total) AS penjualan_mk FROM jual_h WHERE isactive=1 AND jenis='MK' AND LEFT(tanggal,7)='2022-10' ")->row();
        ?>
        <tr>
            <td class="tg-zv4m" colspan="2"> Saldo Kas : (Awal Bulan )</td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2">Rp. </td>
            <td class="tg-z4i2"> <?php echo @format_rupiah_execl($kas->beban) ?></td>
        </tr>
        <tr>
            <td class="tg-zv4m" colspan="2"> Penerimaan Kas :</td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2">Rp. </td>
            <td class="tg-v0mg"><?php echo @format_rupiah_execl($jumlah_penerimaan_manual->beban) ?></td>
            <td class="tg-z4i2"></td>
            <td class="tg-zv4m"> </td>
        </tr>

        <?php
            foreach ($trx5 as $k =>$trx5) {
        ?>
        <tr>
            <td class="tg-z4i2"></td>
            <td class="tg-zv4m"> a. <?php echo $trx5->nama_coa ?></td>
            <td class="tg-z4i2">Rp. </td>
            <td class="tg-v0mg"> <?php echo @format_rupiah_execl($trx5->beban) ?></td>
            <td class="tg-z4i2"></td>
            <td class="tg-v0mg"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
        </tr>
        <?php } ?>

        
        <!-- //auto 
        <tr>
            <td class="tg-z4i2">1</td>
            <td class="tg-zv4m"> a. Penerimaan penjualan&nbsp;&nbsp;&nbsp;obat umum</td>
            <td class="tg-z4i2">Rp.</td>
            <td class="tg-z4i2"> <?php echo @format_rupiah($umum->penjualan_umum) ?></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
        </tr>
        <tr>
            <td class="tg-z4i2"></td>
            <td class="tg-zv4m"> b. Penerimaan MK</td>
            <td class="tg-z4i2">Rp.</td>
            <td class="tg-v0mg"> <?php echo $MK->penjualan_mk ?></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
        </tr>
        <tr>
            <td class="tg-z4i2"></td>
            <td class="tg-zv4m"> c. Penerimaan BPJS</td>
            <td class="tg-z4i2">Rp.</td>
            <td class="tg-v0mg">MASIH PERLU DITANYAKAN</td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
        </tr> -->
        

        <tr>
            <td class="tg-z4i2">2</td>
            <td class="tg-zv4m"> Bank :</td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
        </tr>
        <?php
            foreach ($trx as $k =>$trx) {
        ?>
        <tr>
            <td class="tg-z4i2"></td>
            <td class="tg-zv4m"> a. <?php echo $trx->nama_coa ?></td>
            <td class="tg-z4i2"></td>
            <td class="tg-v0mg"></td>
            <td class="tg-z4i2">Rp. </td>
            <td class="tg-v0mg"> <?php echo @format_rupiah_execl($trx->beban) ?></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
        </tr>
        <?php } ?>
        <tr>
            <td class="tg-z4i2">3</td>
            <td class="tg-zv4m"> Potongan Pembelian :</td>
            <td class="tg-z4i2"></td>
            <td class="tg-v0mg"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-v0mg"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
        </tr>
        <?php
            foreach ($trx2 as $k =>$trx2) {
        ?>
        <tr>
            <td class="tg-z4i2"></td>
            <td class="tg-zv4m"> a. <?php echo $trx2->nama_coa ?></td>
            <td class="tg-z4i2"></td>
            <td class="tg-v0mg"></td>
            <td class="tg-z4i2">Rp. </td>
            <td class="tg-v0mg"> <?php echo @format_rupiah_execl($trx2->beban) ?></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
        </tr>
        <?php } ?>

         <?php
            foreach ($trx6 as $k =>$trx6) {
        ?>
        <tr>
            <td class="tg-z4i2"></td>
            <td class="tg-zv4m"> a. <?php echo $trx6->nama_coa ?></td>
            <td class="tg-z4i2"></td>
            <td class="tg-v0mg"></td>
            <td class="tg-z4i2">Rp. </td>
            <td class="tg-v0mg"> <?php echo @format_rupiah_execl($trx6->beban) ?></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
        </tr>
        <?php } ?>
    
        <tr>
            <td class="tg-z4i2"></td>
            <td class="tg-0w69">Jumlah Penerimaan</td>
            <td class="tg-0w69"></td>
            <td class="tg-0w69"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-zv4m"> Rp. </td>
            <td class="tg-zv4m"> <?php echo @format_rupiah_execl($jumlah_penerimaan) ?> </td>
        </tr>
        <tr>
            <td class="tg-z4i2"></td>
            <td class="tg-ung0">J U M L A H</td>
            <td class="tg-ung0"></td>
            <td class="tg-ung0"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-zv4m"> Rp. </td>
            <td class="tg-zv4m"> <?php echo @format_rupiah_execl($JUMLAH) ?> </td>
        </tr>
        <tr>
            <td class="tg-z4i2"></td>
            <td class="tg-ung0"></td>
            <td class="tg-ung0"></td>
            <td class="tg-ung0"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
        </tr>
        <?php 
         $jumlah_pengeluaran_beban = $this->db->query("select sum(saldo) as beban  from sia_transaksi_waringin aa LEFT JOIN sia_akun_waringin cc ON cc.id_akun = aa.id_akun where cc.query = 'BEBAN'")->row();
         $jumlah_pengeluaran_modal = $this->db->query("select sum(saldo) as beban  from sia_transaksi_waringin aa LEFT JOIN sia_akun_waringin cc ON cc.id_akun = aa.id_akun where cc.query = 'MODAL'")->row();
         $jumlah_pengeluaran_all = ($jumlah_pengeluaran_beban->beban) + (($jumlah_pengeluaran_modal->beban))
         ?>
        <tr>
            <td class="tg-km2t" colspan="2"> Pengeluaran Kas :</td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
        </tr>
        <?php
            foreach ($trx3 as $k =>$trx3) {
        ?>
        <tr>
            <td class="tg-z4i2"></td>
            <td class="tg-zv4m"> a. <?php echo $trx3->nama_coa ?></td>
            <td class="tg-z4i2"></td>
            <td class="tg-v0mg"></td>
            <td class="tg-z4i2">Rp. </td>
            <td class="tg-v0mg"> <?php echo @format_rupiah_execl($trx3->beban) ?></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
        </tr>
        <?php } ?>

        <?php
            foreach ($trx4 as $k =>$trx4) {
        ?>
        <tr>
            <td class="tg-z4i2">18</td>
            <td class="tg-zv4m"> a. <?php echo $trx4->nama_coa ?></td>
            <td class="tg-z4i2"></td>
            <td class="tg-v0mg"></td>
            <td class="tg-z4i2">Rp. </td>
            <td class="tg-v0mg"> <?php echo @format_rupiah_execl($trx4->beban) ?></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
        </tr>
        <?php } ?>

       
        <tr>
            <td class="tg-z4i2"></td>
            <td class="tg-ung0">Jumlah Pengeluaran</td>
            <td class="tg-ung0"></td>
            <td class="tg-ung0"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-zv4m"> Rp. </td>
            <td class="tg-zv4m"> <?php echo @format_rupiah_execl($jumlah_pengeluaran_all) ?> </td>
        </tr>
        <tr>
            <td class="tg-z4i2"></td>
            <td class="tg-ung0">Saldo</td>
            <td class="tg-ung0"></td>
            <td class="tg-ung0"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-zv4m"> Rp. </td>
            <td class="tg-zv4m"> <?php echo @format_rupiah_execl($JUMLAH - $jumlah_pengeluaran_all) ?></td>
        </tr>
        <tr>
            <td class="tg-z4i2"></td>
            <td class="tg-0w69"></td>
            <td class="tg-0w69"></td>
            <td class="tg-0w69"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
        </tr>
        <tr>
            <td class="tg-z4i2"></td>
            <td class="tg-0w69">-Setor Bank Jateng….........................</td>
            <td class="tg-ofj5"> Rp.</td>
            <td class="tg-0w69">TUNGGU KONFIRMASI</td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
        </tr>
        <tr>
            <td class="tg-z4i2"></td>
            <td class="tg-0w69">-Setor BKK Temanggung………………</td>
            <td class="tg-ofj5"> Rp.</td>
            <td class="tg-0w69">TUNGGU KONFIRMASI</td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
        </tr>
        <tr>
            <td class="tg-z4i2"></td>
            <td class="tg-0w69">-Setor Bank BRI.......…......................</td>
            <td class="tg-ofj5"> Rp.</td>
            <td class="tg-0w69">TUNGGU KONFIRMASI</td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
        </tr>
        <tr>
            <td class="tg-jm2p"></td>
            <td class="tg-ung0">-Kas Ditangan…....................</td>
            <td class="tg-ofj5"> Rp.</td>
            <td class="tg-aw21"> &nbsp;&nbsp;&nbsp;-TUNGGU KONFIRMASI </td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
            <td class="tg-z4i2"></td>
        </tr>
        <tr>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
        </tr>
        <tr>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-8jgo"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
        </tr>
        <tr>
            <td class="tg-zv4m"></td>
            <td class="tg-8jgo">Mengetahui</td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-8jgo" colspan="3">Temanggung, .........................<br></td>
        </tr>
        <tr>
            <td class="tg-zv4m"></td>
            <td class="tg-8jgo">Direktur<br></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-8jgo" colspan="3">Bagian Kas dan Pembukuan<br></td>
        </tr>
        <tr>
            <td class="tg-zv4m" colspan="8"></td>

        </tr>
        <tr>
            <td class="tg-zv4m" colspan="8"></td>

        </tr>
        <tr>
            <td class="tg-zv4m" colspan="8"></td>

        </tr>
        <tr>
            <td class="tg-zv4m" colspan="8"></td>

        </tr>
        <tr>
            <td class="tg-zv4m" colspan="8"></td>

        </tr>
        <tr>
            <td class="tg-zv4m" colspan="8"></td>

        </tr>
        <tr>
            <td class="tg-zv4m" colspan="8"></td>

        </tr>
        <tr>
            <td class="tg-zv4m" colspan="8"></td>

        </tr>
        <tr>
            <td class="tg-zv4m" colspan="8"></td>

        </tr>

        <tr>
            <td class="tg-zv4m"></td>
            <td class="tg-8jgo"><?= data_app('DIREKTUR') ?></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-8jgo" colspan="3"><?= data_app('BAG_KAS') ?></td>
        </tr>
        <tr>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
        </tr>
        <tr>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
            <td class="tg-zv4m"></td>
        </tr>
    </tbody>
</table>
</div>
    </div>

</div>
</div>
</div>
</body>
</html>
