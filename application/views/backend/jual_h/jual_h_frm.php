<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
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
            <table ng-table="tableList" show-filter="false" class="table table-condensed table-bordered table-hover" style="white-space: nowrap;">
                <tr ng-repeat="(k,v) in $data" class="pointer" ng-click="read(v.id)">
                    <td title="'No'">{{k+1}}</td>
                    <td title="'Customer'" filter="{customer: 'text'}" sortable="'customer'">{{v.customer}}</td>
                    <td title="'Tanggal'" filter="{tanggal: 'text'}" sortable="'tanggal'" align="center">{{v.tanggal}}</td>
                    <td title="'Cara Bayar'" filter="{cara_bayar: 'text'}" sortable="'cara_bayar'" align="center">{{v.cara_bayar}}</td>
                    <td title="'Total'" filter="{total: 'text'}" sortable="'total'" align="right"><strong>{{v.total|number:0}}</strong></td>
                    <td title="'Jumlah Bayar'" filter="{jumlah_bayar: 'text'}" sortable="'jumlah_bayar'" align="right">{{v.jumlah_bayar|number:0}}</td>
                    <td title="'Jumlah Kembali'" filter="{jumlah_kembali: 'text'}" sortable="'jumlah_kembali'" align="right">{{v.jumlah_kembali|number:0}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="ibox float-e-margins" ng-show="f.tab=='frm'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-info" ng-click="f.tab='list'"><i class="fa fa-arrow-left"></i> Kembali</button>
            <button type="button" class="btn btn-sm btn-primary" ng-click="save()">Simpan</button>
            <button type="button" class="btn btn-sm btn-warning" ng-click="copy()" ng-if="f.crud=='u'">Duplikasi</button>
            <button type="button" class="btn btn-sm btn-warning" ng-click="prin()" ng-if="f.crud=='u'">Cetak</button>
            <button type="button" class="btn btn-sm btn-danger" ng-click="del()" ng-if="f.crud=='u'">Hapus</button>
        </div>
        <h3>Kasir</h3>
    </div>
    <div class="ibox-content frmEntry">
        <div class="row">
            <div class="col-sm-3">
                <label title="id">ID</label>
                <input type="text" ng-model="h.id" class="form-control input-sm" readonly>
                <label title="customer">Customer</label>
                <input type="text" ng-model="h.customer" class="form-control input-sm text-uppercase">

            </div>
            <div class="col-sm-3">
                <label title="tanggal">Tanggal</label>
                <input type="text" ng-model="h.tanggal" class="form-control input-sm date">
                <label title="cara_bayar">Cara Bayar</label>
                <select ng-model="h.cara_bayar" class="form-control input-sm">
                    <option ng-repeat="v in ['TUNAI','TRANSFER']" ng-value="v">{{v}}</option>
                </select>
            </div>
            <div class="col-sm-3">
            </div>
            <div class="col-sm-3">
                <label title="total">Total</label>
                <input type="text" ng-model="h.total" class="form-control input-lg" awnum="default" readonly>
                <label title="jumlah_bayar">Jumlah Bayar</label>
                <input type="text" ng-model="h.jumlah_bayar" class="form-control input-lg" ng-keyup="bayar()" awnum="default">
                <label title="jumlah_kembali">Jumlah Kembali</label>
                <input type="text" ng-model="h.jumlah_kembali" class="form-control input-lg" awnum="default" readonly>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <h4>List Barang </h4>
                    <table class="table" style="white-space: nowrap;">
                        <tr class="success">
                            <th>Nama Barang</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                        </tr>
                        <tr ng-repeat="(k,v) in d|filter:f.q_d" ng-class="{'terhapus':v.isactive==0}">
                            <td class="pointer" ng-click="lookup('d_barang',k)">
                                <div class="" title="ID: {{v.id_barang}}"><span class="text-success"><i class="fa fa-search"></i></span>{{v.nm_barang}}</div>
                            </td>
                            <td class="p-0"><input type="text" ng-model="v.qty" class="form-control input-sm no-border-text" ng-keyup="hitungRow(k)" placeholder="..."></td>
                            <td class="p-0"><input type="text" ng-model="v.satuan" class="form-control input-sm no-border-text" readonly></td>
                            <td class="p-0"><input type="text" ng-model="v.harga" class="form-control input-sm no-border-text" awnum="default" readonly></td>
                            <td class="p-0"><input type="text" ng-model="v.total" class="form-control input-sm no-border-text" awnum="default" readonly></td>
                        </tr>
                    </table>
                </div>
                <button type="button" class="btn btn-success btn-sm" ng-click="addD()" ng-class="f.level_user==3?'hide':''">Tambah Baris</button>
                <hr>
            </div>
            <script>
                app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
                    SfService.setUrl("<?= base_url() ?>jual_h");
                    $scope.f = {
                        crud: 'c',
                        tab: 'list',
                        pk: 'id'
                    };
                    $scope.h = {};
                    $scope.d = [];

                    $scope.new = function() {
                        $scope.f.tab = 'frm';
                        $scope.f.crud = 'c';
                        $scope.h = {
                            tanggal: moment().format('YYYY/MM/DD')
                        };
                        $scope.d = [];
                    }

                    $scope.copy = function() {
                        $scope.f.crud = 'c';
                        $scope.h[$scope.f.pk] = '';
                    }

                    $scope.addD = function() {
                        $scope.d.push({});
                    }

                    $scope.delD = function(k) {
                        $scope.d[k].splice();
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
                                SfService.get(SfService.getUrl("/delete/" + id), {}, function(jdata) {
                                    $scope.f.tab = 'list';
                                    $scope.getList();
                                    swal("Berhasil!", "Data berhasil dihapus.", "success");
                                });
                            });
                    }

                    $scope.hitungRow = function(fn) {
                        let total = $scope.d[fn].total == null ? 0 : $scope.d[fn].total;
                        let qty_entry = $scope.d[fn].qty == null ? 0 : $scope.d[fn].qty;
                        let harga_satuan = $scope.d[fn].harga == null ? 0 : $scope.d[fn].harga;

                        $scope.d[fn].total = (qty_entry * harga_satuan);
                        $scope.grandTotal();
                    }

                    $scope.grandTotal = function() {
                        let total = 0;
                        //data detil
                        angular.forEach($scope.d, function(v, k) {
                            let dtotal = v.total == null ? 0 : v.total;
                            total = parseFloat(total) + parseFloat(dtotal);
                        });

                        $scope.h.total=total;
                    }

                    $scope.bayar = function() {
                        let total = $scope.h.total == null ? 0 : $scope.h.total;
                        let jumlah_bayar = $scope.h.jumlah_bayar == null ? 0 : $scope.h.jumlah_bayar;
                        $scope.h.jumlah_kembali = (jumlah_bayar - total);
                    }

                    $scope.prin = function(id) {
                        if (id == undefined) {
                            var id = $scope.h[$scope.f.pk];
                        }
                        window.open(SfService.getUrl('/prin') + "?id=" + encodeURI(id), 'print_' + id, 'width=950,toolbar=0,resizable=0,scrollbars=yes,height=520,top=100,left=100').focus();
                    }

                    $scope.lookup = function(icase, fn) {
                        switch (icase) {
                            case 'd_barang':
                                SfLookup("<?= base_url() ?>m_barang/lookup",
                                    function(id, name, json) {
                                        $scope.d[fn].id_barang = json.id;
                                        $scope.d[fn].nm_barang = json.nama;
                                        $scope.d[fn].harga = json.harga_jual;
                                        $scope.d[fn].satuan = json.satuan;
                                        $scope.d[fn].qty = 1;
                                        $scope.d[fn].total = json.harga_jual * 1;
                                        $scope.grandTotal();
                                        $scope.$apply();
                                    });
                                break;
                            default:
                                swal('Pilihan tidak tersedia');
                                break;
                        }
                    }

                    $scope.getList();

                }]);
            </script>