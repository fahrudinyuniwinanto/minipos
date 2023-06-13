<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
        * {
            font-size: 10px;
            font-family: 'Times New Roman';
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        td.description,
        th.description {
            width: 95px;
            max-width: 95px;
        }

        td.quantity,
        th.quantity {
            width: 20px;
            max-width: 20px;
            word-break: break-all;
        }

        td.price,
        th.price {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 155px;
            max-width: 155px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        @media print {

            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }
        </style>
        <title>Nota Pembelian</title>
    </head>

    <body>
        <div class="ticket">
            <p class="centered">APOTIK WARINGIN MULYO
                <br>Jl. Diponegoro No. 26
                <br>Telp: 0293 - 491019
            </p>
            <table style="width:100%">
                <?php if($h->jenis=='RESEP'): ?>
                <tr>
                    <td class="" colspan="2">
                        CUST: <?=$this->db->get_where('m_customer',['id'=>$h->id_customer])->row()->nama?></td>
                </tr>
                <?php endif ?>

                <tr>
                    <td class="">NOTA: <?=$h->no_trs?></td>
                    <td class=""><?=$h->jenis?></td>
                </tr>
                <tr>
                    <td class=""><?=date_format(date_create($h->tanggal),"d/m/Y")?></td>
                    <td class="">Ksr: <?=$h->shift?></td>
                </tr>
            </table>
            <table style="width:100%">
                <thead>
                    <tr>
                        <th class="quantity">Qty</th>
                        <th class="description">Desc</th>
                        <th class="price" colspan="2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$grandTotal = 0;
foreach ($d as $k => $v) {
    ?>
                    <tr>
                        <td class="quantity"><?=$v->qty_entry?></td>
                        <td class="description">
                            <?=$v->barang?><?=($v->diskon_persen!=0)?" #Disc ".$v->diskon_persen."%":'';?>
                        </td>
                        <td class="price" align="right" colspan="2">
                            <?//=number_format(ceil((($v->qty_entry*$v->harga_satuan)+$v->racik_rp+$v->embalase_rp+$v->ppn_rp-$v->diskon_rp+$v->tambah_rp)/500)*500)?>
                            <?=number_format($v->total)?>
                        </td>
                    </tr>
                    <?php
$grandTotal = ($grandTotal + (($v->total)+$v->racik_rp+$v->embalase_rp+$v->ppn_rp-$v->diskon_rp+$v->tambah_rp));
}?>
                    <tr>
                        <td colspan='2'>TOTAL BELANJA</td>
                        <td>:</td>
                        <td align="right"><?=number_format($h->total+$h->potongan_rp)?></td>
                    </tr>
                    <tr>
                        <td colspan='2'>DISCOUNT</td>
                        <td>:</td>
                        <td align="right"><?=number_format($h->potongan_rp)?></td>
                    </tr>
                    <tr>
                        <td colspan='2'><strong>NETTO</strong></td>
                        <td>:</td>
                        <td align="right"><strong><?=number_format($h->total)?></strong></td>
                    </tr>
                    <tr>
                        <td colspan='2'>DIBAYAR</td>
                        <td>:</td>
                        <td align="right"><?=number_format($h->dp)?></td>
                    </tr>
                    <tr>
                        <td colspan='2'>KEMBALIAN</td>
                        <td>:</td>
                        <td align="right"><?=number_format($h->jumlah_kembali)?></td>
                    </tr>
                    <tr>
                        <td colspan='2'>TOTAL ITEM</td>
                        <td>:</td>
                        <td align="right"><?=number_format(count($d))?></td>
                    </tr>
                    <!-- <tr>
                        <td colspan='2'>NETTO</td>
                        <td>:</td>
                        <td><?//=number_format($grandTotal)?></td>
                    </tr> -->

                </tbody>
            </table>
            <p class="centered">TERIMA KASIH ATAS KUNJUNGAN
                <br>DAN KEPERCAYAAN ANDA
                <brSEMOGA CEPAT SEMBUH>
            </p>
        </div>
    </body>



</html>
