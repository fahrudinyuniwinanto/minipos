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
                    <h2><b>Neraca Lajur</b></h2>
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
                                <form action="<?php echo site_url('sia_transaksi_waringin/neraca_lajur'); ?>" method="get">
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
                                        <button class="btn btn-primary" type="button" onclick="window.location.href='<?= base_url() ?>sia_transaksi_waringin/neraca_lajur'"><i class="fa fa-refresh"></i> Refresh</button>

                                    </div>
                                </form>
                            </div>
                        </div>
    <div id="div1" class="table-responsive">
                        <div class="hidden">
                            <p align="center"><b>NERACA LAJUR APOTEK WARINGIN</b></p>
                            <p align="center"><b>BULAN : <?php echo @$_GET['thn']; ?></b></p>
                            
                        </div>
                    
    <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
       <thead class="thead-light">
              <tr>
                <th rowspan="2" class="text-center">NO</th>
                
                <th rowspan="2" class="text-center">NO AKUN</th>
                <th rowspan="2" class="text-center">AKUN</th>
                <th rowspan="2" class="text-center">JENIS</th>
                
                <th colspan="2"class="text-center">NERACA SALDO</th>
                <th colspan="2"class="text-center">LABA RUGI</th>
                <th colspan="2"class="text-center">NERACA</th>
              </tr>
              <tr>
                <th class="text-center">DEBIT</th>
                <th class="text-center">KREDIT</th>
                <th class="text-center">DEBIT</th>
                <th class="text-center">KREDIT</th>
                <th class="text-center">DEBIT</th>
                <th class="text-center">KREDIT</th>
              </tr>

            </thead>
            <tbody>
                <?php
                $totalDebit=0;
                $totalKredit=0;
                $totalDebitLabaRugi=0;
                $totalKreditLabaRugi=0;
                $totalDebitNeraca=0;
                $totalKreditNeraca=0;
                 foreach ($sia_transaksi_waringin_data as $sia_transaksi_waringin)
            {
                ?>
                <tr>
                    <td width="80px" class="text-center"><?php echo ++$start ?></td>
                    <td class="text-center"><b><?php echo $sia_transaksi_waringin->no_coa ?></b></td>
                    <td class="text-left"><?php echo $sia_transaksi_waringin->nama_coa ?></td>
                    <td class="text-center"><?php echo $sia_transaksi_waringin->jenis_laporans ?></td>
                   
                        <td class="text-right"><?php echo @number_format($sia_transaksi_waringin->neraca_saldo_debit)?></td>
                        <td class="text-right"><?php echo @number_format($sia_transaksi_waringin->neraca_saldo_kredit) ?></td>

                        <td class="text-right"><?php 
                        if ($sia_transaksi_waringin->jenis_laporan == 24) {
                            echo @number_format($sia_transaksi_waringin->neraca_saldo_debit);
                        }else{
                            echo "0";
                        }
                        ?></td>
                        
                        <td class="text-right"><?php 
                        if ($sia_transaksi_waringin->jenis_laporan == 24) {
                            echo @number_format($sia_transaksi_waringin->neraca_saldo_kredit);
                        }else{
                            echo "0";
                        }?></td>

                        <td class="text-right"><?php 
                        if ($sia_transaksi_waringin->jenis_laporan == 23) {
                            echo @number_format($sia_transaksi_waringin->neraca_saldo_debit);
                        }else{
                            echo "0";
                        }
                        ?></td>
               
                        <td class="text-right"><?php 
                        if ($sia_transaksi_waringin->jenis_laporan == 23) {
                            echo @number_format($sia_transaksi_waringin->neraca_saldo_kredit);
                        }else{
                            echo "0";
                        }?></td>

                </tr>
                        
                        <?php
                        $totalDebit+=($sia_transaksi_waringin->neraca_saldo_debit);
                        $totalKredit+=($sia_transaksi_waringin->neraca_saldo_kredit);
                        $totalDebitLabaRugi+=$sia_transaksi_waringin->jenis_laporan==24?$sia_transaksi_waringin->neraca_saldo_debit:0;
                        $totalKreditLabaRugi+=$sia_transaksi_waringin->jenis_laporan==24?$sia_transaksi_waringin->neraca_saldo_kredit:0;
                        $totalDebitNeraca+=$sia_transaksi_waringin->jenis_laporan==23?$sia_transaksi_waringin->neraca_saldo_debit:0;
                        $totalKreditNeraca+=$sia_transaksi_waringin->jenis_laporan==23?$sia_transaksi_waringin->neraca_saldo_kredit:0;

                      
                        
                    }
                    ?>
              <tr class="warning">
                <h3>
            <th colspan="4">Total</th>
              
               <td class="text-right"><?= @number_format($totalDebit)?></td>
               <td class="text-right"><?= @number_format($totalKredit)?></td>

               <td class="text-right"><?= @number_format($totalDebitLabaRugi)?></td>
               <td class="text-right"><?= @number_format($totalKreditLabaRugi)?></td>

               <td class="text-right"><?= @number_format($totalDebitNeraca)?></td>
               <td class="text-right"><?= @number_format($totalKreditNeraca)?></td>
           </h3>
              </tr>

              <tr class="<?= $totalDebitLabaRugi <= $totalKreditLabaRugi ? 'success' : 'danger' ?>">
                <th colspan="4">Keterangan</td>
               <?if{

               }else{
               }?>
               <td class="text-center" colspan="2"><h3><?= $totalDebitLabaRugi <= $totalKreditLabaRugi ? 'Laba' : 'Rugi' ?></h3></td>
               <td class="text-right"><h4><?= @number_format($totalKreditLabaRugi - $totalDebitLabaRugi)?></h4></td>
               <td class="text-right"></td>
               <td class="text-right"></td>
               <td class="text-right"><h4><?= @number_format($totalKreditNeraca - $totalDebitNeraca)?></h4></td>

              </tr>
            </tbody>
        </table>
       </div>
            
        <div class="row">
            <div class="col-md-6">
		
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