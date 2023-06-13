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
                    <h2><b>Jurnal UMUM</b></h2>
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
                <?php echo anchor(site_url('sia_transaksi_waringin_h/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            
            
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('sia_transaksi_waringin_h/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('sia_transaksi_waringin_h'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-hover table-condensed" style="margin-bottom: 10px">
            <thead class="thead-light">
                <tr>
                     <th class="text-center" rowspan="2">No</th>
                <th class="text-center" rowspan="2">Tanggal Input</th>
                <th class="text-center" rowspan="2">No Referensi<br>Keterangan</th>
                <th class="text-center" colspan="4">Detail</th>
        		<th class="text-center" rowspan="2">Action</th>
                </tr>
                    <tr>
                        <th class="text-center">No Akun</th>
                        <th class="text-center">Nama Akun</th>
                        <th class="text-center">Debit</th>
                        <th class="text-center">Kredit</th>
                    </tr>

            </thead>
			<tbody><?php
            foreach ($sia_transaksi_waringin_h_data as $sia_transaksi_waringin_h)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $sia_transaksi_waringin_h->tgl_input ?></td>
			<td><?php echo $sia_transaksi_waringin_h->no_ref ?></td>
			<td colspan="4"><?php echo $sia_transaksi_waringin_h->ket ?></td>
           
			<td style="text-align:center" width="200px">
                <a href="#" class="btn btn-outline btn-warning btn-sm" data-toggle="modal" data-target="#dispo" data-idtransaksi_h="<?=$sia_transaksi_waringin_h->id_transaksi?>"
                data-ket="<?=$sia_transaksi_waringin_h->ket?>"
                                                    ><i class="fa fa-key"></i> <b>Create Jurnal</b></a><br>
				<?php 
				echo anchor(site_url('sia_transaksi_waringin_h/update/'.$sia_transaksi_waringin_h->id_transaksi),'<i class="fa fa-wrench"></i> Edit', 'class="btn btn-success btn-xs"');
                echo ' '; 
				echo anchor(site_url('sia_transaksi_waringin_h/delete/'.$sia_transaksi_waringin_h->id_transaksi),'<i class="fa fa-trash"></i> Delete', 'class="btn btn-danger btn-xs"  onclick="javascript: return confirm(\'Yakin hapus data?\')"');
				?>
			</td>
		</tr>
                
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('sia_transaksi_waringin_h/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('sia_transaksi_waringin_h/word'), 'Word', 'class="btn btn-primary"'); ?>
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

<div class="modal fade" id="dispo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3><B>Tambahkan Akun</B></h3>
        <form id="form-dispo">          
          <hr>
          <div class="ibox float-e-margins">
         <div class="ibox-content inspinia-timeline">
           <div class="" id="collapse">

          <div class="form-group">
            <label for="int">Akun <?php echo form_error('id_akun') ?></label>
            <?php 
                  echo form_dropdown('id_akun', get_data_akun(), $id_akun, array('class' => "form-control", 'id' => "id_akun"));?>
          </div>
          <div class="form-group">
           <label for="int" class="col-form-label">jenis Saldo <?php echo form_error('jenis_saldo') ?> </label>
           <?php 
                  echo form_dropdown('jenis_saldo', get_data_kategori('JENIS_PEMBAYARAN'), $jenis_saldo, array('class' => "form-control", 'id' => "jenis_saldo")); ?>
          </div>
          <div class="form-group">
            <label for="int" class="col-form-label">Saldo <?php echo form_error('saldo') ?></label>
            <input type="text" class="form-control" name="saldo" id="saldo" placeholder="Saldo" value="<?php echo $saldo; ?>" />
          </div>
           <div class="form-group">
           <label for="int" class="col-form-label">Penanda <?php echo form_error('penanda') ?> </label>
           <?php 
                  echo form_dropdown('penanda', get_data_kategori('PENANDA'), $penanda, array('class' => "form-control", 'id' => "penanda")); ?>
          </div>
           <input type="hidden" name="idtransaksi_h" id="idtransaksi_h" value="">
                                           
        <div class="form-group">
            <center><button type="button" class="btn btn-danger" data-dismiss="modal" onclick="actionDispo()"><i class="fa fa-key"></i> Simpan</button></center>
          </div>
        </div>
      </div>
    </div>
        <input type="hidden" name="id_penerimaan_detail" id="id_penerimaan_detail" value="">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
      </div>
    </div>
  </div>
</div>
<!-- modal -->
<script src="<?=base_url()?>assets/vendor/sweetalert/js/sweetalert.min.js"></script>
<script type="text/javascript">
  $('#dispo').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var modal = $(this);
  modal.find('.modal-title').html('<h2><b>MASUKAN AKUN ' + button.data('ket')+"</h2>");
  modal.find('.modal-body input#id_akun').val(button.data('id_akun'));
  modal.find('.modal-body input#jenis_saldo').val(button.data('jenis_saldo'));
  modal.find('.modal-body input#saldo').val(button.data('saldo'));
  modal.find('.modal-body input#penanda').val(button.data('penanda'));
  modal.find('.modal-body input#idtransaksi_h').val(button.data('idtransaksi_h'));
  modal.find('.modal-body input#ket').val(button.data('ket'));
});

  function actionDispo(){

    $.ajax({
      url:"<?=base_url()?>sia_transaksi_waringin_h/create_action_ajax",
      type:'POST',
      dataType:"json",
      data: $("#form-dispo").serialize(),
      success:function(data, status){
        swal("Data Sudah Terupdate !!!",data.msg,"success");
        location.reload();
      }
    });
  }

</script>
</body>
</html>
<script src="<?=base_url()?>assets/vendor/sweetalert/js/sweetalert.min.js"></script>