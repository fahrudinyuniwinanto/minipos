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
                    <h2><b>COA AKUN WARINGIN</b></h2>
                    <?php if ($this->session->userdata('message') != '') {?>
                    <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?=$this->session->userdata('message')?> <a class="alert-link" href="#"></a>
                    </div>
                 <?php }?>
                </div>
                <div class="ibox-content">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-8">
                <?php echo anchor(site_url('sia_akun_waringin/create'),'<i class="fa fa-edit"></i> Create', 'class="btn btn-primary"'); ?>
                <button onclick="exportExcel('div1')" class="btn btn-flat btn-warning" type="submit"><i class="fa fa-download"></i> Export Excel</button>
            </div>
            
            
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('sia_akun_waringin/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('sia_akun_waringin'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div id="div1" class="table-responsive">
                        <div class="hidden">
                            <p align="center"><b>COA AKUN WARINGIN</b></p><br><br>
                        </div>
        <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
            <thead class="thead-light">
            <tr>
                <th class="text-center" rowspan="2">No</th>
        		<th class="text-center" rowspan="2">No Akun</th>
        		<th class="text-center" rowspan="2">Nama Akun</th>
                <th class="text-center" rowspan="2">Pos Saldo</th>
                <th class="text-center" rowspan="2">Pos Laporan</th>
                <th class="text-center" colspan="2">Saldo Awal</th>
        		<th class="text-center" rowspan="2">Action</th>
            </tr>
            <tr>
                <th class="text-center">Debit</th>
                <th class="text-center">Kredit</th>
            </thead>
			<tbody><?php
            $totalDebit=0;
                $totalKredit=0;

            foreach ($sia_akun_waringin_data as $sia_akun_waringin)
            {
                ?>
                <tr>
			<td width="80px" class="text-center"><?php echo ++$start ?></td>
			<td><b><?php echo $sia_akun_waringin->no_coa ?></b></td>
			<td><?php echo $sia_akun_waringin->nama_coa ?></td>
            <td class="text-center"><?php echo $sia_akun_waringin->jenis_saldo ?></td>
            <td class="text-center"><?php echo $sia_akun_waringin->jenis_laporan ?></td>
            <td class="text-right"><?php if ($sia_akun_waringin->saldo_debit == "") {
                echo "-";
                }else{
                echo @number_format($sia_akun_waringin->saldo_debit);
                }
                 ?></td>
            <td  class="text-right"><?php if ($sia_akun_waringin->saldo_kredit == "") {
                echo "-";
                }else{
                echo @number_format($sia_akun_waringin->saldo_kredit);
                }
                 ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				//echo anchor(site_url('sia_akun_waringin/read/'.$sia_akun_waringin->id_akun),'<i class="fa fa-search"></i> Detail', 'class="btn btn-warning btn-xs"');
				echo '  '; 
				echo anchor(site_url('sia_akun_waringin/update/'.$sia_akun_waringin->id_akun),'<i class="fa fa-wrench"></i> Edit', 'class="btn btn-success btn-xs"');
				echo '  '; 
				echo anchor(site_url('sia_akun_waringin/delete/'.$sia_akun_waringin->id_akun),'<i class="fa fa-trash"></i> Delete', 'class="btn btn-danger btn-xs"  onclick="javascript: return confirm(\'Yakin hapus data?\')"');
				?>
			</td>
		</tr>
                
                <?php
                $totalDebit+=((int)$sia_akun_waringin->saldo_debit);
                        $totalKredit+=((int)$sia_akun_waringin->saldo_kredit);
            }
            ?>
            <tr>
                <th colspan="5">Total</td>
              
               <td class="text-right"><b><?= @number_format($totalDebit)?></b></td>
               <td class="text-right"><b><?= @number_format($totalKredit)?></b></td>
             </tr>

            </tbody>
        </table>
    </div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		  
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