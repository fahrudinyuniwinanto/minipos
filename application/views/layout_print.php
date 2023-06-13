<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            <?=data_app()?>
        </title>
        <link href="<?=base_url()?>assets/vendor/inspinia/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/vendor/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/css/paper.min.css" rel="stylesheet">
        <script src="<?=base_url()?>assets/vendor/inspinia/js/jquery-2.1.1.js"></script>
        <script src="<?=base_url()?>assets/js/angular/sf3.js"></script>
        <script src="<?=base_url()?>assets/js/sf.js"></script>
        <style>
        .plain-button {
            background: none;
            color: inherit;
            border: none;
            padding: 0;
            font: inherit;
            cursor: pointer;
            outline: inherit;
        }
        </style>
    </head>

    <body>
        <div class="wrapper wrapper-content" ng-app="sfApp" ng-controller="mainCtrl" id="mainCtrl">
            <div class="text-center no-print" style="padding-top: 20px;">
                <!-- <a href="<?=base_url()?>backend" class="btn btn-sm btn-info"><i class="fa fa-arrow-left"></i>Kembali Ke
                    Dashboard</a>
                <button type="button" class="btn plain-button" onclick="window.print()"> <i class="fa fa-print"></i>
                    Cetak</button>
                <button type="button" class="btn plain-button" onclick="exportExcel('laporan')"> <i
                        class="fa fa-file"></i>
                    Excel</button> -->
            </div>
            <?php $this->load->view($content);?>
        </div>
    </body>

</html>