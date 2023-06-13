<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="<?= data_app('META_DESC') ?>">
    <meta name="keywords" content="<?= data_app('META_KEYWORDS') ?>">
    <meta name="author" content="<?= data_app('META_AUTHOR') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= data_app() ?></title>
    <link rel="icon" href="https://apotikwaringin.com/wp-content/uploads/2020/08/cropped-logo-32x32.jpeg" sizes="32x32">
    <meta name="msapplication-TileImage" content="https://apotikwaringin.com/wp-content/uploads/2020/08/cropped-logo-270x270.jpeg">
    <link href="<?= base_url() ?>assets/vendor/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/sweetalert/css/sweetalert.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="<?= base_url() ?>assets/vendor/inspinia/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <!-- Morris -->
    <link href="<?= base_url() ?>assets/vendor/inspinia/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/datepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet"> -->
    <link href="<?= base_url() ?>assets/vendor/datepicker/css/datepicker3.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/inspinia/css/animate.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/inspinia/iCheck/custom.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/inspinia/css/style.css?ver=2020" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/radiocheck/radiocheck.css" rel="stylesheet">
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/jquery-2.1.1.js"></script>
    <script src="<?= base_url() ?>assets/vendor/inspinia/iCheck/icheck.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/bootstrap.min.js"></script>
    <!-- Mainly scripts -->
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- Flot -->
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/flot/curvedLines.js"></script>
    <!-- Peity -->
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/demo/peity-demo.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/inspinia.js"></script>
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/pace/pace.min.js"></script>
    <!-- jQuery UI -->
    <!-- Jvectormap -->
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js">
    </script>
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js">
    </script>
    <script src="<?= base_url() ?>assets/vendor/sweetalert/js/sweetalert.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/datepicker/js/bootstrap-datepicker.js"></script>
    <!-- Sparkline -->
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- Sparkline demo data  -->
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/demo/sparkline-demo.js"></script>
    <!-- ChartJS-->
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/chartJs/Chart.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/toastr/toastr.min.js"></script>
    <script src="<?= base_url() ?>assets/js/sf.js"></script>
    <script src="<?= base_url() ?>assets/vendor/inspinia/js/plugins/fullcalendar/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/js/angular/angular.min.js"></script>
    <script src="<?= base_url() ?>assets/js/angular/angular-cookies.min.js"></script>
    <script src="<?= base_url() ?>assets/js/angular/angular-route.js"></script>
    <script src="<?= base_url() ?>assets/js/angular/angular-sanitize.js"></script>
    <script src="<?= base_url() ?>assets/js/angular-file-upload/angular-file-upload.min.js"></script>
    <link href="<?= base_url() ?>assets/js/angular/ng-table/ng-table.min.css" rel="stylesheet" />
    <script src="<?= base_url() ?>assets/js/angular/ng-table/ng-table.min.js"></script>
    <script src="<?= base_url() ?>assets/js/angular/sf-angular.js"></script>
    <script src="<?= base_url() ?>assets/js/sfAngular.js"></script>
    <script src="<?= base_url() ?>assets/js/angular/sf3.js"></script>
    <script src="<?= base_url() ?>assets/js/table2excel.js"></script>
    <script src="<?= base_url() ?>assets/js/angular-strap/angular-strap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/angular-strap/angular-strap.tpl.min.js"></script>
    <script src="<?= base_url() ?>assets/js/angular/dynamic-number.min.js?ver=2019.06.12')}}"></script>
    <link href="<?= base_url() ?>assets/vendor/Login_v18/vendor/select2/select2.css" rel="stylesheet" />
    <script src="<?= base_url() ?>assets/vendor/Login_v18/vendor/select2/select2.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></s cript> -->
    <link href="<?= base_url() ?>assets/vendor/inspinia/css/overide.css" rel="stylesheet">
    <style>
        html {
            height: 100% !important;
        }

        body {
            height: 100% !important;
            padding-bottom: 30px;
        }

        .footer {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .textError {
            border-color: #ed5565 !important;
        }

        .trgreen {
            background-color: #8ee28e;
        }

        .trred {
            background-color: #e89e9e;
        }

        .trorange {
            background-color: #f3cd6d;
        }
    </style>
    <style type="text/css">
        tr.terhapus td {
            text-decoration: line-through !important;
            color: #ed5565 !important;
        }

        .font-lg {
            font-size: 14px;
        }
    </style>
</head>
<?php
$CI = &get_instance();
lookup();

?>

<body ng-app="sfApp" ng-controller="topCtrl" id="topCtrl" class="md-skin skin-2">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                                <img alt="image" class="img-circle" src="<?= base_url() ?>assets/foto_users/default.jpg" style="width: 45px;" />
                            </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">
                                            <?= $this->session->userdata('fullname') ?></strong>
                                    </span> <span class="text-muted text-xs block"><?= $this->db->get_where('m_cabang', ['id' => getSession('id_cabang')])->row()->nama ?>
                                        <b class="caret"></b></span>
                                </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <!-- <li><a href="#">
                                            <?= $this->session->userdata('email') ?></a></li>
                                    <li><a href="#">
                                            <?= $this->session->userdata('telp') ?></a></li>
                                    <li class="divider"></li> -->
                                <li><a href="<?= base_url() ?>users/changePassword"><i class="fa fa-key"></i> Ubah
                                        Password</a></li>
                                <li><a href="#"><i class="fa fa-shift"></i>
                                        <?= "Shift " . getSession('shift') ?></a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="<?= base_url() ?>auth/logout">Keluar</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            AWM
                        </div>
                    </li>
                    <li><a href="<?= base_url() ?>backend"><i class="fa fa-th-large"></i> <span class="nav-label">Beranda</span><span class="label label-primary pull-right"></span></a>
                    </li>
                    </li>
                    </li>
                    <li class="">
                        <?php if (is_allow('M_MASTER')) : ?>
                            <a href="#"><i class="fa fa-database"></i> <span class="nav-label">Master</span> <span class="fa arrow"></span></a>
                        <?php endif; ?>
                        <ul class="nav nav-second-level">
                            <li class="<?= is_allow('M_BARANG') ? '' : 'hide' ?>"><a href="<?= base_url() ?>m_barang">Barang</a></li>
                            <li class="<?= is_allow('M_SATUAN') ? '' : 'hide' ?>"><a href="<?= base_url() ?>m_satuan">Satuan</a></li>
                            <li class="<?= is_allow('M_SUPLIER') ? '' : 'hide' ?>"><a href="<?= base_url() ?>m_supplier">Supplier</a></li>
                            <li class="<?= is_allow('M_CUSTOMER') ? '' : 'hide' ?>"><a href="<?= base_url() ?>m_customer">Customer</a></li>
                            <li class="<?= 'hide' ?>"><a href="<?= base_url() ?>m_cabang">Cabang</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-truck"></i> <span class="nav-label">Pembelian</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="<?= is_allow('M_BELI') ? '' : 'hide' ?>"><a href="<?= base_url() ?>beli_h">Data Pembelian</a></li>
                        </ul>
                    </li>
                    <li class="<?= is_allow('M_JUAL') ? '' : 'hide' ?>">
                        <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Penjualan</span>
                            <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="<?= is_allow('M_JUAL') ? '' : 'hide' ?>"><a href="<?= base_url() ?>jual_h">Data Penjualan</a></li>
                            <li class="<?= is_allow('M_TAGIHAN_BPJS') ? '' : 'hide' ?>"><a href="<?= base_url() ?>tagihan_bpjs">Tagihan BPJS</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a class="<?= is_allow('M_MUTASI') ? '' : 'hide' ?>" href="#"><i class="fa fa-exchange"></i> <span class="nav-label">Mutasi</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?= base_url() ?>mutasi_h">Mutasi Barang</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a class="<?= is_allow('M_SO') ? '' : 'hide' ?>" href="#"><i class="fa fa-cube"></i> <span class="nav-label">Stock Opname</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?= base_url() ?>so_h">Stock Opname</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="#"><i class="fa fa-dollar"></i> <span class="nav-label">Pembayaran</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="<?= is_allow('M_HUTANG') ? '' : 'hide' ?>"><a href="<?= base_url() ?>hutang_h">Hutang ke Vendor</a></li>
                            <li class="<?= is_allow('M_PIUTANG') ? '' : 'hide' ?>"><a href="<?= base_url() ?>piutang_h">Piutang Customer</a></li>
                        </ul>
                    </li>
                    
                    <li class="<?= is_allow('M_LAP_BELI') ? '' : 'hide' ?>">
                        <a href="#"><i class="fa fa-pie-chart"></i> <span class="nav-label">Laporan Pembelian</span>
                            <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?= base_url() ?>laporan/laporanPembelian/umum">Umum</a>
                            <li><a href="<?= base_url() ?>laporan/laporanPembelian/mk">MK</a>
                            <li><a href="<?= base_url() ?>laporan/laporanPembelian/bpjs">BPJS</a>
                            <li><a href="<?= base_url() ?>laporan/laporanPembelian/all">Semua Pembelian</a>
                            <li><a href="<?= base_url() ?>laporan/laporanKasKeluar">Pembelian Perobat</a></li>
                    </li>
                </ul>
                </li>
                <li class="<?= is_allow('M_LAP_JUAL') ? '' : 'hide' ?>">
                    <a href="#"><i class="fa fa-pie-chart"></i> <span class="nav-label">Laporan Penjualan</span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?= base_url() ?>laporan/laporanPenjualanDetil">Penjualan Detil</a></li>
                        <li><a href="<?= base_url() ?>laporan/laporanPenjualan/umum">Umum Pershift</a>
                        <li><a href="<?= base_url() ?>laporan/laporanPenjualan/mk">MK Pershift</a>
                        <li><a href="<?= base_url() ?>laporan/laporanPenjualan/resep">Resep Pershift</a>
                        <li><a href="<?= base_url() ?>laporan/laporanPenjualan/dokel">Dokel Pershift</a>
                        <li><a href="<?= base_url() ?>laporan/laporanPenjualan/all">Semua Pershift</a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="#"><i class="fa fa-pie-chart"></i> <span class="nav-label">Laporan Mutasi</span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?= base_url() ?>laporan/laporanMutasi">Mutasi</a></li>
                </li>
                </ul>
                </li>
                <li class="">
                    <a href="#"><i class="fa fa-money"></i> <span class="nav-label">Laporan Keuangan</span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?= base_url() ?>sia_akun_waringin"> <i class="fa fa-key"></i> COA Akun</a></li>
                        <li><a href="<?= base_url() ?>sia_transaksi_waringin"> <i class="fa fa-calendar"></i> Jurnal Umum</a></li>
                        <li><a href="<?= base_url() ?>sia_transaksi_waringin/buku_besar"> <i class="fa fa-book"></i> Buku Besar</a></li>
                        <li><a href="<?= base_url() ?>sia_transaksi_waringin/neraca_lajur"> <i class="fa fa-calculator"></i> Neraca Lajur</a></li>
                        <li><a href="<?= base_url() ?>sia_akun_waringin/penerimaan"><i class="fa fa-money"></i> Penerimaan & Pengeluaran</a></li>
                            <li><a href="<?= base_url() ?>sia_akun_waringin/laba_rugi"><i class="fa fa-dollar"></i> Perhitungan Laba Rugi</a></li>
                            <li><a href="<?= base_url() ?>sia_akun_waringin/neraca"><i class="fa fa-unlink"></i> Neraca</a></li>
                    </ul>
                </li>
                <li class="<?= is_allow('M_LAPORAN') ? '' : 'hide' ?>">
                        <a href="#"><i class="fa fa-pie-chart"></i> <span class="nav-label">Laporan Lain</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?= base_url() ?>laporan/laporanBarang">List Barang</a></li>
                            <!-- <li><a href="<?= base_url() ?>laporan/laporanOmset">Laporan Omset</a></li> -->
                            <!-- <li><a href="<?= base_url() ?>laporan/laporanStock">Stock Barang</a></li> -->
                            <li><a href="<?= base_url() ?>laporan/laporanSo">Stock Opname</a>
                            <li class="<?= getSession('id_cabang') == 'WR001' ? '' : 'hide' ?>"><a href="<?= base_url() ?>laporan/prinTagihanBpjs">Tagihan BPJS</a>
                            </li>
                            <!-- <li><a href="<?= base_url() ?>laporan/laporanJual">Laporan Penjualan</a></li> -->
                        </ul>
                    </li>
                <li class="<?= is_allow('M_USERS') ? '' : 'hide' ?>">
                    <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Pengguna</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?= base_url() ?>users">Users</a></li>
                        <li><a href="<?= base_url() ?>user_group">User Group</a></li>
                        <li><a href="<?= base_url() ?>user_access">User Access</a></li>
                        <li><a href="<?= base_url() ?>master_access">Master Access</a></li>
                    </ul>
                </li>
                <li class="">
                    <?php if (is_allow('M_SY_CONFIG')) : ?>
                        <a href="#"><i class="fa fa-wrench"></i> <span class="nav-label">Sistem</span> <span class="fa arrow"></span></a>
                    <?php endif; ?>
                    <?php //die($this->db->last_query());
                    ?>
                    <ul class="nav nav-second-level">
                        <li><a href="<?= base_url() ?>sy_config">Konfigurasi</a></li>
                        <li><a href="<?= base_url() ?>kategori">Kategori</a></li>
                        <li><a href="<?= base_url() ?>m_barang/qtyawalfrm">Qty Stok Awal</a></li>
                    </ul>
                </li>

                <li class="">
                    <a href="<?= base_url() ?>proposal_h"><i class="fa fa-send"></i><span class="nav-label">Keluar</span></a>
                </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-info " href="#">SHIFT
                            <?= getSession('shift') ?></a>
                        <!-- <form role="search" class="navbar-form-custom" action="search_results.html">
                                <div class="form-group">
                                    <label></label>
                                    <input type="text" value="" class="form-control"
                                        name="top-search" id="top-search">
                                </div>
                            </form> -->
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">
                                <?= data_app('APP_NAME') ?>,
                                <?= data_app('OPD_NAME') ?></span>
                        </li>
                        <li>
                            <a href="<?= base_url() . 'auth/logout' ?>">
                                <i class="fa fa-sign-out"></i> Keluar
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="wrapper wrapper-content" ng-app="sfApp" ng-controller="mainCtrl" id="mainCtrl">
                <div class="table-responsive">
                    <?php $this->load->view($content); ?>
                </div>
            </div>
        </div>
        <div class="footer" style="position: fixed;">
            <div class="pull-right">
                <?= data_app('RIGHT_FOOTER'); ?>
            </div>
            <div>
                <?= data_app('LEFT_FOOTER'); ?>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            /*
                        var d1 = [[1262304000000, 6], [1264982400000, 3057], [1267401600000, 20434], [1270080000000, 31982], [1272672000000, 26602], [1275350400000, 27826], [1277942400000, 24302], [1280620800000, 24237], [1283299200000, 21004], [1285891200000, 12144], [1288569600000, 10577], [1291161600000, 10295]];
                        var d2 = [[1262304000000, 5], [1264982400000, 200], [1267401600000, 1605], [1270080000000, 6129], [1272672000000, 11643], [1275350400000, 19055], [1277942400000, 30062], [1280620800000, 39197], [1283299200000, 37000], [1285891200000, 27000], [1288569600000, 21000], [1291161600000, 17000]];

                        var data1 = [
                            { label: "Data 1", data: d1, color: '#17a084'},
                            { label: "Data 2", data: d2, color: '#127e68' }
                        ];
                        $.plot($("#flot-chart1"), data1, {
                            xaxis: {
                                tickDecimals: 0
                            },
                            series: {
                                lines: {
                                    show: true,
                                    fill: true,
                                    fillColor: {
                                        colors: [{
                                            opacity: 1
                                        }, {
                                            opacity: 1
                                        }]
                                    },
                                },
                                points: {
                                    width: 0.1,
                                    show: false
                                },
                            },
                            grid: {
                                show: false,
                                borderWidth: 0
                            },
                            legend: {
                                show: false,
                            }
                        });

                        var lineData = {
                            labels: ["January", "February", "March", "April", "May", "June", "July"],
                            datasets: [
                                {
                                    label: "Example dataset",
                                    fillColor: "rgba(220,220,220,0.5)",
                                    strokeColor: "rgba(220,220,220,1)",
                                    pointColor: "rgba(220,220,220,1)",
                                    pointStrokeColor: "#fff",
                                    pointHighlightFill: "#fff",
                                    pointHighlightStroke: "rgba(220,220,220,1)",
                                    data: [65, 59, 40, 51, 36, 25, 40]
                                },
                                {
                                    label: "Example dataset",
                                    fillColor: "rgba(26,179,148,0.5)",
                                    strokeColor: "rgba(26,179,148,0.7)",
                                    pointColor: "rgba(26,179,148,1)",
                                    pointStrokeColor: "#fff",
                                    pointHighlightFill: "#fff",
                                    pointHighlightStroke: "rgba(26,179,148,1)",
                                    data: [48, 48, 60, 39, 56, 37, 30]
                                }
                            ]
                        };

                        var lineOptions = {
                            scaleShowGridLines: true,
                            scaleGridLineColor: "rgba(0,0,0,.05)",
                            scaleGridLineWidth: 1,
                            bezierCurve: true,
                            bezierCurveTension: 0.4,
                            pointDot: true,
                            pointDotRadius: 4,
                            pointDotStrokeWidth: 1,
                            pointHitDetectionRadius: 20,
                            datasetStroke: true,
                            datasetStrokeWidth: 2,
                            datasetFill: true,
                            responsive: true,
                        };


                        var ctx = document.getElementById("lineChart").getContext("2d");
                        var myNewChart = new Chart(ctx).Line(lineData, lineOptions);
            */
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
            // $('input.timepicker').timepicker({ timeFormat: 'h:mm'});
            $('input.datepicker').datepicker({
                dateFormat: 'yy/mm/dd'
            });
            // $('input.datepicker-ym').datepicker({ dateFormat: 'mm/yy'});


        });
    </script>

</body>


</html>