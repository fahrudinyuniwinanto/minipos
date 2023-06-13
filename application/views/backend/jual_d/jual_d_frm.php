<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
<div class="ibox float-e-margins" ng-show="f.tab=='list'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-primary" ng-click="new()">Buat Baru</button>
        </div>
        <h3>Daftar Jual_d</h3>
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
                                                                        <td title="'Id'" filter="{id: 'text'}" sortable="'id'">{{v.id}}</td>
                                                                                                <td title="'Id Penjualan'" filter="{id_penjualan: 'text'}" sortable="'id_penjualan'">{{v.id_penjualan}}</td>
                                                                                                <td title="'Barang'" filter="{id_barang: 'text'}" sortable="'id_barang'">{{v.id_barang}}</td>
                                                                                                <td title="'Qty Entry'" filter="{qty_entry: 'text'}" sortable="'qty_entry'">{{v.qty_entry}}</td>
                                                                                                <td title="'Satuan Entry'" filter="{satuan_entry: 'text'}" sortable="'satuan_entry'">{{v.satuan_entry}}</td>
                                                                                                <td title="'Harga Satuan'" filter="{harga_satuan: 'text'}" sortable="'harga_satuan'">{{v.harga_satuan}}</td>
                                                                                                <td title="'Harga'" filter="{harga: 'text'}" sortable="'harga'">{{v.harga}}</td>
                                                                                                <td title="'Qty'" filter="{qty: 'text'}" sortable="'qty'">{{v.qty}}</td>
                                                                                                <td title="'Diskon Persen'" filter="{diskon_persen: 'text'}" sortable="'diskon_persen'">{{v.diskon_persen}}</td>
                                                                                                <td title="'Diskon Rp'" filter="{diskon_rp: 'text'}" sortable="'diskon_rp'">{{v.diskon_rp}}</td>
                                                                                                <td title="'Ppn Persen'" filter="{ppn_persen: 'text'}" sortable="'ppn_persen'">{{v.ppn_persen}}</td>
                                                                                                <td title="'Ppn Rp'" filter="{ppn_rp: 'text'}" sortable="'ppn_rp'">{{v.ppn_rp}}</td>
                                                                                                <td title="'Hpp'" filter="{hpp: 'text'}" sortable="'hpp'">{{v.hpp}}</td>
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
        <h3>Form Jual_d</h3>
    </div>
    <div class="ibox-content frmEntry">
        <div class="row">
            <div class="col-sm-4">
                                                            <label title="id">ID</label>
                                                                <input type="text" ng-model="h.id" class="form-control input-sm">
                                                                                <label title="id_penjualan">ID Penjualan</label>
                                                                <input type="text" ng-model="h.id_penjualan" class="form-control input-sm">
                                                                                <label title="id_barang">Barang</label>
                                                                <input type="text" ng-model="h.id_barang" class="form-control input-sm">
                                                                                <label title="qty_entry">Qty Entry</label>
                                                                <input type="text" ng-model="h.qty_entry" class="form-control input-sm">
                                                                                <label title="satuan_entry">Satuan Entry</label>
                                                                <input type="text" ng-model="h.satuan_entry" class="form-control input-sm">
                                                                                <label title="harga_satuan">Harga Satuan</label>
                                                                <input type="text" ng-model="h.harga_satuan" class="form-control input-sm">
                                                                                <label title="harga">Harga</label>
                                                                <input type="text" ng-model="h.harga" class="form-control input-sm">
                                                                                <label title="qty">Qty</label>
                                                                <input type="text" ng-model="h.qty" class="form-control input-sm">
                                                                                <label title="diskon_persen">Diskon Persen</label>
                                                                <input type="text" ng-model="h.diskon_persen" class="form-control input-sm">
                                                                                <label title="diskon_rp">Diskon Rp</label>
                                                                <input type="text" ng-model="h.diskon_rp" class="form-control input-sm">
                                                                                <label title="ppn_persen">PPN Persen</label>
                                                                <input type="text" ng-model="h.ppn_persen" class="form-control input-sm">
                                                                                <label title="ppn_rp">PPN Rp</label>
                                                                <input type="text" ng-model="h.ppn_rp" class="form-control input-sm">
                                                                                <label title="hpp">HPP</label>
                                                                <input type="text" ng-model="h.hpp" class="form-control input-sm">
                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
        </div>
    </div>
</div>
<script>
    app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
        SfService.setUrl("<?=base_url()?>jual_d");
        $scope.f = {
            crud: 'c',
            tab: 'list',
            pk: 'id'
        };
        $scope.h = {};

        $scope.new = function() {
            $scope.f.tab = 'frm';
            $scope.f.crud = 'c';
            $scope.h = {
                tanggal: moment().format('YYYY/MM/DD')
            };
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
                h: $scope.h
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
            window.open(SfService.getUrl('/prin') + "?id=" + encodeURI(id), 'print_' + id, 'width=950,toolbar=0,resizable=0,scrollbars=yes,height=520,top=100,left=100').focus();
        }

        $scope.lookup = function(icase, fn) {
            switch (icase) {
                // case 'id_mustahik':
                //     SfLookup("<?=base_url()?>master_mustahik/lookup", function(id,name,json) {
                //         $scope.h.id_mustahik=id;
                //         $scope.h.nm_mustahik=name;
                //         $scope.$apply();
                //     });
                //     break;
                default:
                    swal('Pilihan tidak tersedia');
                    break;
            }
        }

        $scope.getList();

    }]);
</script>
