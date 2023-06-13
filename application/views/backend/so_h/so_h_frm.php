<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
<div class="ibox float-e-margins" ng-show="f.tab=='list'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-primary" ng-click="new()">Buat Baru</button>
        </div>
        <h3>Daftar Stock Opname</h3>
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
                    <td title="'Id'" filter="{id: 'text'}" sortable="'id'">{{v.id}}</td>
                    <td title="'Tanggal Stock Opname'" filter="{tanggal_so: 'text'}" sortable="'tanggal_so'">
                        {{v.tanggal_so}}</td>
                    <td title="'Keterangan'" filter="{keterangan: 'text'}" sortable="'keterangan'">{{v.keterangan}}</td>
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
            <button type="button" class="btn btn-sm btn-warning" ng-click="copy()"
                ng-if="f.crud=='u'">Duplikasi</button>
            <!-- <button type="button" class="btn btn-sm btn-warning" ng-click="prin()" ng-if="f.crud=='u'">Cetak</button> -->
            <button type="button" class="btn btn-sm btn-danger" ng-click="del()" ng-if="f.crud=='u'">Hapus</button>
        </div>
        <h3>Form Stock Opname</h3>
    </div>
    <div class="ibox-content frmEntry">
        <div class="row">
            <div class="col-sm-2">
                <label title="id">ID</label>
                <input type="text" ng-model="h.id" class="form-control input-sm" readonly>
            </div>
            <div class="col-sm-4">
                <label title="tanggal_so">Tanggal Stock Opname</label>
                <div class="input-group">
                    <input type="text" ng-model="h.tanggal_so" class="form-control input-sm date" placeholder=""
                        required>
                    <span class="input-group-addon"><i class="fa fa-calendar" ng-click="h.tanggal_so"></i></span>
                </div>
            </div>
            <div class="col-sm-4">
                <label title="keterangan">Keterangan</label>
                <textarea ng-model="h.keterangan" class="form-control input-sm" rows="2"></textarea>
            </div>
        </div>
        <div class="row">
            <hr>
            <div class="col-md-12">
                <div class="table-responsive">
                    <h4>Konversi Satuan</h4>
                    <table class="table table-bordered table-hover table-condensed" style="white-space: nowrap;">
                        <thead>
                            <tr>
                                <th class="text-center">Barang</th>
                                <th class="text-center">Qty Stock</th>
                                <th class="text-center">Qty Fisik</th>
                                <th class="text-center">Selisih (Qty)</th>
                                <th class="text-center">Keterangan</th>
                                <th colspan="2" class="text-center">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="(k,v) in d" ng-class="{'terhapus':v.isactive==0}">
                                <td class="pointer" ng-click="lookup('d_barang',k)">
                                    <div class="" title="ID: {{v.id_barang}}"><span class="text-success"><i
                                                class="fa fa-search"></i>&nbsp;</span>{{v.nm_barang}}</div>
                                </td>
                                <td align="right" class="p-0" class="text-center"><input type="text"
                                        ng-model="v.qty_stock" class="form-control input-sm no-border-text"
                                        placeholder="..." awnum='default' readonly>
                                </td>
                                <td align="right" class="p-0" class="text-center"><input type="text"
                                        ng-model="v.qty_fisik" ng-keyup="v.qty_selisih=(v.qty_fisik-v.qty_stock)"
                                        class="form-control input-sm no-border-text" placeholder="..." awnum='default'>
                                </td>
                                <td align="right" class="text-center bg-info"><input type="text"
                                        ng-model="v.qty_selisih" class="form-control input-sm no-border-text"
                                        placeholder="..." awnum='default' readonly>
                                </td>
                                <td class="p-0" class="text-center"><input type="text" ng-model="v.keterangan"
                                        class="form-control input-sm no-border-text" placeholder="...">
                                </td>
                                <td class="pointer" ng-click="delD(k)"><i class="fa fa-trash"></i></td>
                                <td class="pointer" ng-click="restoreD(k)"><i class="fa fa-refresh"></i></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success btn-sm" ng-click="addD()">Tambah Baris</button>
                </div>
            </div>
        </div>
    </div>
    <script>
    app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
        NgTableParams, SfService, FileUploader) {
        SfService.setUrl("<?=base_url()?>so_h");
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
                tanggal_so: moment().format("<?=date('Y-m-d')?>")
            };
            $scope.d = [];
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
            $scope.d.splice(k, 1);
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

        $scope.prin = function(id) {
            if (id == undefined) {
                var id = $scope.h[$scope.f.pk];
            }
            window.open(SfService.getUrl('/prin') + "?id=" + encodeURI(id), 'print_' + id,
                    'width=950,toolbar=0,resizable=0,scrollbars=yes,height=520,top=100,left=100')
                .focus();
        }

        $scope.getStock = function(id, fn) {
            SfService.get(SfService.getUrl("/getStock/" + id), {}, function(jdata) {
                $scope.d[fn].qty_stock = jdata.data.qty_stock;
                $scope.d[fn].qty_fisik = 0;
                $scope.d[fn].qty_selisih = $scope.d[fn].qty_fisik - $scope.d[fn].qty_stock;
                $scope.$apply();
                console.log($scope.d[fn].qty_stock);
                // return jdata.data;
            });
        }

        $scope.lookup = function(icase, fn) {
            switch (icase) {
                case 'd_barang':
                    SfLookup("<?=base_url()?>m_barang/lookup", function(id, name, json) {
                        $scope.d[fn].id_barang = id;
                        $scope.d[fn].nm_barang = json.nama;
                        $scope.d[fn].harga = json.harga_beli;
                        $scope.getStock(id, fn);


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
