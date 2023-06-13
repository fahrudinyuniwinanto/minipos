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
                    <h2><b>List Sia_transaksi_waringin_h</b></h2>
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
               
            </div>
            
            
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('sia_transaksi_waringin_h/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" id="q" value="<?php echo @$_GET['q']; ?>">
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-success" onclick="lookup('<?php echo base_url()?>sia_transaksi_waringin_h/lookup')" >Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
            <thead class="thead-light">
            <tr>
                <th class="text-center">No</th>
		<th class="text-center">Tgl Input</th>
		<th class="text-center">No Ref</th>
		<th class="text-center">Ket</th>
		<th class="text-center">Created By</th>
		<th class="text-center">Update By</th>
		<th class="text-center">Created At</th>
		<th class="text-center">Update At</th>
		<th class="text-center">Isactive</th></tr>
            </thead>
			<tbody><?php
            foreach ($sia_transaksi_waringin_h_data as $sia_transaksi_waringin_h)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $sia_transaksi_waringin_h->tgl_input ?></td>
			<td><?php echo $sia_transaksi_waringin_h->no_ref ?></td>
			<td><?php echo $sia_transaksi_waringin_h->ket ?></td>
			<td><?php echo $sia_transaksi_waringin_h->created_by ?></td>
			<td><?php echo $sia_transaksi_waringin_h->update_by ?></td>
			<td><?php echo $sia_transaksi_waringin_h->created_at ?></td>
			<td><?php echo $sia_transaksi_waringin_h->update_at ?></td>
			<td><?php echo $sia_transaksi_waringin_h->isactive ?></td>
		</tr>
                
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
        </div>
        </div>
    </div>
    </div>
    </div>
    </body>
</html>