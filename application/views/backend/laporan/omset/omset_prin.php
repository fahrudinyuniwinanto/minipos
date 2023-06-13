<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
<style type="text/css">
.table thead td {
    text-align: center;
    font-weight: bold;
    vertical-align: middle !important;
    background-color: #c7ccd0;
}
</style>
<div class="container-fluid" id="laporan_stock">
    <div class="text-bold">OMSET KASIR</div>
    <div class="text-bold">APOTEK WARINGIN MULYO</div>

    <div class="table-responsive">
        <div class="text-bold">TANGGAL <?=date_format(date_create($date1), "d/m/Y")?> s/d
            <?=date_format(date_create($date2), "d/m/Y")?></div>
        <table class="table  table-bordered">
            <thead>
                <tr>
                    <td>NO</td>
                    <td>KASIR</td>
                    <td>NOTA</td>
                    <td>%</td>
                    <td>OMSET</td>
                    <td>%</td>
                    <td>RESEP</td>
                    <td>NON RESEP</td>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
$totalOmset              = 0;
?>
                <?php foreach ($h as $k => $v): ?>
                <tr>
                    <td><?=$i++?></td>
                    <td><?=$v->shift?></td>
                    <td><?=$v->id?></td>
                    <td>%</td>
                    <td class="text-right">
                        <?=number_format($v->omset)?>
                    </td>
                    <td>%</td>
                    <td class="text-right">

                    </td>
                    <td>
                    </td>
                </tr>
                <?php
$totalOmset += $v->omset;
endforeach?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right"><strong><?=number_format($totalOmset)?></strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>


</div>
