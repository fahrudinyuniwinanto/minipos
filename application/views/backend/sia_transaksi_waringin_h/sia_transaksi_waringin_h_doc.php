<!doctype html>
<!--Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode-->
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Sia_transaksi_waringin_h List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Tgl Input</th>
		<th>No Ref</th>
		<th>Ket</th>
		<th>Created By</th>
		<th>Update By</th>
		<th>Created At</th>
		<th>Update At</th>
		<th>Isactive</th>
		
            </tr><?php
            foreach ($sia_transaksi_waringin_h_data as $sia_transaksi_waringin_h)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
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
        </table>
    </body>
</html>