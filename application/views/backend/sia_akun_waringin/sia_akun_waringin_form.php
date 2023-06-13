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
                    <h2 style="margin-top:0px"><?php echo $button ?> COA Akun</h2>
                </div>
        
        <form action="<?php echo $action; ?>" method="post">
        <div class="ibox-content">
       <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
            <tr><th>No Coa</th><td><input type="text" class="form-control" name="no_coa" id="no_coa" placeholder="No Coa" value="<?php echo $no_coa; ?>"/></td></tr>
            <tr><th>Nama Coa</th><td><input type="text" class="form-control" name="nama_coa" id="nama_coa" placeholder="Nama Coa" value="<?php echo $nama_coa; ?>" /></td></tr>
            <tr><th>Keterangan</th><td><input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" /></td></tr>
            <tr><th>Parent</th><td><?php 
                  echo form_dropdown('parent', get_data_akun(), $parent, array('class' => "form-control", 'id' => "parent"));
            ?></td></tr>
            <tr><th>POS SALDO</th><td><?php 
                  echo form_dropdown('jenis_saldo', get_data_kategori('JENIS_PEMBAYARAN'), $jenis_saldo, array('class' => "form-control", 'id' => "jenis_saldo"));
            ?></td></tr>
            <tr><th>JENIS LAPORAN</th><td><?php 
                  echo form_dropdown('jenis_laporan', get_data_kategori('JENIS_LAPORAN'), $jenis_laporan, array('class' => "form-control", 'id' => "jenis_laporan"));
            ?></td></tr>
            <tr><th>Saldo Awal</th><td>
              
                <input type="number" class="form-control" name="saldo_debit" id="saldo_debit" placeholder=" Masukan Saldo Debit" value="<?php echo $saldo_debit; ?>" />
                <input type="number" class="form-control" name="saldo_kredit" id="saldo_kredit" placeholder="Masukan Saldo Kredit" value="<?php echo $saldo_kredit; ?>" />
            </td></tr>
            <tr><th>Status</th><td><?php 
                  echo form_dropdown('status', get_data_kategori('STATUS'), $status, array('class' => "form-control", 'id' => "status"));
            ?></td></tr>
            <tr><th>Aktif</th><td><?php 
                  echo form_dropdown('isactive', get_data_kategori('AKTIF'), $isactive, array('class' => "form-control", 'id' => "isactive"));
            ?></td></tr>
             <tr hidden=""><th>Query</th><td> <textarea class="form-control" rows="3" name="query" id="daftar" placeholder="Query"><?php echo $query; ?></textarea></td></tr>
       </table>
	    <div class="form-group hidden">
            <label for="varchar">No Coa <?php echo form_error('no_coa') ?></label>
        </div>
	    <div class="form-group hidden">
            <label for="varchar hidden">Nama Coa <?php echo form_error('nama_coa') ?></label>
        </div>
	    <div class="form-group hidden">
            <label for="varchar hidden">Keterangan <?php echo form_error('keterangan') ?></label>
        </div>
	    <div class="form-group hidden">
            <label for="int">Parent <?php echo form_error('parent') ?></label>
        </div>
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
            
        </div>
	    <input type="hidden" name="id_akun" value="<?php echo $id_akun; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('sia_akun_waringin') ?>" class="btn btn-default">Cancel</a>
	</div>
            </form>
        </div>
        </div>
    </body>
</html>