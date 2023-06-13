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
                    <h2><b>Buku Besar</b></h2>
                    <?php if ($this->session->userdata('message') != '') {?>
                    <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?=$this->session->userdata('message')?> <a class="alert-link" href="#"></a>
                    </div>
                 <?php }?>
                </div>
                <div class="ibox-content">
        <div class="row" style="margin-bottom: 10px">
                        <div class="ibox-content">
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#formfilter" aria-expanded="false" aria-controls="formfilter">
                                <i class="fa fa-filter"></i> Filter data
                            </button>
                            <button onclick="exportExcel('div1')" class="btn btn-flat btn-warning" type="submit"><i class="fa fa-download"></i> Export Excel</button>
                            <div class="row collapse" id="formfilter" style="margin-bottom: 10px;margin-top:10px;">
                                <form action="<?php echo site_url('sia_transaksi_waringin/buku_besar'); ?>" method="get">
                                    <div class="col-md-8">
                                        <!-- <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Kode Akun</label>
                                            <div class="col-sm-10">
                                                <?php
                                                echo form_dropdown('koderek', get_data_akun(), $koderek, array('class' => "form-control", 'id' => "koderek")); ?>
                                            </div>
                                        </div> -->
                                        <!-- <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Tanggal</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="tgl" value="<?php echo @$_GET['tgl']; ?>">
                                            </div>
                                        </div> -->
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Bulan & Tahun</label>
                                            <div class="col-sm-10">
                                                <input type="month" class="form-control" name="thn" value="<?php echo @$_GET['thn']; ?>">
                                            </div>
                                        </div>

                                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Search</button>
                                        <button class="btn btn-primary" type="button" onclick="window.location.href='<?= base_url() ?>sia_transaksi_waringin/buku_besar'"><i class="fa fa-refresh"></i> Refresh</button>

                                    </div>
                                </form>
                            </div>
                        </div>
    <div id="div1" class="table-responsive">
                        <div class="hidden">
                            <p align="center"><b>BUKU BESAR</b></p><br>
                             <p align="center"><b>BULAN : <?php echo @$_GET['thn']; ?></b></p>
                        </div>
                    
    <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
       <thead class="thead-light">
              <tr>
                <th rowspan="2" class="text-center">NO</th>
                <!-- <th rowspan="2" class="text-center">TANGGAL</th> -->
                <th rowspan="2" class="text-center">NO AKUN</th>
                <th rowspan="2" class="text-center">AKUN</th>
                <!--  <th rowspan="2" class="text-center">KREDIT</th> -->
                <th colspan="2"class="text-center">SALDO</th>
              </tr>
              <tr>
                <th class="text-center">DEBIT</th>
                <th class="text-center">KREDIT</th>
              </tr>
            </thead>
            <tbody>
                <?php
                $totalDebit=0;
                $totalKredit=0;
                 foreach ($sia_transaksi_waringin_data as $sia_transaksi_waringin)
            {
                ?>
                <tr>
                    <td width="80px" class="text-center"><?php echo ++$start ?></td>
                    <td class="text-center"><b><?php echo $sia_transaksi_waringin->no_coa ?></b></td>
                    <td class="text-left"><?php echo $sia_transaksi_waringin->nama_coa ?></td>
                   
                        <td class="text-right"><?php echo @number_format($sia_transaksi_waringin->neraca_saldo_debit)?></td>
                        <td class="text-right"><?php echo @number_format($sia_transaksi_waringin->neraca_saldo_kredit) ?></td>
                </tr>
                        
                        <?php
                        $totalDebit+=($sia_transaksi_waringin->neraca_saldo_debit);
                        $totalKredit+=($sia_transaksi_waringin->neraca_saldo_kredit);
                    }
                    ?>
              <tr>
                <th colspan="3">Total</td>
               <td class="text-right"><?= @number_format($totalDebit)?></td>
               <td class="text-right"><?= @number_format($totalKredit)?></td>
              </tr>
            </tbody>
        </table>
       </div>
            
        <div class="row">
            <div class="col-md-6">
		<?php //echo anchor(site_url('sia_transaksi_waringin/excel'), 'Download Buku Besar', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        </div>
    </div>
    </div>
    </div>
    </body>
</html>