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
                    <h2><b>Jurnal Umum Waringin</b></h2>
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
                             <?php echo anchor(site_url('sia_transaksi_waringin_h/create'),'<i class="fa fa-exchange"> </i> Jurnalkan', 'class="btn btn-success"'); ?>
                             <button onclick="exportExcel('div1')" class="btn btn-flat btn-warning" type="submit"><i class="fa fa-download"></i> Export Excel</button>
                            <div class="row collapse" id="formfilter" style="margin-bottom: 10px;margin-top:10px;">
                                <form action="<?php echo site_url('sia_transaksi_waringin'); ?>" method="get">
                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Kode Akun</label>
                                            <div class="col-sm-10">
                                                <?php
                                                echo form_dropdown('koderek', get_data_akun(), $koderek, array('class' => "form-control", 'id' => "koderek")); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Tanggal</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="tgl" value="<?php echo @$_GET['tgl']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Bulan & Tahun</label>
                                            <div class="col-sm-10">
                                                <input type="month" class="form-control" name="thn" value="<?php echo @$_GET['thn']; ?>">
                                            </div>
                                        </div>

                                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Search</button>
                                        <button class="btn btn-primary" type="button" onclick="window.location.href='<?= base_url() ?>sia_transaksi_waringin'"><i class="fa fa-refresh"></i> Refresh</button>

                                    </div>
                                </form>
                            </div>
        </div>
        <div id="div1" class="table-responsive">
                        <div class="hidden">
                            <p align="center"><b>JURNAL UMUM</b></p><br>
                            <p align="center"><b>TANGGAL : <?php echo @$_GET['tgl']; ?></b></p>
                            <p align="center"><b>BULAN   : <?php echo @$_GET['thn']; ?></b></p>
                        </div>
        <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
            <thead class="thead-light">
            <tr>
                <th class="text-center" rowspan="2">No</th>
		<th class="text-center" rowspan="2">Tanggal Input</th>
        <th class="text-center" rowspan="2">No Referensi<br>Keterangan</th>
        <th class="text-center" rowspan="2">No Akun</th>
        <th class="text-center" rowspan="2" >Nama Akun</th>
		<th class="text-center" rowspan="2">Debit</th>
		<th class="text-center" rowspan="2" >Kredit</th>
		
		<th class="text-center" colspan="2">Action</th>
            </tr>
            <tr>
                <th class="text-center">Akun</th>
                <th class="text-center">Detail REFF</th>
            </tr>
            </thead>
			<tbody><?php
            foreach ($sia_transaksi_waringin_data as $sia_transaksi_waringin)
            {
                ?>
                <tr>
			<td width="80px" class="text-center"><?php echo ++$start ?></td>
            <td class="text-center"><?php echo tanggal_indo($sia_transaksi_waringin->tgl_input) ?></td>
            <td class="text-center" ><?php if ($sia_transaksi_waringin->penanda == 26) {
                echo "";
            }else{
                echo $sia_transaksi_waringin->no_ref ?><br><i><?php echo $sia_transaksi_waringin->ket;
               
            } ?></i></td>
            <td class="text-center"><?php echo $sia_transaksi_waringin->no_coa ?><br><b><i><?php echo $sia_transaksi_waringin->nm_penanda ?></i></b></td>
            <td class="text-left"><?php echo $sia_transaksi_waringin->nama_coa ?> </td>
            <td class="text-center"><?php if ($sia_transaksi_waringin->jenis_saldo == "9" ) {
               echo number_format($sia_transaksi_waringin->saldo); 
            }else{ echo "-";} ?></td>
            <td class="text-center"><?php if ($sia_transaksi_waringin->jenis_saldo == "10" ) {
               echo  number_format($sia_transaksi_waringin->saldo); 
            }else{ echo "-";} ?></td>
		
			
			<td style="text-align:center">
				<?php 
				
				
                echo anchor(site_url('sia_transaksi_waringin/update/'.$sia_transaksi_waringin->id_transaksi),'<i class="fa fa-key"></i> Masukan Akun', 'class="btn btn-primary btn-xs"');
				echo "    ";

                
				?>
			</td>
            <td style="text-align:center" >
                <?php 
               
                if ($sia_transaksi_waringin->penanda == "26") {
                    echo " ";
                }else{
                    echo anchor(site_url('sia_transaksi_waringin_h/update/'.$sia_transaksi_waringin->id_transaksi_h),'<i class="fa fa-edit"></i> Edit REFF', 'class="btn btn-success btn-xs"');
                    echo "<br>";
                     echo anchor(site_url('sia_transaksi_waringin_h/delete/'.$sia_transaksi_waringin->id_transaksi_h),'<i class="fa fa-trash"></i> Delete', 'class="btn btn-danger btn-xs"  onclick="javascript: return confirm(\'Yakin hapus data?\')"'); 
                }
               
                ?>
            </td>
		</tr>
                
                <?php
            }
            ?>
            <tr>
                <th class="text-center" colspan="5"><h3>Total</h3></th>
                <th class="text-center"><h3><?= @$sia_transaksi_waringin->saldo_debit == " " ? '0' : @number_format($sia_transaksi_waringin->saldo_debit)  ?></h3></th>
                <th class="text-center"><h3><?= @$sia_transaksi_waringin->saldo_kredit == " " ? '0' : @number_format($sia_transaksi_waringin->saldo_kredit)  ?></h3></th>
            
            </tr>
            </tbody>
        </table>
    </div>
        <div class="row">
            <div class="col-md-6">
                <!-- <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a> -->
		<?php //echo anchor(site_url('sia_transaksi_waringin/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php //echo anchor(site_url('sia_transaksi_waringin/word'), 'Word', 'class="btn btn-primary"'); ?>
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