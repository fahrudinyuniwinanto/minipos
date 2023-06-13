<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
<style>
.total {
    font-size: 26px;
}

.total-sub {
    font-size: 26px;
}
</style>
<div class="ibox float-e-margins" ng-show="f.tab=='list'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-primary" ng-click="new()">Buat Baru</button>
        </div>
        <h3>Daftar Penjualan</h3>
    </div>
    <div class="ibox-content form-inline">
        <div class="input-group m-b">
            <input type="text" ng-model="f.q" class="form-control input-sm" placeholder="" ng-enter="getList()">
            <span class="input-group-addon pointer" ng-click="getList()">Cari</span>
        </div>
        <div id="div1" class="table-responsive">
            <table ng-table="tableList" show-filter="false" class="table table-condensed table-bordered table-hover"
                style="white-space: nowrap;">
                <tr ng-repeat="(k,v) in $data" class="pointer" ng-click="read(v.id)">
                    <td title="'No'">{{k+1}}</td>
                    <td title="'ID'" filter="{id: 'text'}" sortable="'id'">{{v.id}}</td>
                    <td title="'No Transaksi'" filter="{no_trs: 'text'}" sortable="'no_trs'">{{v.no_trs}}</td>
                    <td title="'Cara Bayar'" filter="{cara_bayar: 'text'}" sortable="'cara_bayar'">
                        {{v.cara_bayar}}
                    </td>
                    <td title="'Tanggal Beli'" filter="{tanggal: 'text'}" sortable="'tanggal'">{{v.tanggal}}</td>
                    <td title="'Customer'" filter="{id_suplier: 'text'}" sortable="'id_suplier'">{{v.nm_customer}}</td>
                    <td title="'No PO'" filter="{id_po: 'text'}" sortable="'id_po'">{{v.id_po}}</td>
                    <td title="'Total'" filter="{total: 'text'}" sortable="'total'" class="text-right">
                        {{v.total|number:0}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="ibox float-e-margins" ng-show="f.tab=='sft'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-info" ng-click="f.tab='list'"><i class="fa fa-arrow-left"></i>
                Kembali</button>
            <button type="button" class="btn btn-sm btn-primary" ng-click="new()">Simpan</button>
        </div>
        <h3>Pilih Shift</span>
        </h3>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-4">
                <label title="tanggal">Shift</label>
                <select ng-model="f.shift" class="form-control input-sm" required>
                    <option ng-repeat="v in [['PAGI','PAGI'],['SIANG','SIANG']]" ng-value="v[0]">{{v[1]}}</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="ibox float-e-margins" ng-show="f.tab=='frm'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-info" ng-click="f.tab='list'"><i class="fa fa-arrow-left"></i>
                Kembali</button>
            <button type="button" class="btn btn-sm btn-primary" ng-click="save()">Simpan</button>
            <button type="button" class="btn btn-sm btn-warning" ng-click="prin()" ng-if="f.crud=='u'">Cetak</button>
            <button type=" button" class="btn btn-sm btn-danger" ng-click="del()" ng-if="f.crud=='u'">Hapus</button>
        </div>
        <h3>Form Penjualan
        </h3>
    </div>
    <div class="ibox-content frmEntry">
        <div class="row">
            <div class="col-sm-4">



                <label title="tanggal">No. Transaksi</label>
                <input type="text" ng-model="h.no_trs" class="form-control input-sm date" placeholder="" readonly>
                <label title="tanggal">Tanggal Beli</label>
                <div class="input-group">
                    <input type="text" ng-model="h.tanggal" class="form-control input-sm date" placeholder="" required>
                    <span class="input-group-addon"><i class="fa fa-calendar" ng-click="h.tanggal"></i></span>
                </div>
                <label title="jenis">Jenis Pembelian</label>
                <select ng-model="h.jenis" class="form-control input-sm" required ng-disabled="f.crud=='u'">
                    <option ng-repeat="v in [['UMUM','UMUM'],['MITRA','MITRA KERJA'],['RESEP','RESEP DOKTER']]"
                        ng-value="v[0]">{{v[1]}}</option>
                </select>
                <label title="id_po">No Purchase Order</label>
                <input type="text" ng-model="h.id_po" class="form-control input-sm">
                <label ng-if="h.jenis=='RESEP'" title="dokter_perujuk">Dokter Perujuk <small class="text-navy pointer"
                        ng-click="addDokter()"><i class="fa fa-plus-circle"></i>&nbsp;tambah dokter</small></label>
                <div ng-if="h.jenis=='RESEP'" class="input-group">
                    <input type="text" ng-model="h.nm_dokter_perujuk" class="form-control input-sm" placeholder=""
                        readonly required>
                    <span class="input-group-addon pointer" ng-click="lookup('dokter')"><i
                            class="fa fa-search"></i></span>
                </div>

            </div>
            <div class="col-sm-4">
                <label title="id_group1">Customer <small class="text-navy pointer" ng-click="addCustomer()"><i
                            class="fa fa-plus-circle"></i>&nbsp;tambah customer</small></label>
                <div class="input-group">
                    <input type="text" ng-model="h.nm_customer" class="form-control input-sm" placeholder="" readonly
                        required>
                    <span class="input-group-addon pointer" ng-click="lookup('customer')"><i
                            class="fa fa-search"></i></span>
                </div>

                <div class='row'><small class="">{{h.alamat_customer}}</small></div>
                <label title="dp">DP</label>
                <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" ng-model="h.dp" class="form-control input-sm" placeholder="" awnum="default">
                </div>
                <label title="cara_bayar">Cara Bayar</label>
                <select ng-model="h.cara_bayar" class="form-control input-sm" required>
                    <option
                        ng-repeat="v in [['CASH','CASH'],['DEBIT','DEBIT (BCA, MANDIRI, BNI DLL)'],['KREDIT','KREDIT (BCA, MANDIRI, BNI DLL)'],['TRANSFER','E-MONEY (Gopay, Dana, OVO dll)']]"
                        ng-value="v[0]">
                        {{v[1]}}
                    </option>
                </select>

            </div>
            <div class="col-sm-4">
                <table class="table invoice-total">
                    <tbody>
                        <tr>
                            <td class="total" style="width:10%"><strong>Total</strong></td>
                            <td class="total total-val">
                                <input type="text" awnum='default' ng-model="h.total"
                                    ng-change="h.jumlah_kembali=h.jumlah_bayar-h.total" class="form-control"
                                    style="direction: rtl;font-size:20px;margin:0px;" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class="total-sub"><strong>Jml Bayar</strong></td>
                            <td class="total-sub"><input type="text" awnum='default' ng-model="h.jumlah_bayar"
                                    ng-change="h.jumlah_kembali=h.jumlah_bayar-h.total" class="form-control"
                                    style="direction: rtl;font-size:20px;margin:0px;"></td>
                        </tr>
                        <tr>
                            <td class="total-sub"><strong>Kembali</strong></td>
                            <td class="total-sub"><input type="text" awnum='default' ng-model="h.jumlah_kembali"
                                    class="form-control" style="font-size:20px;margin:0px;" readonly></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-4">
                <div class="row">
                    <!-- <div class="col-md-6">
                        <label title="jenis_ppn">Jenis PPN</label>
                        <select ng-model="h.jenis_ppn" class="form-control input-sm" required>
                            <option ng-repeat="v in [['INCLUDE','INCLUDE'],['NON','NON'],['EXCLUDE','EXCLUDE']]"
                                ng-value="v[0]">{{v[1]}}</option>
                        </select>
                    </div> -->

                </div>
                <!-- <label title="keterangan">Keterangan</label>
                <textarea class="form-control input-sm" ng-model="h.keterangan"></textarea> -->

            </div>
        </div>
        <div class="row">
            <hr>
            <div class="col-md-12">
                <div class="table-responsive">
                    <h4>Detil Item</h4>
                    <small class="text-navy">*Klik panah bawah pada tiap cell inputan untuk menambah baris
                        item</small><br>
                    <table class="table table-bordered table-hover table-condensed" style="white-space: nowrap;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang <button class="btn btn-xs btn-success" ng-click="addBarang()"><i
                                            class="fa fa-plus-circle"></i>
                                        tambah
                                        barang</button></th>
                                <th style="width: 80px;">Satuan</th>
                                <th>Qty</th>
                                <th>Harga Satuan</th>
                                <th ng-show="h.jenis=='RESEP'">Racik</th>
                                <th ng-show="h.jenis=='RESEP'">Racik Rp</th>
                                <th ng-show="h.jenis=='RESEP'">Embalase Rp</th>
                                <th>Disc %</th>
                                <th>Disc Rp</th>
                                <th>PPN %</th>
                                <th>PPN Rp</th>
                                <th>Total</th>
                                <th colspan="2">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="(k,v) in d" ng-class="{'terhapus':v.isactive==0}" set-focus="$last">
                                <td>{{k+1}}</td>
                                <td class="p-0">
                                    <input type="text" ng-model="v.nm_barang"
                                        class="form-control input-sm no-border-text" placeholder="..."
                                        ng-keydown="key($event,v,k)">
                                    <!-- <div class="" title="ID: {{v.id_barang}}"><span class="text-success"><i
                                                class="fa fa-search"></i>&nbsp;</span>{{v.nm_barang}}</div> -->
                                </td>
                                <td class="p-0">
                                    <select ng-model="v.satuan_entry" class="form-control input-sm">
                                        <option ng-repeat="(k2,v2) in v.arrsat" ng-value="v2.satuan">{{v2.satuan}}
                                        </option>
                                    </select>
                                </td>
                                <td class="p-0"><input type="text" ng-model="v.qty_entry"
                                        class="form-control input-sm no-border-text" placeholder="..." awnum="default"
                                        ng-keydown="key($event)" ng-keyup="hitung(v,k)" ng-readonly="!v.id_barang">
                                </td>
                                <td class="p-0"><input type="text" ng-model="v.harga_satuan"
                                        class="form-control input-sm no-border-text" placeholder="..." awnum="default"
                                        ng-keydown="key($event)" readonly></td>
                                <td ng-show="h.jenis=='RESEP'">
                                    <div class=""><input type="checkbox" ng-model="v.is_racik"
                                            ng-readonly="!v.id_barang" ng-true-value="1"></div>
                                </td>
                                <td class="p-0" ng-show="h.jenis=='RESEP'"><input type="text" ng-model="v.racik_rp"
                                        class="form-control input-sm no-border-text" placeholder="..." awnum="default"
                                        ng-keydown="key($event)" ng-keyup="hitung(v,k)" ng-readonly="!v.is_racik">
                                </td>
                                <td class="p-0" ng-show="h.jenis=='RESEP'"><input type="text" ng-model="v.embalase_rp"
                                        ng-readonly class="form-control input-sm no-border-text" placeholder="..."
                                        awnum="default" ng-keydown="key($event)"></td>
                                <td class="p-0"><input type="text" ng-model="v.diskon_persen" ng-readonly="!v.id_barang"
                                        class="form-control input-sm no-border-text" placeholder="..." awnum="default"
                                        ng-keydown="key($event)" ng-keyup="hitung(v,k)"></td>
                                <td>
                                    {{(v.diskon_rp|number:0)}}
                                </td>
                                <td class="p-0"><input type="text" ng-model="v.ppn_persen" ng-readonly="!v.id_barang"
                                        class="form-control input-sm no-border-text" placeholder="..." awnum="default"
                                        ng-keydown="key($event)" ng-keyup="hitung(v,k)"></td>
                                <td>
                                    {{(v.ppn_rp|number:0)}}
                                </td>
                                <td>
                                    {{v.total|number:0}}
                                </td>
                                <td class="pointer" ng-click="delD(k)"><i class="fa fa-trash"></i></td>
                                <td class="pointer" ng-click="restoreD(k)"><i class="fa fa-refresh"></i></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success btn-sm" ng-click="showForm2=!showForm2"
                        title="Klik untuk menambah potongan, biaya tambahan dan tanggal jatuh tempo"><i
                            class="fa fa-plus-circle"></i> Tambah Biaya/Potongan lain</button>

                </div>
            </div>
        </div>
        <hr>
        <div class="row" ng-show="showForm2">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-4">
                        <label title="potongan_persen">Potongan %</label>
                        <div class="input-group">
                            <input type="text" ng-model="h.potongan_persen" class="form-control input-sm"
                                placeholder="">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label title="potongan_rp">Potongan Rp</label>
                        <div class="input-group">
                            <input type="text" ng-model="h.potongan_rp" class="form-control input-sm" placeholder=""
                                awnum="default">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
                <label title="jatuh_tempo">Tanggal Jatuh Tempo</label>
                <div class="input-group">
                    <input type="text" ng-model="h.jatuh_tempo" class="form-control input-sm date" placeholder="">
                    <span class="input-group-addon"><i class="fa fa-calendar" ng-click="h.jatuh_tempo"></i></span>
                </div>
            </div>
            <div class="col-md-4">

                <label title="biaya1">Biaya1</label>
                <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" ng-model="h.biaya1" class="form-control input-sm" placeholder="" awnum="default">
                </div>
                <label title="keterangan_biaya1">Keterangan Biaya1</label>
                <input type="text" ng-model="h.keterangan_biaya1" class="form-control input-sm">

            </div>
            <div class="col-md-4">
                <label title="biaya2">Biaya2</label>
                <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" ng-model="h.biaya2" class="form-control input-sm" placeholder="" awnum="default">
                </div>
                <label title="keterangan_biaya2">Keterangan Biaya2</label>
                <input type="text" ng-model="h.keterangan_biaya2" class="form-control input-sm">

            </div>
        </div>

    </div>
    <script>
    app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
        NgTableParams, SfService, FileUploader) {
        SfService.setUrl("<?=base_url()?>jual_h");
        $scope.f = {
            crud: 'c',
            tab: 'list',
            pk: 'id',
            form2: 'hide',
            shift: '',
            q: ''
        };
        $scope.h = {};
        $scope.d = [];

        $scope.new = function() {
            console.log("shift " + $scope.f.shift);
            if (!$scope.f.shift) {
                $scope.f.tab = 'sft';
                return false;
            }
            // $scope.getSatuan();
            $scope.f.tab = 'frm';
            $scope.f.crud = 'c';
            $scope.h = {
                tanggal: moment().format('YYYY/MM/DD'),
                jenis: 'UMUM',
                id_customer: '1',
                nm_customer: 'UMUM',
                cara_bayar: 'CASH',
            };
            $scope.d = [];
            $scope.f.form2 = 'hide';
            $scope.addD();


        }


        $scope.copy = function() {
            $scope.f.crud = 'c';
            $scope.h[$scope.f.pk] = '';
        }


        $scope.addD = function() {
            $scope.d.push({
                isactive: 1
            });
        }

        $scope.delD = function(k) {
            // $scope.d[k].isactive = 0;
            $scope.d.splice(k, 1);
        }

        $scope.copy = function() {
            $scope.f.crud = 'c';
            $scope.h[$scope.f.pk] = '';
        }

        $scope.getList = function() {
            $scope.tableList = new NgTableParams({}, {
                getData: function($defer, params) {
                    var $btn = $('button').button('loading');
                    return $http.get(SfService.getUrl('/getList'), {
                        params: {
                            page: $scope.tableList.page(),
                            limit: $scope.tableList.count(),
                            order_by: $scope.tableList.orderBy(),
                            q: $scope.f.q
                        }
                    }).then(function(jdata) {
                        $btn.button('reset');
                        $scope.tableList.total(jdata.data.total);
                        return jdata.data.data;
                    }, function(error) {
                        $btn.button('reset');
                        swal('', error.data, 'error');
                    });

                }
            });
        }

        $scope.save = function() {
            if (SfFormValidate('.frmEntry') == false) {
                swal('', 'Data not valid', 'error');
                return false;
            }

            SfService.post(SfService.getUrl('/save'), {
                f: $scope.f,
                h: $scope.h,
                d: $scope.d,
            }, function(jdata) {
                console.log(jdata);
                $scope.f.tab = 'list';
                $scope.getList();
            });
        }

        $scope.read = function(id) {
            SfService.get(SfService.getUrl("/read/" + id), {}, function(jdata) {
                $scope.f.tab = 'frm';
                $scope.f.crud = 'u';
                $scope.h = jdata.data.h;
                $scope.d = jdata.data.d;
                angular.forEach($scope.d, function(v, k) {
                    $scope.getBarang(v.id_barang, $scope.h.jenis, v.id_satuan, k);
                    $scope.d[k].satuan_entry = v.id_satuan;
                    $scope.$apply();
                });
            });
        }



        $scope.del = function(id) {
            if (id == undefined) {
                var id = $scope.h[$scope.f.pk];
            }

            swal({
                    title: "Perhatian",
                    text: "Hapus data ini? id=" + id,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Ya, Hapus!",
                    closeOnConfirm: false
                },
                function() {
                    SfService.get(SfService.getUrl("/delete/" + id), {}, function(
                        jdata) {
                        $scope.f.tab = 'list';
                        $scope.getList();
                        swal("Berhasil!", "Data berhasil dihapus.", "success");
                    });
                });
        }






        $scope.lookup = function(icase, fn) {
            switch (icase) {
                case 'customer':
                    SfLookup("<?=base_url()?>m_customer/lookup?jenis=UMUM", function(id,
                        name,
                        json) {
                        $scope.h.id_customer = id;
                        $scope.h.nm_customer = name;
                        $scope.h.alamat_customer = json.alamat;
                        $scope.$apply();
                    });
                    break;
                case 'dokter':
                    SfLookup("<?=base_url()?>m_customer/lookup?jenis=MK", function(id,
                        name,
                        json) {
                        $scope.h.dokter_perujuk = id;
                        $scope.h.nm_dokter_perujuk = name;
                        $scope.$apply();
                    });
                    break;
                case 'd_barang':
                    SfLookup("<?=base_url()?>m_barang/lookup",
                        function(
                            id,
                            name, json) {
                            $scope.d[fn].id_barang = id;
                            $scope.d[fn].nm_barang = json.nama;
                            $scope.d[fn].qty_entry = 1;
                            $scope.getBarang(id, $scope.h.jenis, json.id_satuan, fn);
                            $scope.d[fn].satuan_entry = json.id_satuan;
                            $scope.$apply();
                            // console.log($scope.d);
                        });
                    break;
                default:
                    swal('Pilihan tidak tersedia');
                    break;
            }
        }



        $scope.key = function($event, v = [], k = 0) {
            if ($event.keyCode == 40) { //arrow down
            } else if ($event.keyCode == 13) { //enter
                $scope.addD();
                // $scope.d[k].nm_barang.focus();
            } else if ($event.ctrlKey && $event.keyCode == 32) { //ctrl + space
                $scope.qBarang(v, k);
            }
        }

        $scope.qBarang = function(v, k) {
            SfService.get(SfService.getUrl("/qBarang"), {
                nama_barang: v.nm_barang
            }, function(jdata) {
                console.log('numrows' + jdata.data.numrows);
                if (jdata.data.numrows == 1) {
                    let d = jdata.data.h;
                    console.log(jdata.data.h);
                    $scope.d[k].nm_barang = d.nama;
                    $scope.getBarang(d.id, d.jenis, d.tipe, d.id_satuan,
                        k);
                    // $scope.hitung($scope.d, fn);
                } else if (jdata.data.numrows > 1) {
                    console.log("nama barang " + v.nm_barang);
                    $scope.lookup('d_barang', k);
                    // $scope.f.q = v.nm_barang;
                } else {
                    //barang tidak ditemukan
                }
            });
        }


        $scope.getBarang = function(id, jns_cust, id_satuan, fn) {
            $scope.d[fn].harga_satuan = "";
            SfService.get(SfService.getUrl("/getBarang"), {
                id: id,
                jns_cust: jns_cust,
                sat: id_satuan
            }, function(jdata) {
                console.log(jdata.data);
                $scope.d[fn].harga_satuan = jdata.data.h.harga_satuan;
                $scope.d[fn].racik_rp = jdata.data.h.racik_rp;
                $scope.d[fn].arrsat = jdata.data.h.arrsatuan;
                $scope.$apply();
                $scope.hitung($scope.d, fn);
            });
        }


        // di input form ditulis : ng-keypress="hitung(v)"
        $scope.hitung = (v, $index) => {
            console.log("isi v => ");
            console.log(v);
            console.log("index " + $index);
            let qty_entry = v.qty_entry == null ? 0 : v.qty_entry;
            let harga_satuan = v.harga_satuan == null ? 0 : v.harga_satuan;
            let racik_rp = v.racik_rp == null ? 0 : v.racik_rp;
            let embalase_rp = v.embalase_rp == null ? 0 : v.embalase_rp;
            let diskon_rp = v.diskon_rp == null ? 0 : v.diskon_rp;
            let diskon_persen = v.diskon_persen == null ? 0 : v.diskon_persen;
            let ppn_rp = v.ppn_rp == null ? 0 : v.ppn_rp;
            let ppn_persen = v.ppn_persen == null ? 0 : v.ppn_persen;
            let total = (parseInt(qty_entry) * parseInt(harga_satuan)) + parseInt(racik_rp) + parseInt(
                embalase_rp) - parseInt(diskon_rp) + parseInt(ppn_rp);
            $scope.d[$index].total = total;
            $scope.d[$index].diskon_rp = qty_entry * harga_satuan * diskon_persen / 100;
            $scope.d[$index].ppn_rp = qty_entry * harga_satuan * ppn_persen / 100;
            //grandtotal
            $scope.h.total = $scope.h.total == null ? 0 : $scope.h.total;
            angular.forEach($scope.d, function(v, k) {
                let dtotal = v.total == null ? 0 : v.total;
                let grand = parseInt($scope.h.total) + parseInt(dtotal);
                $scope.h.total = grand;
            });
            $scope.$apply();
        }



        $scope.prin = function(id) {
            if (id == undefined) {
                var id = $scope.h[$scope.f.pk];
            }
            window.open(SfService.getUrl('/prin') + "?id=" + encodeURI(id), 'print_' + id,
                    'width=950,toolbar=0,resizable=0,scrollbars=yes,height=520,top=100,left=100'
                )
                .focus();
        }


        $scope.addCustomer = function(id) {
            if (id == undefined) {
                var id = $scope.h[$scope.f.pk];
            }
            window.open('<?=base_url()?>/m_customer?direct_new=1', '',
                    'width=950,toolbar=0,resizable=0,scrollbars=yes,height=520,top=100,left=100'
                )
                .focus();
        }

        $scope.addBarang = function(id) {
            if (id == undefined) {
                var id = $scope.h[$scope.f.pk];
            }
            window.open('<?=base_url()?>/m_barang?direct_new=1', '',
                    'width=950,toolbar=0,resizable=0,scrollbars=yes,height=520,top=100,left=100'
                )
                .focus();
        }


        $scope.getList();
    }]);
    </script>