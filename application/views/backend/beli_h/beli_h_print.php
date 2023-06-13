<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
    * {
        font-size: 10px;
        font-family: 'Times New Roman';
    }

    td,
    th,
    tr,
    table {
        border: 1px solid black;
        /* border-collapse: collapse; */
    }

    td.description,
    th.description {
        width: 150px;
        max-width: 150px;
    }

    td.quantity,
    th.quantity {
        width: 25px;
        max-width: 25px;
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
        width: 185px;
        max-width: 185px;
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
    <title>Surat Pesanan Obat</title>
</head>

<body>
    <div class="ticket">
        <!-- <img src="<?=base_url()?>/assets/img/logo.png" alt="Logo"> -->
        <p class="centered">APOTEK WARINGIN MULYO
            <br>Jl. Diponegoro No. 26
            <br>Telp: 0293 - 491019
        </p>
        <p class="centered">Temanggung, <?=tanggal_indo(date_format(date_create($h->created_at), "Y-m-d"))?>
            <br>Kepada Yth.
            <br><?=$this->db->get_where('m_supplier', ['id' => $h->id_suplier])->row()->nama?>
        </p>
        <p class="centered"><strong>SURAT PESANAN OBAT</strong></p>

        <table>
            <thead>
                <tr>
                    <th class="quantity">Banyaknya</th>
                    <th class="description">Nama Obat</th>
                </tr>
            </thead>
            <tbody>
                <?php
foreach ($d as $k => $v) {
    ?>
                <tr>
                    <td class="description">
                        <?=$this->db->get_where("m_barang", ['id' => $v->id_barang])->row()->nama?></td>
                    <td class="quantity"><?=$v->qty?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <p class="centered">Hormat Kami:
            <br>Apoteker,
            <br>
            <br>
            <br>
            <br>apt. Novelita Sahara, S.Si
            <br>SIPA:3323.56212/SIPA-00-1/090/X/2016
            <br>
            <br>Yang menerima pesanan
            <br>
            <br>
            <br>(..........................)
        </p>
    </div>
</body>

</html>