<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
<div class="ibox float-e-margins" ng-show="f.tab=='list'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-primary" ng-click="new()">Buat Baru</button>
            <button type="button" class="btn btn-sm btn-warning" ng-click="export2Excel('tbl')">Excel</button>
        </div>
        <h3>Daftar Pembelian</h3>
    </div>
    <div class="ibox-content form-inline">
        <div class="input-group m-b">
            <input type="text" ng-model="f.q" class="form-control input-sm" placeholder="Cari No faktur/nama obat"
                ng-enter="getList()">
            <span class="input-group-addon pointer" ng-click="getList()">Cari</span>
        </div>
        <div id="div1" class="table-responsive">
            <table ng-table="tableList" show-filter="false" id="tbl"
                class="table table-condensed table-bordered table-hover" style="white-space: nowrap;">
                <tr ng-repeat="(k,v) in $data" class="pointer" ng-click="read(v.id)" ng-class="v.jenis_customer=='UMUM'?'success':(v.jenis_customer=='BPJS'?'warning':'info')">
                    <td title="'No'">{{k+1}}</td>
                    <td title="'Id'" filter="{id: 'text'}" sortable="'id'">{{v.id}}</td>
                    <td title="'No Faktur'" filter="{no_faktur: 'text'}" sortable="'no_faktur'"><strong>{{v.no_faktur}}</strong></td>
                    <!-- <td title="'No PO'" filter="{no_po: 'text'}" sortable="'no_po'">{{v.no_po}}</td> -->
                    <td title="'Tanggal Beli'" filter="{id: 'text'}" sortable="'id'">{{v.tanggal}}</td>
                    <td title="'Supplier'" filter="{id_suplier: 'text'}" sortable="'id_suplier'"><strong>{{v.nm_suplier}}</strong></td>
                    <td title="'Jenis Customer'" filter="{jenis_customer: 'text'}" sortable="'jenis_customer'">
                        {{v.jenis_customer}}
                    </td>
                    <td title="'Jenis'">{{v.total>v.dp?'KREDIT':'CASH'}}</td>
                    <td title="'Dibayar'" filter="{kredit: 'text'}" sortable="'kredit'" class="text-right">{{v.total>v.dp?v.kredit:v.dp|number:0}}</td>
                    <td title="'Total'" filter="{total: 'text'}" sortable="'total'" class="text-right">
                        <strong>{{v.total|number:0}}</strong></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="ibox float-e-margins" ng-show="f.tab=='frm'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-info" ng-click="f.tab='list'"><i class="fa fa-arrow-left"></i>
                Kembali</button>
            <button type="button" class="btn btn-sm btn-primary" ng-click="save()">Simpan</button>
            <button type="button" class="btn btn-sm btn-danger" ng-click="del()" ng-if="f.crud=='u'">Hapus</button>
        </div>
        <h3>Form Pembelian <span ng-if="f.crud=='u'" class="text-navy"></span>
        </h3>
    </div>
    <div class="ibox-content frmEntry">
        <div class="row">
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-6">
                        <label title="no_faktur">No Faktur</label>
                        <input type="text" ng-model="h.no_faktur" class="form-control input-sm">
                    </div>
                    <div class="col-sm-6">
                        <label title="no_po">No Purchase Order</label>
                        <input type="text" ng-model="h.no_po" class="form-control input-sm">
                    </div>
                </div>
                <label title="tanggal">Tanggal Beli</label>
                <div class="input-group">
                    <input type="text" ng-model="h.tanggal" class="form-control input-sm date" placeholder="" required>
                    <span class="input-group-addon"><i class="fa fa-calendar" ng-click="h.tanggal"></i></span>
                </div>
                <label title="id_group1">Supplier <small class="text-navy pointer" ng-click="addSupplier()"><i
                            class="fa fa-plus-circle"></i>&nbsp;tambah supplier</small></label>
                <div class="input-group">
                    <input type="text" ng-model="h.nm_supplier" class="form-control input-sm" placeholder="" readonly
                        required>
                    <span class="input-group-addon pointer" ng-click="lookup('supplier')"><i
                            class="fa fa-search"></i></span>
                </div>
                <label title="dp">Barcode Barang <small class="text-navy pointer" ng-click="addBarang()"><i
                            class="fa fa-plus-circle"></i>&nbsp;tambah barang</small></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class='fa fa-qrcode'></i></span>
                    <input type="text" ng-model="f.barcode" id="barcode" class="form-control input-sm"
                        ng-enter="qBarang()">
                </div>

            </div>
            <div class="col-sm-4">
                <label title="jenis_customer">Jenis Customer</label>
                <select ng-model="h.jenis_customer" class="form-control input-sm" required>
                    <option ng-repeat="v in [['UMUM','UMUM'],['MK','MK'],['BPJS','BPJS']]" ng-value="v[0]">{{v[1]}}
                    </option>
                </select>
                <!-- <label title="dp">DP</label>
                <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" ng-model="h.dp" class="form-control input-sm" placeholder="" awnum="default">
                </div> -->
                <label title="keterangan">Keterangan</label>
                <textarea class="form-control input-sm" ng-model="h.keterangan"></textarea>
            </div>
            <div class="col-sm-4">
                <table class="table invoice-total">
                    <tbody>
                        <tr>
                            <td class="total" style="width:10%"><strong>Total Pembelian</strong></td>
                            <td class="total total-val">
                                <input type="text" awnum='default' ng-model="h.total" class="form-control"
                                    style="text-align: right;font-size:20px;marginpx;" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class="dp" style="width:10%"><strong>DP</strong></td>
                            <td class="total total-val">
                                <input type="text" awnum='default' ng-model="h.dp" class="form-control"
                                    style="text-align: right;font-size:20px;marginpx;"
                                    ng-keyup="h.hutang=h.total-h.dp-h.angsuran" ng-readonly="f.crud=='u'">
                            </td>
                        </tr>
                        <tr>
                            <td class="total-sub"><strong>Angsuran</strong></td>
                            <td class="total-sub"><input type="text" awnum='default' ng-model="h.angsuran"
                                    id="jumlah_bayar" class="form-control"
                                    style="text-align: right;font-size:20px;marginpx;" ng-readonly="true"></td>
                        </tr>
                        <tr>
                            <td class="total-sub"><strong>Sisa Hutang</strong></td>
                            <td class="total-sub"><input type="text" awnum='default' ng-model="h.hutang"
                                    ng-value="h.hutang" class="form-control"
                                    style="text-align: right;font-size:20px;marginpx;" readonly></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <button type="button" class="btn btn-success btn-sm" ng-click="showForm2=!showForm2"
            title="Klik untuk menambah potongan, biaya tambahan dan tanggal jatuh tempo"><i
                class="fa fa-plus-circle"></i>
            Tambah Biaya/Potongan lain</button>
        <div class="row" ng-show="showForm2">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-4">
                        <label title="potongan_persen">Potongan %</label>
                        <div class="input-group">
                            <input type="text" ng-model="h.potongan_persen" class="form-control input-sm"
                                ng-keyup="hitungRow()">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label title="potongan_rp">Potongan Rp</label>
                        <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" ng-model="h.potongan_rp" class="form-control input-sm" placeholder=""
                                awnum="default" readonly>
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
        <div class="row">
            <hr>
            <div class="col-md-12">
                <div class="table-responsive">
                    <h4>Detil Item</h4>
                    <small class="text-navy">*data terpilih yang bisa anda edit</small><br>
                    <table class="table" style="white-space: nowrap;">
                        <tr>
                            <th>Nama Barang</th>
                            <th>ED</th>
                            <th style="width: 80px;">Satuan</th>
                            <th>Qty</th>
                            <th>Harga Satuan</th>
                            <th ng-show="h.jenis=='RESEP'">Racik</th>
                            <th>Disc %</th>
                            <th>Disc Rp</th>
                            <th>PPN %</th>
                            <th>PPN Rp</th>
                            <th>Total</th>
                        </tr>
                        <tr class="frmEntry" style="white-space: nowrap;">
                            <td class="p-0"><input type="text" ng-model="r.nm_barang" class="form-control input-sm"
                                    readonly></td>
                                    <td class="p-0"><input type="date" ng-model="r.ed" class="form-control input-sm"
                                    ></td>
                            <td class="p-0">
                                <select ng-model="r.satuan_entry" class="form-control input-sm" ng-change="ubahSatuan()"
                                    ng-keyup="hitungRow()">
                                    <option ng-repeat="(k,v) in r.arrsat" ng-value="v['nama_satuan']">
                                        {{v['nama_satuan']}}</option>
                                </select>
                            </td>
                            <td class="p-0"><input type="text" ng-model="r.qty_entry" ng-keyup="hitungRow()"
                                    class="form-control input-sm" placeholder="..."></td>

                            <td class="p-0"><input type="text" ng-value="r.harga_satuan|number:0" ng-keyup="hitungRow()"
                                    class="form-control input-sm" placeholder="..." readonly></td>
                            <td class="p-0" ng-show="h.jenis=='RESEP'"><input type="checkbox" ng-model="r.is_racik"
                                    class="form-control input-sm" style="margin:0px;"></td>
                            <td class="p-0"><input type="text" ng-model="r.diskon_persen" awnum="default"
                                    class="form-control input-sm" placeholder="..." ng-keyup="hitungRow()"></td>
                            <td class="p-0"><input type="text" ng-value="r.diskon_rp|number:0"
                                    class="form-control input-sm" placeholder="..." readonly></td>
                            <td class="p-0"><input type="text" ng-model="r.ppn_persen" ng-keyup="hitungRow()"
                                    awnum="default" class="form-control input-sm" placeholder="..."></td>
                            <td class="p-0"><input type="text" ng-value="r.ppn_rp|number:0"
                                    class="form-control input-sm" placeholder="..." readonly></td>
                            <td class="p-0"><input type="text" ng-value="r.total|number:0" class="form-control input-sm"
                                    placeholder="..." readonly></td>

                        </tr>
                    </table>

                    <table class="table table-bordered table-hover table-condensed font-lg"
                        style="white-space: nowrap;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>ED</th>
                                <th style="width: 80px;">Satuan</th>
                                <th>Qty</th>
                                <th>Harga Satuan</th>
                                <th ng-show="h.jenis=='RESEP'">Racik</th>
                                <th>Disc %</th>
                                <th>Disc Rp</th>
                                <th>PPN %</th>
                                <th>PPN Rp</th>
                                <th>Total</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="(k,v) in d" ng-click="selectRow(v,k);" set-focus="$last"
                                class="rowitem rowitem_{{k}}">
                                <td>{{k+1}}</td>
                                <td>{{v.nm_barang}}</td>
                                <td>{{v.ed|date:'dd-MM-yyyy'}}</td>
                                <td align="center">{{v.satuan_entry}}</td>
                                <td align="right">{{v.qty_entry}}</td>
                                <td align="right">{{v.harga_satuan|number:0}}</td>
                                <td ng-show="h.jenis=='RESEP'">
                                    {{v.is_racik==1?"R":"-"}}
                                </td>
                                <!-- <td ng-show="h.jenis=='RESEP'">{{v.racik_rp|number:0}}</td> -->
                                <!-- <td ng-show="h.jenis=='RESEP'">{{v.embalase_rp|number:0}}</td> -->
                                <td align="right">{{v.diskon_persen}}</td>
                                <td align="right">{{v.diskon_rp|number:0}}</td>
                                <td align="right">{{v.ppn_persen}}</td>
                                <td align="right">{{v.ppn_rp|number:0}}</td>
                                <td align="right">{{v.total|number:0}}</td>
                                <td><button class="btn btn-danger btn-xs" ng-click="delD(k)">Hapus</button></td>
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
        <!-- <div class="row">
            <hr>
            <div class="col-md-12">
                <div class="table-responsive">
                    <h4>Pembayaran</h4>
                    <small class="text-navy">*Klik panah bawah pada tiap cell inputan untuk menambah baris
                        item</small><br>
                    <table class="table table-bordered table-hover table-condensed" style="white-space: nowrap;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Bayar</th>
                                <th>Jumlah Bayar</th>
                                <th>Cara Bayar</th>
                                <th>Keterangan</th>
                                <th colspan="2">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="(k,v) in d2" ng-class="{'terhapus':v.isactive==0}">
                                <td>{{k+1}}</td>
                                <td class="p-0"><input type="date" ng-model="v.tanggal_bayar"
                                        class="form-control input-sm no-border-text" placeholder="..."
                                        ng-keydown="key2($event)"></td>
                                <td class="p-0"><input type="text" ng-model="v.jumlah_bayar"
                                        class="form-control input-sm no-border-text" placeholder="..." awnum="default"
                                        ng-keydown="key2($event)"></td>
                                <td class="p-0"><select ng-model="v.cara_bayar" class="form-control input-sm" required>
                                        <option
                                            ng-repeat="v in [['CASH','CASH'],['DEBIT','DEBIT (GOPAY, DANA, OVO DLL)'],['TRANSFER','TRANSFER']]"
                                            ng-value="v[0]">{{v[1]}}</option>
                                    </select></td>
                                <td class="p-0"><input type="text" ng-model="v.keterangan"
                                        class="form-control input-sm no-border-text" placeholder="..."
                                        ng-keydown="key2($event)"></td>
                                <td class="pointer" ng-click="delD2(k)"><i class="fa fa-trash"></i></td>
                                <td class="pointer" ng-click="restoreD2(k)"><i class="fa fa-refresh"></i></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success btn-sm" ng-click="addD2()"
                        title="Klik untuk menambah barang"><i class="fa fa-plus-circle"></i> Tambah Baris</button>
                </div>
            </div>
        </div>
        <hr> -->

    </div>
    <script>
    app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope,
        $http,
        NgTableParams, SfService, FileUploader) {
        SfService.setUrl("<?=base_url()?>beli_h");
        $scope.f = {
            crud: 'c',
            tab: 'list',
            pk: 'id',
            form2: 'hide',
            shift: '',
            q: '',
            barcode: '',
        };
        $scope.h = {};
        $scope.d = [];
        // $scope.d2 = [];
        $scope.r = {};

        $scope.new = function() {
            $scope.f.tab = 'frm';
            $scope.f.crud = 'c';
            $scope.h = {
                tanggal: moment().format('YYYY/MM/DD')
            };
            $scope.r = {};
            $scope.d = [];
            // $scope.d2 = [];
            $scope.f.form2 = 'hide';
            angular.element('#barcode').focus();
            $scope.addD2();
        }


        $scope.qBarang = function(id) {
            SfService.post(SfService.getUrl("/qBarang"), {
                barcode: $scope.f.barcode,
                id: id,
                r: $scope.r,
                h: $scope.h
            }, function(jdata) {
                // console.log('numrows' + jdata.data.numrows);
                let r = jdata.data.r;
                if (jdata.data.numrows == 1) {
                    // console.log(r);
                    $scope.r = r;
                    // $scope.r.arrsat = r.arrsat;
                    $scope.r.satuan_entry = r.id_satuan;
                    $scope.r.id_barang = r.id;
                    $scope.r.id = "";
                    $scope.r.nm_barang = r.nama;
                    $scope.r.qty_entry = 1;
                    $scope.r.harga_satuan = $scope.r.harga_beli;
                    $scope.r.total = $scope.r.harga_beli;
                    $scope.pushD();
                    $scope.r = {};
                    $scope.f.barcode = "";
                    if ($scope.h.jenis == 'RESEP') {
                        $scope.r.ppn_persen = 1;
                    }
                    $scope.hitungRow();
                    $(".rowitem").css("background-color", "");
                } else {
                    $scope.lookup('barang', function() {
                        $("input.q-search").val($scope.f.barcode);
                    });
                }
            });
        }


        $scope.pushD = function() {
            var ada = false;
            var index_sama = null;
            var r = $scope.r;
            $scope.d.push($scope.r);
            // angular.forEach($scope.d, function(item, i) {
            //     if (item.id_barang == r.id_barang && item.satuan_entry == r.satuan_entry) {
            //         ada = true;
            //         index_sama = i;
            //     }
            // });

            // if (ada) {
            //     $scope.d[index_sama].qty_entry = $scope.d[index_sama].qty_entry + 1;
            // } else {
            //     console.log("pushD ");
            //     console.log(r);
            //     $scope.d.push($scope.r);
            // }

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
        $scope.addD2 = function() {
            $scope.d2.push({
                isactive: 1,
                tanggal_bayar: moment().format('YYYY/MM/DD'),
            });
        }

        $scope.delD = function(k) {
            $scope.d.splice(k, 1);
            $scope.r = {};
            $scope.hitungRow();
        }

        $scope.hitungRow = function() {
            $scope.persenToRupiah();
            let total = $scope.r.total == null ? 0 : $scope.r.total;
            let qty_entry = $scope.r.qty_entry == null ? 0 : $scope.r.qty_entry;
            let harga_satuan = $scope.r.harga_satuan == null ? 0 : $scope.r.harga_satuan;
            let diskon_rp = $scope.r.diskon_rp == null ? 0 : $scope.r.diskon_rp;
            let ppn_rp = $scope.r.ppn_rp == null ? 0 : $scope.r.ppn_rp;
            let diskon_persen = $scope.r.diskon_persen == null ? 0 : $scope.r.diskon_persen;
            let ppn_persen = $scope.r.ppn_persen == null ? 0 : $scope.r.ppn_persen;
            let totalrow = (qty_entry * harga_satuan) - parseFloat(
                diskon_rp) + parseFloat(ppn_rp);
            $scope.r.total = Math.round(totalrow/1)*1;
            console.log($scope.r);
            $scope.grandTotal();
        }

        $scope.persenToRupiah = function() {
            let qty_entry = $scope.r.qty_entry == null ? 0 : $scope.r.qty_entry;
            let harga_satuan = $scope.r.harga_satuan == null ? 0 : $scope.r.harga_satuan;
            let diskon_persen = $scope.r.diskon_persen == null ? 0 : $scope.r.diskon_persen;
            let ppn_persen = $scope.r.ppn_persen == null ? 0 : $scope.r.ppn_persen;
            $scope.r.diskon_rp = parseFloat(qty_entry * harga_satuan) * parseFloat(diskon_persen) / 100;
            $scope.r.ppn_rp = parseFloat(qty_entry * harga_satuan) * parseFloat(ppn_persen) / 100;

        }

        $scope.grandTotal = function() {
            // let htotal = $scope.h.total == null ? 0 : $scope.h.total;
            let total = 0;
            //data detil
            angular.forEach($scope.d, function(v, k) {
                let dtotal = v.total == null ? 0 : v.total;
                total = parseFloat(total) + parseFloat(dtotal);
            });
            console.log('total ' + total);
            //data header
            let potongan_persen = $scope.h.potongan_persen == null ? 0 : $scope.h.potongan_persen;
            $scope.h.potongan_rp = parseFloat(total) * parseFloat(potongan_persen) / 100;
            //grandtotal
            grandtotal = parseFloat(total) - parseFloat($scope.h.potongan_rp);
            $scope.h.total = Math.round(grandtotal/1)*1;
        }


        // $scope.delD2 = function(k) {
        //     $scope.d2.splice(k, 1);
        // }

        $scope.copy = function() {
            $scope.f.crud = 'c';
            $scope.h[$scope.f.pk] = '';
        }

        $scope.getList = function() {
            $scope.tableList = new NgTableParams({}, {
                counts: [10, 50, 100, 250, 500, 1000],
                getData: function($defer, params) {
                    var $btn = $('button').button('loading');
                    return $http.get(SfService.getUrl('/getList'), {
                        params: {
                            page: $scope.tableList.page(),
                            limit: $scope.tableList.count(),
                            order_by: $scope.tableList.orderBy(),
                            q: $scope.f.q,
                            q_brg: $scope.f.q_brg
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
                // d2: $scope.d2,
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
                $scope.d = [];
                // $scope.d2 = [];
                $scope.d = jdata.data.d;
                // $scope.d2 = jdata.data.d2;
            });
        }


        $scope.selectRow = function(v, k) {
            $scope.r = v;
            $(".rowitem").css("background-color", "");
            $(".rowitem_" + k).css("background-color", "#dff0d8");
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
                    SfService.get(SfService.getUrl("/delete/" + id), {}, function(jdata) {
                        $scope.f.tab = 'list';
                        $scope.getList();
                        swal("Berhasil!", "Data berhasil dihapus.", "success");
                    });
                });
        }

        $scope.del2 = function(id) {
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
                    SfService.get(SfService.getUrl("/delete/" + id), {}, function(jdata) {
                        $scope.f.tab = 'list';
                        $scope.getList();
                        swal("Berhasil!", "Data berhasil dihapus.", "success");
                    });
                });
        }

        $scope.prin = function(id) {
            if (id == undefined) {
                var id = $scope.h[$scope.f.pk];
            }
            window.open(SfService.getUrl('/prin') + "?id=" + encodeURI(id), 'print_' + id,
                    'width=950,toolbar=0,resizable=0,scrollbars=yes,height=520,top=100,left=100')
                .focus();
        }

        $scope.addSupplier = function(id) {
            if (id == undefined) {
                var id = $scope.h[$scope.f.pk];
            }
            window.open('<?=base_url()?>/m_supplier?direct_new=1', '',
                    'width=950,toolbar=0,resizable=0,scrollbars=yes,height=520,top=100,left=100')
                .focus();
        }

        $scope.addBarang = function(id) {
            if (id == undefined) {
                var id = $scope.h[$scope.f.pk];
            }
            window.open('<?=base_url()?>/m_barang?direct_new=1', '',
                    'width=950,toolbar=0,resizable=0,scrollbars=yes,height=520,top=100,left=100')
                .focus();
        }


        $scope.lookup = function(icase, fn) {
            switch (icase) {
                case 'supplier':
                    SfLookup("<?=base_url()?>m_supplier/lookup", function(id, name, json) {
                        $scope.h.id_suplier = id;
                        $scope.h.nm_supplier = name;
                        $scope.$apply();
                    });
                    break;
                    // case 'd_barang':
                    //     SfLookup("<?=base_url()?>m_barang/lookup", function(id, name, json) {
                    //         $scope.d[fn].id_barang = id;
                    //         $scope.d[fn].nm_barang = json.nama;
                    //         $scope.$apply();
                    //     });
                    //     break;
                case 'barang':
                    SfLookup("<?=base_url()?>m_barang/lookup?x=" + encodeURIComponent($scope.f.barcode),
                        function(
                            id,
                            name, json) {
                            $scope.r = json;
                            $scope.qBarang(json.id);
                        });
                    break;
                default:
                    swal('Pilihan tidak tersedia');
                    break;
            }
        }


        $scope.key = function($event) {
            if ($event.keyCode == 40) { //arrow down
            } else if ($event.keyCode == 13) { //enter
                $("#jumlah_bayar").focus();
            } else if ($event.ctrlKey && $event.keyCode == 32) { //ctrl + space
                $scope.qBarang();
            }
        }

        $scope.export2Excel = function(tbl) {
            $("#" + tbl).table2excel({
                filename: "Table.xls"
            });
        }

        $scope.moment = function(dt) {
            return moment(dt);
        }


        $scope.getList();

    }]);
    </script>