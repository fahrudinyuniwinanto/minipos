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
                    <h2 style="margin-top:0px"><?php echo $button ?> JURNAL UMUM </h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">

             <table class="table">
                
                <tr><td>Tgl Input</td><td><input type="date" class="form-control" name="tgl_input" id="tgl_input" placeholder="Tgl Input" value="<?php echo $tgl_input; ?>" /></td></tr>
                <tr><td>No Reff</td><td><input type="text" class="form-control" name="no_ref" id="no_ref" placeholder="No Reff" value="<?php echo $no_ref; ?>" /></td></tr>
                 <tr><td>Keterangan</td><td><textarea class="form-control" rows="3" name="ket" id="ket" placeholder="Keterangan"><?php echo $ket; ?></textarea></td></tr>
            </table>
	   
	    <div class="form-group hidden">
            <label for="varchar">Created By <?php echo form_error('created_by') ?></label>
            <input type="text" class="form-control" name="created_by" id="created_by" placeholder="Created By" value="<?php echo $created_by; ?>" />
        </div>
	    <div class="form-group hidden">
            <label for="varchar">Update By <?php echo form_error('update_by') ?></label>
            <input type="text" class="form-control" name="update_by" id="update_by" placeholder="Update By" value="<?php echo $update_by; ?>" />
        </div>
	    <div class="form-group hidden">
            <label for="datetime">Created At <?php echo form_error('created_at') ?></label>
            <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
        </div>
	    <div class="form-group hidden">
            <label for="datetime">Update At <?php echo form_error('update_at') ?></label>
            <input type="text" class="form-control" name="update_at" id="update_at" placeholder="Update At" value="<?php echo $update_at; ?>" />
        </div>
	    <div class="form-group hidden">
            <label for="int">Isactive <?php echo form_error('isactive') ?></label>
            <input type="text" class="form-control" name="isactive" id="isactive" placeholder="Isactive" value="<?php echo $isactive; ?>" />
        </div>
	    <input type="hidden" name="id_transaksi" value="<?php echo $id_transaksi; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('sia_transaksi_waringin') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
</html>