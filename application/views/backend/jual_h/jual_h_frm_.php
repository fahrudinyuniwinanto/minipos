<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
<style>
    .total {
        font-size: 22px;
    }

    .total-sub {
        font-size: 22px;
    }

    .tr-racik {
        background-color: #a8aae7;
    }
</style>
<div class="ibox float-e-margins" ng-show="f.tab=='list'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-primary" ng-click="new()">Buat Baru</button>
            <button type="button" class="btn btn-sm btn-warning" ng-click="export2Excel('tbl')">Excel</button>
        </div>
        <h3>Daftar Penjualan</h3>
    </div>
    <div class="ibox-content form-inline">
        <div class="input-group m-b">
            <input type="text" ng-model="f.q" class="form-control input-sm" placeholder="Cari customer/dokter/nama obat" ng-enter="getList()">
            <span class="input-group-addon pointer" ng-click="getList()">Cari</span>
        </div>
        <div class="input-group m-b">
            <select ng-model="f.jenis" class="form-control input-sm" ng-change="getList()">
                <option ng-repeat="v in [['UMUM','UMUM'],['MK','MITRA KERJA'],['RESEP','RESEP DOKTER']]" ng-value="v[0]">{{v[1]}}</option>
            </select>
        </div>
        <div id="div1" class="table-responsive">
            <table ng-table="tableList" show-filter="false" id="tbl" class="table table-condensed table-bordered table-hover" style="white-space: nowrap;">
                <tr ng-repeat="(k,v) in $data" class="pointer" ng-click="read(v.id)" ng-class="v.shift=='PAGI'?'success':'warning'">
                    <td title="'No'">{{k+1}}</td>
                    <td title="'ID'" filter="{id: 'text'}" sortable="'id'">{{v.id}}</td>
                    <td title="'No Transaksi'" filter="{no_trs: 'text'}" sortable="'no_trs'">{{v.no_trs}}</td>
                    <td title="'Jenis'" filter="{jenis: 'text'}" sortable="'jenis'">
                        {{v.jenis}}{{v.is_dokel=='1'?' DOKEL':''}}
                    </td>
                    <td title="'Shift'" filter="{id: 'text'}" sortable="'shift'">{{v.shift}}</td>
                    <td title="'Tanggal Beli'" filter="{tanggal: 'text'}" sortable="'tanggal'">{{v.tanggal}}</td>
                    <td title="'Customer'" filter="{id_suplier: 'text'}" sortable="'id_suplier'">
                        {{v.nm_customer|uppercase}}</td>
                    <td ng-if="f.jenis=='RESEP'" title="'Dokter Perujuk'" filter="{nm_dokter: 'text'}" sortable="'nm_dokter'">{{v.nm_dokter}}
                    </td>
                    <td title="'Total'" filter="{total: 'text'}" sortable="'total'" class="text-right">
                        {{v.total|number}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- <div class="ibox float-e-margins font-lg" ng-show="f.tab=='sft'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-info" ng-click="getList();"><i class="fa fa-arrow-left"></i>
                Kembali</button>
            <button type="button" id="simpan-shift" class="btn btn-sm btn-primary"
                ng-click="new();$('#barcode').focus();">Simpan</button>
        </div>
        <h3>Pilih Shift</h3>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-10">
            </div>
            <div class="col-sm-2">
                <label title="tanggal">Pilih Shift Anda</label>
                <select ng-model="f.shift" ng-change="new();" class="form-control input-lg font-lg" required>
                    <option ng-repeat="v in [['PAGI','PAGI'],['SIANG','SIANG']]" ng-value="v[0]">{{v[1]}}</option>
                </select>
            </div>
        </div>
    </div>
</div> -->
<div class="ibox float-e-margins" ng-show="f.tab=='frm'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-info" ng-click="getList();f.tab='list'"><i class="fa fa-arrow-left"></i>
                Kembali</button>
            <button type="button" class="btn btn-sm btn-primary" ng-click="save()">Simpan</button>
            <!-- <button type="button" class="btn btn-sm btn-primary" ng-click="save();getList();f.tab='list'">Simpan dan
                Keluar</button> -->
            <button type="button" class="btn btn-sm btn-warning" ng-click="save('1')" ng-if="d[0]"> Simpan dan
                Cetak</button>
            <button type=" button" class="btn btn-sm btn-danger" ng-click="del()" ng-if="f.crud=='u'">Hapus</button>
        </div>
        <h3>Form Penjualan
        </h3>
    </div>
    <div class="ibox-content frmEntry">
        <div class="row">
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-6">
                        <label title="tanggal">No. Transaksi</label>
                        <input type="text" ng-model="h.no_trs" class="form-control input-sm date" placeholder="" readonly>
                    </div>
                    <div class="col-sm-6">
                        <label title="tanggal">SHIFT</label>
                        <input ng-if="h.shift" type="text" ng-value="h.shift" class="form-control input-sm date" placeholder="" readonly>
                        <input ng-if="!h.shift&&f.shift" type="text" ng-value="f.shift" class="form-control input-sm date" placeholder="" readonly>
                    </div>
                </div>
                <label title="jenis">Jenis Pembelian</label>
                <select ng-model="h.jenis" class="form-control input-sm" required ng-disabled="f.crud=='u'">
                    <option ng-repeat="v in [['UMUM','UMUM'],['MK','MITRA KERJA'],['RESEP','RESEP DOKTER']]" ng-value="v[0]">{{v[1]}}</option>
                </select>
                <label ng-if="h.jenis=='RESEP'" title="dokter_perujuk">Dokter Perujuk <small class="text-navy pointer" ng-click="addDokter()"><i class="fa fa-plus-circle"></i>&nbsp;tambah dokter</small></label>
                <div class="input-group" ng-if="h.jenis=='RESEP'">
                    <input type="text" ng-model="h.dokter_perujuk" id="dokter_perujuk" ng-change="selectedDokter(h.dokter_perujuk)" class="form-control input-sm" data-min-length="0" data-html="1" data-auto-select="true" data-animation="am-flip-x" bs-options="cust.id as cust.nama for cust in getAutoCompleteCustomer($viewValue)" bs-typeahead>
                    <span class="input-group-addon">{{h.nm_dokter_perujuk}}</span>
                </div>
                <label ng-show="h.nm_dokter_perujuk" title="is_dokel"> Centang jika Dokter
                    Keluarga <input type="checkbox" ng-model="h.is_dokel" class="checkbox-primary" style="width:20px;height:20px;" ng-checked="h.is_dokel==1"></label>




                <!-- <input type="checkbox" ng-model="h.is_dokel" class="js-switch" checked="" data-switchery="true"
                    style="display: none;">
                <span class="switchery"
                    style="background-color: rgb(26, 179, 148); border-color: rgb(26, 179, 148); box-shadow: rgb(26, 179, 148) 0px 0px 0px 16px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"><small
                        style="left: 20px; transition: left 0.2s ease 0s;"></small></span> -->
                <label title="dp">Barcode Barang <small class="text-navy pointer" ng-click="addBarang()"><i class="fa fa-plus-circle"></i>&nbsp;tambah barang</small></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class='fa fa-qrcode'></i></span>
                    <input type="text" ng-model="f.barcode" id="barcode" class="form-control input-sm text-uppercase" ng-enter="qBarang()" autocomplete="off">
                </div>
            </div>
            <div class="col-sm-4">
                <label title="tanggal">Tanggal Beli</label>
                <div class="input-group">
                    <input type="text" ng-model="h.tanggal" class="form-control input-sm date" placeholder="" required>
                    <span class="input-group-addon"><i class="fa fa-calendar" ng-click="h.tanggal"></i></span>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <label title="id_po">No Purchase Order</label>
                        <input type="text" ng-model="h.id_po" class="form-control input-sm">
                    </div>
                    <div class="col-sm-6">
                        <label title="cara_bayar">Cara Bayar</label>
                        <select ng-model="h.cara_bayar" class="form-control input-sm" required>
                            <option ng-repeat="v in [['KAS','CASH'],['BRI','TRANSFER BRI'],['BPD','TRANSFER BANK JATENG']]" ng-value="v[0]">
                                {{v[1]}}
                            </option>
                        </select>
                    </div>
                </div>
                <label title="id_group1">Customer <small class="text-navy pointer" ng-click="addCustomer()"><i class="fa fa-plus-circle"></i>&nbsp;tambah customer</small></label>
                <div class="input-group">
                    <input type="text" ng-model="h.id_customer" id="id_customer" ng-change="selectedCust(h.id_customer)" class="form-control input-sm" data-min-length="0" data-html="1" data-auto-select="true" data-animation="am-flip-x" bs-options="cust.id as cust.nama for cust in getAutoCompleteCustomer($viewValue)" bs-typeahead>
                    <span class="input-group-addon">{{h.nm_customer}}</span>
                </div>
            </div>
            <div class="col-sm-4">
                <table class="table invoice-total">
                    <tbody>
                        <tr>
                            <td class="total" style="width:10%"><strong>Total Penjualan</strong></td>
                            <td class="total total-val">
                                <input type="text" awnum='default' ng-model="h.total" class="form-control" style="text-align: right;font-size:20px;marginpx;" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class="total" style="width:10%"><strong>Bayar</strong></td>
                            <td class="total total-val">
                                <input type="text" awnum='default' ng-model="h.dp" id="h-dp" class="form-control" ng-keyup="h.jumlah_kembali=h.dp-h.total" style="text-align: right;font-size:20px;marginpx;" autocomplete="off" required>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td class="total-sub"><strong>Angsuran</strong></td>
                            <td class="total-sub"><input type="text" awnum='default' ng-model="h.angsuran"
                                    class="form-control" style="text-align: right;font-size:20px;marginpx;" ng-readonly="f.crud=='c'"></td>
                        </tr> -->
                        <tr>
                            <td class="total-sub"><strong>Kembali</strong></td>
                            <td class="total-sub"><input type="text" awnum='default' ng-model="h.jumlah_kembali" class="form-control" style="text-align: right;font-size:20px;marginpx;" readonly>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <h4>Detil Item</h4>
                    <small class="text-navy">*data terpilih yang bisa anda edit</small><br>
                    <table class="table" style="white-space: nowrap;">
                        <tr>
                            <th>Nama Barang</th>
                            <th style="width: 80px;">Satuan</th>
                            <th>Qty</th>
                            <th>Harga Satuan</th>
                            <th ng-show="h.jenis=='RESEP'">Resep</th>
                            <th ng-show="h.jenis=='RESEP'&&r.is_racik===true">Racik</th>
                            <th ng-show="h.jenis=='RESEP'">Racik Rp</th>
                            <th ng-show="h.jenis=='RESEP'">Embalase Rp </th>
                            <th>Disc %</th>
                            <th>Disc Rp</th>
                            <th>PPN %</th>
                            <th>PPN Rp</th>
                            <th ng-show="h.jenis=='MK'">Tambah %</th>
                            <th ng-show="h.jenis=='MK'">Tambah Rp</th>
                            <th>Total</th>
                        </tr>
                        <tr class="frmEntry" style="white-space: nowrap;">
                            <td class="p-0"><input type="text" ng-model="r.nm_barang" class="form-control input-sm" readonly></td>
                            <td class="p-0">
                                <select ng-model="r.satuan_entry" class="form-control input-sm" ng-change="ubahSatuan()" ng-keyup="hitungRow()">
                                    <option ng-repeat="(k,v) in r.arrsat" ng-value="v['nama_satuan']">
                                        {{v['nama_satuan']}}</option>
                                </select>
                            </td>
                            <td class="p-0"><input type="text" ng-model="r.qty_entry" awnum="default" ng-keyup="hitungRow()" class="form-control input-sm" id="r-qtyentry" placeholder="..." autocomplete="off"></td>
                            <td class="p-0 m-0"><input type="text" ng-value="r.harga_satuan|number:0" ng-keyup="hitungRow()" class="form-control input-sm" placeholder="..." readonly></td>
                            <td class="p-0" ng-show="h.jenis=='RESEP'"><input type="checkbox" ng-model="r.is_racik" class="form-control input-sm" style="margin:0px;" ng-change="hitungRow()"></td>
                            <td class="p-0" ng-show="h.jenis=='RESEP'&&r.is_racik===true"><input type="checkbox" ng-model="r.add_harga_racik" class="form-control input-sm" style="margin:0px;" ng-change="AddHargaRacik()"></td>
                            <td class="p-0" ng-show="h.jenis=='RESEP'"><input type="text" ng-model="r.racik_rp" awnum="default" class="form-control input-sm" ng-keyup="r.allowedit=1;hitungRow()"></td>
                            <td class="p-0" ng-show="h.jenis=='RESEP'"><input type="text" ng-model="r.embalase_rp" awnum="default" class="form-control input-sm" ng-keyup="r.allowedit=1;hitungRow()"></td>
                            <td class="p-0"><input type="text" ng-model="r.diskon_persen" awnum="default" class="form-control input-sm" placeholder="..." ng-keyup="hitungRow()"></td>
                            <td class="p-0"><input type="text" ng-value="r.diskon_rp|number:0" class="form-control input-sm" placeholder="..." readonly></td>
                            <td class="p-0"><input type="text" ng-model="r.ppn_persen" ng-keyup="hitungRow()" awnum="default" class="form-control input-sm" placeholder="..."></td>
                            <td class="p-0"><input type="text" ng-value="r.ppn_rp|number:0" class="form-control input-sm" placeholder="..." readonly></td>
                            <td class="p-0" ng-show="h.jenis=='MK'"><input type="text" ng-model="r.tambah_persen" ng-keyup="hitungRow()" awnum="default" class="form-control input-sm" placeholder="..."></td>
                            <td class="p-0" ng-show="h.jenis=='MK'"><input type="text" ng-value="r.tambah_rp|number:0" class="form-control input-sm" placeholder="..." readonly></td>
                            <td class="p-0"><input type="text" ng-value="r.total|number:0" class="form-control input-sm" placeholder="..." readonly></td>
                        </tr>
                    </table>

                    <table class="table table-bordered table-condensed font-lg" style="white-space: nowrap;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
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
                                <th ng-show="h.jenis=='MK'">Tbh %</th>
                                <th ng-show="h.jenis=='MK'">Tbh Rp</th>
                                <th>Total</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="(k,v) in d" ng-click="selectRow(v,k);" set-focus="$last" class="rowitem rowitem_{{k}}" ng-class="v.is_racik?'tr-racik':''">
                                <td>{{k+1}}</td>
                                <td><strong>{{v.nm_barang}}</strong></td>
                                <td align="center">{{v.satuan_entry}}</td>
                                <td align="right">{{v.qty_entry}}</td>
                                <td align="right">{{v.harga_satuan|number:0}}</td>
                                <td align="center" ng-show="h.jenis=='RESEP'">
                                    {{v.is_racik==1?"R":"-"}}
                                </td>
                                <td align="right" ng-show="h.jenis=='RESEP'">
                                    {{v.racik_rp|number:0}}
                                </td>
                                <td align="right" ng-show="h.jenis=='RESEP'">
                                    {{v.embalase_rp|number:0}}
                                </td>
                                <td align="right">{{v.diskon_persen}}</td>
                                <td align="right">{{v.diskon_rp|number:0}}</td>
                                <td align="right">{{v.ppn_persen}}</td>
                                <td align="right">{{v.ppn_rp|number:0}}</td>
                                <td align="right" ng-show="h.jenis=='MK'">{{v.tambah_persen}}</td>
                                <td align="right" ng-show="h.jenis=='MK'">{{v.tambah_rp|number:0}}</td>
                                <td align="right"><strong>{{v.total|number:0}}</strong></td>
                                <td><button class="btn btn-danger btn-xs" ng-click="delD(k)">Hapus</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success btn-sm" ng-click="showForm2=!showForm2" title="Klik untuk menambah potongan, biaya tambahan dan tanggal jatuh tempo"><i class="fa fa-plus-circle"></i> Tambah Biaya/Potongan lain</button>

                </div>
            </div>
        </div>
        <hr>
        <div class="row" ng-show="showForm2">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4">
                        <label title="potongan_persen">Potongan %</label>
                        <div class="input-group">
                            <input type="text" ng-model="h.potongan_persen" class="form-control input-sm" placeholder="" ng-keyup="hitungRow()">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label title="potongan_rp">Potongan Rp</label>
                        <div class="input-group">
                            <input type="text" ng-model="h.potongan_rp" class="form-control input-sm" placeholder="" awnum="default" ng-keyup="hitungRow()" readonly>
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                    <div class="col-md-4 hide">
                        <label title="jatuh_tempo">Tanggal Jatuh Tempo</label>
                        <div class="input-group">
                            <input type="text" ng-model="h.jatuh_tempo" class="form-control input-sm date" placeholder="">
                            <span class="input-group-addon"><i class="fa fa-calendar" ng-click="h.jatuh_tempo"></i></span>
                        </div>
                    </div>
                </div>
                <!-- <label title="jatuh_tempo">Tanggal Jatuh Tempo</label>
                <div class="input-group">
                    <input type="text" ng-model="h.jatuh_tempo" class="form-control input-sm date" placeholder="">
                    <span class="input-group-addon"><i class="fa fa-calendar" ng-click="h.jatuh_tempo"></i></span>
                </div> -->
            </div>
            <!--  <div class="col-md-4">

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

            </div> -->
        </div>

    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
            NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?= base_url() ?>jual_h");
            $scope.f = {
                crud: 'c',
                tab: 'list',
                pk: 'id',
                form2: 'hide',
                shift: "<?= getSession('shift') ?>",
                q: '',
                barcode: '',
                jenis: 'UMUM',
            };
            $scope.h = {};
            $scope.r = {};
            $scope.d = [];

            $scope.new = function(fn) {
                console.log("shift " + $scope.f.shift);
                $scope.f.tab = 'frm';
                $scope.f.crud = 'c';
                $scope.h = {
                    tanggal: moment().format('YYYY/MM/DD'),
                    jenis: 'UMUM',
                    id_customer: '1',
                    nm_customer: 'UMUM',
                    cara_bayar: 'KAS',
                };
                $scope.r = {};
                $scope.d = [];
                $scope.f.form2 = 'hide';
                angular.element('#barcode').focus();
            }


            $scope.copy = function() {
                $scope.f.crud = 'c';
                $scope.h[$scope.f.pk] = '';
            }



            $scope.getList = function() {
                $scope.tableList = new NgTableParams({}, {
                    counts: [10, 50, 100, 250, 500, 1000, 2000, 5000],
                    getData: function($defer, params) {
                        var $btn = $('button').button('loading');
                        return $http.get(SfService.getUrl('/getList'), {
                            params: {
                                page: $scope.tableList.page(),
                                limit: $scope.tableList.count(),
                                order_by: $scope.tableList.orderBy(),
                                q: $scope.f.q,
                                jenis: $scope.f.jenis,
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

            $scope.save = function(pleasePrint) {
                if (SfFormValidate('.frmEntry') == false) {
                    swal('', 'Data belum lengkap', 'error');
                    return false;
                }

                SfService.post(SfService.getUrl('/save'), {
                    f: $scope.f,
                    h: $scope.h,
                    d: $scope.d,
                }, function(jdata) {
                    if (pleasePrint == '1') {
                        console.log('pleasePrint' + pleasePrint);
                        $scope.prin(jdata.data.h.id);
                        $scope.new();
                        $scope.$apply();
                    } else {

                        swal({
                            title: 'Pembelian Berhasil',
                            text: 'mohon tunggu ...',
                            icon: 'success',
                            timer: 1000,
                            buttons: false,
                        }, function() {
                            swal.close();
                            $scope.new();
                            $scope.$apply();
                        })
                    }
                });
            }

            $scope.read = function(id) {
                SfService.get(SfService.getUrl("/read/" + id), {}, function(jdata) {
                    $scope.f.tab = 'frm';
                    $scope.f.crud = 'u';
                    $scope.h = jdata.data.h;
                    $scope.d = jdata.data.d;
                    console.log($scope.h);
                    console.log($scope.d);
                    $("#barcode").focus();
                });
            }

            $scope.ubahSatuan = function() {
                SfService.post(SfService.getUrl("/ubahSatuan"), {
                    r: $scope.r
                }, function(jdata) {
                    $scope.r.qty_entry = jdata.data.r.qty_entry;
                    $scope.r.harga_satuan = jdata.data.r.harga_satuan;
                    console.log($scope.r);
                    $scope.pushD();
                    $scope.hitungRow();
                });
            }

            $scope.selectRow = function(v, k) {
                $scope.r = v;
                $(".rowitem").css("background-color", "");
                $(".rowitem_" + k).css("background-color", "#a2fb75");
                $('#r-qtyentry').focus();
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




            $scope.qBarang = function(id, setRManual) {
                SfService.post(SfService.getUrl("/qBarang"), {
                    // barcode: $scope.f.barcode.split(" ").join(""),
                    barcode: $scope.f.barcode,
                    id: id,
                    r: $scope.r,
                    h: $scope.h
                }, function(jdata) {
                    // console.log('numrows' + jdata.data.numrows);
                    let r = jdata.data.r;
                    console.log('data ' + jdata.data.r);
                    if (jdata.data.numrows == 1) {
                        $scope.r = r;
                        $scope.r.satuan_entry = r.id_satuan;
                        $scope.r.id_barang = r.id;
                        $scope.r.id = "";
                        $scope.r.nm_barang = r.nama;
                        if ($scope.h.jenis == 'RESEP' ||
                            setRManual == true) {
                            $scope.r.racik_rp = "2500";
                            $scope.r.embalase_rp = "500";
                        } else {
                            $scope.r.racik_rp = 0;
                            $scope.r.embalase_rp = 0;
                        }
                        $scope.r.diskon_persen = 0;
                        $scope.r.diskon_rp = 0;
                        $scope.r.ppn_persen = 0;
                        $scope.r.ppn_rp = 0;
                        $scope.r.tambah_persen = 0;
                        $scope.r.tambah_rp = 0;
                        $scope.r.qty_entry = 1;
                        $scope.r.total = $scope.r.harga_satuan;
                        if ($scope.h.jenis == 'RESEP') {
                            $scope.r.ppn_persen = 1;
                        }
                        $scope.pushD();
                        $scope.hitungRow();
                        $scope.r = {};
                        $scope.f.barcode = "";
                        $(".rowitem").css("background-color", "");
                        $("#barcode").focus();
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

                //     $scope.d.push($scope.r);
                // }

            }

            $scope.delD = function(k) {
                $scope.d.splice(k, 1);
                $scope.r = {};
                $scope.hitungRow();
            }

            $scope.hitungRow = function() {


                if ($scope.h.jenis == 'RESEP') {
                    if ($scope.r.is_racik === true) {
                        console.log('a');
                        $scope.hasRacik($scope.r);
                    } else {
                        if ($scope.h.is_dokel != 1) {
                            $scope.r.racik_rp = "2500";
                            $scope.r.embalase_rp = "500";
                        }
                    }
                } else {
                    $scope.r.racik_rp = "0";
                    $scope.r.embalase_rp = "0";
                }

                $scope.persenToRupiah();
                let total = $scope.r.total == null ? 0 : $scope.r.total;
                let qty_entry = $scope.r.qty_entry == null ? 0 : $scope.r.qty_entry;
                let harga_satuan = $scope.r.harga_satuan == null ? 0 : $scope.r.harga_satuan;
                let diskon_persen = $scope.r.diskon_persen == null ? 0 : $scope.r.diskon_persen;
                let diskon_rp = $scope.r.diskon_rp == null ? 0 : $scope.r.diskon_rp;
                let ppn_persen = $scope.r.ppn_persen == null ? 0 : $scope.r.ppn_persen;
                let ppn_rp = $scope.r.ppn_rp == null ? 0 : $scope.r.ppn_rp;
                let tambah_persen = $scope.r.tambah_persen == null ? 0 : $scope.r.tambah_persen;
                let tambah_rp = $scope.r.tambah_rp == null ? 0 : $scope.r.tambah_rp;
                let racik_rp = $scope.r.racik_rp == null ? 0 : $scope.r.racik_rp;
                let embalase_rp = $scope.r.embalase_rp == null ? 0 : $scope.r.embalase_rp;

                let totalrow = (qty_entry * harga_satuan) + parseFloat(embalase_rp) + parseFloat(
                    racik_rp) - parseFloat(
                    diskon_rp) + parseFloat(ppn_rp) + parseFloat(tambah_rp);
                if ($scope.h.jenis == "MK") {
                    $scope.r.total = Math.ceil(totalrow / 1000) * 1000;
                } else {
                    $scope.r.total = Math.ceil(totalrow / 500) * 500;
                }
                console.log($scope.r);
                $scope.grandTotal();
            }


            $scope.hasRacik = function(r) {
                console.log('b');
                var ada = false;
                var index_sama = null;
                console.log("cekHasRacik");
                console.log($scope.d);
                angular.forEach($scope.d, function(item, i) {
                    if (item.racik_rp == '3500') {
                        ada = true;
                        index_sama = i;
                    }
                });

                if (ada) {
                    console.log('c');
                    if ($scope.h.is_dokel != 1) {
                        if(!$scope.r.add_harga_racik){
                            $scope.r.racik_rp = "0";
                            $scope.r.embalase_rp = "0";
                        }
                    }
                } else {
                    console.log('d');
                    if ($scope.h.is_dokel != 1) {
                        $scope.r.racik_rp = "3500";
                        $scope.r.embalase_rp = "2500";
                    }
                }
            }

            $scope.AddHargaRacik = function() {
                if ($scope.r.add_harga_racik === true) {

                    console.log("addHargaRacik 3500");
                    $scope.r.racik_rp = "3500";
                    $scope.r.embalase_rp = "2500";
                    $scope.hitungRow();
                } else {
                    
                    console.log("addHargaRacik 0");
                    $scope.r.racik_rp = "0";
                    $scope.r.embalase_rp = "0";
                    $scope.hitungRow();
                }
            }


            $scope.persenToRupiah = function() {
                let qty_entry = $scope.r.qty_entry == null ? 0 : $scope.r.qty_entry;
                let harga_satuan = $scope.r.harga_satuan == null ? 0 : $scope.r.harga_satuan;
                let diskon_persen = $scope.r.diskon_persen == null ? 0 : $scope.r.diskon_persen;
                let ppn_persen = $scope.r.ppn_persen == null ? 0 : $scope.r.ppn_persen;
                let tambah_persen = $scope.r.tambah_persen == null ? 0 : $scope.r.tambah_persen;
                $scope.r.diskon_rp = parseFloat(qty_entry * harga_satuan) * parseFloat(diskon_persen) / 100;
                $scope.r.ppn_rp = parseFloat(qty_entry * harga_satuan) * parseFloat(ppn_persen) / 100;
                $scope.r.tambah_rp = parseFloat(qty_entry * harga_satuan) * parseFloat(tambah_persen) / 100;
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
                let racik_rp = $scope.h.racik_rp == null ? 0 : $scope.h.racik_rp;
                let embalase_rp = $scope.h.embalase_rp == null ? 0 : $scope.h.embalase_rp;
                //grandtotal
                grandtotal = parseFloat(total) - parseFloat($scope.h.potongan_rp) + parseFloat(racik_rp) +
                    parseFloat(embalase_rp);
                $scope.h.total = Math.round(grandtotal / 1) * 1;
            }


            $scope.lookup = function(icase, fn) {
                switch (icase) {
                    case 'customer':
                        SfLookup("<?= base_url() ?>m_customer/lookup?jenis=UMUM", function(id,
                            name,
                            json) {
                            $scope.h.id_customer = id;
                            $scope.h.nm_customer = name;
                            $scope.h.alamat_customer = json.alamat;
                            $scope.$apply();
                        });
                        break;
                    case 'dokter':
                        SfLookup("<?= base_url() ?>m_customer/lookup", function(id,
                            name,
                            json) {
                            $scope.h.dokter_perujuk = id;
                            $scope.h.nm_dokter_perujuk = name;
                            $scope.$apply();
                        });
                        break;
                    case 'barang':
                        SfLookup("<?= base_url() ?>m_barang/lookup?x=" + encodeURIComponent($scope.f.barcode) + "&jenis=" + $scope
                            .h.jenis,
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
                window.open('<?= base_url() ?>/m_customer?direct_new=1&page=CUSTOMER', '',
                        'width=950,toolbar=0,resizable=0,scrollbars=yes,height=520,top=100,left=100'
                    )
                    .focus();
            }


            $scope.addDokter = function(id) {
                if (id == undefined) {
                    var id = $scope.h[$scope.f.pk];
                }
                window.open('<?= base_url() ?>/m_customer?direct_new=1&page=DOKTER', '',
                        'width=950,toolbar=0,resizable=0,scrollbars=yes,height=520,top=100,left=100'
                    )
                    .focus();
            }

            $scope.addBarang = function(id) {
                if (id == undefined) {
                    var id = $scope.h[$scope.f.pk];
                }
                window.open('<?= base_url() ?>/m_barang?direct_new=1', '',
                        'width=950,toolbar=0,resizable=0,scrollbars=yes,height=520,top=100,left=100'
                    )
                    .focus();
            }

            $scope.getAutoCompleteCustomer = function(viewValue) {
                return SfService.typeahead(SfService.getUrl('/getAutoCompleteCustomer'), {
                    q: viewValue,
                    limit: 20
                });
                // SfService.get(SfService.getUrl("/getAutoCompleteCustomer"), {}, function(jdata) {
                //     console.log(jdata.data[1]['nama']);
                //     $scope.h.arr_cust = jdata.data;
                // });
            };


            $scope.selectedCust = function(id) {
                SfService.get(SfService.getUrl("/getCust/" + id), {}, function(jdata) {
                    $scope.h.nm_customer = jdata.data.nama;
                });
            }

            $scope.selectedDokter = function(id) {
                SfService.get(SfService.getUrl("/getCust/" + id), {}, function(jdata) {
                    $scope.h.nm_dokter_perujuk = jdata.data.nama;
                });
            }


            $scope.export2Excel = function(tbl) {
                $("#" + tbl).table2excel({
                    filename: "Table.xls"
                });
            }

            // $scope.setCookiesShift = function() {
            //     document.cookie = $scope.f.shift;
            // }




            $scope.getList();
        }]);
    </script>