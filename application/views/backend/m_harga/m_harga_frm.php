<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
<div class="ibox float-e-margins" ng-show="f.tab=='list'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-primary" ng-click="new()">Buat Baru</button>
        </div>
        <h3>Daftar Harga</h3>
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
                    <td title="'Cabang'" filter="{id_cabang: 'text'}" sortable="'id_cabang'">{{v.id_cabang}}</td>
                    <td title="'Satuan'" filter="{id_satuan: 'text'}" sortable="'id_satuan'">{{v.id_satuan}}</td>
                    <td title="'Jenis Customer'" filter="{jenis_customer: 'text'}" sortable="'jenis_customer'">{{v.jenis_customer}}</td>
                    <td title="'Harga Jual'" filter="{harga_jual: 'text'}" sortable="'harga_jual'">{{v.harga_jual}}</td>
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
        <h3>Form Harga</h3>
    </div>
    <div class="ibox-content frmEntry">
        <div class="row">
            <div class="col-sm-4">
                <label title="id">ID</label>
                <input type="text" ng-model="h.id" class="form-control input-sm" readonly>
                <label title="id_cabang">Cabang</label>
                <div class="input-group">
                    <input type="text" ng-model="h.nm_cabang" class="form-control input-sm" placeholder="" required>
                    <span class="input-group-addon pointer" ng-click="lookup('cabang')">Cari</span>
                </div>
                <label title="id_satuan">Satuan</label>
                <div class="input-group">
                    <input type="text" ng-model="h.nm_satuan" class="form-control input-sm" placeholder="" required>
                    <span class="input-group-addon pointer" ng-click="lookup('satuan')">Cari</span>
                </div>
                <label title="jenis_customer">Jenis Customer</label>
                <select ng-model="h.jenis_customer" class="form-control input-sm">
                    <option ng-repeat="v in [['UMUM','UMUM'],['MK','MITRA KERJA'],['DINAS','DINAS ATAU LEMBAGA']]" ng-value="v[0]">{{v[1]}}</option>
                </select>
                <label title="harga_jual">Harga Jual</label>
                <div class="input-group ">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" ng-model="h.harga_jual" class="form-control input-sm numeric">
                </div>
            </div>
        </div>
    </div>
    <script>
        app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
            SfService.setUrl("<?= base_url() ?>m_harga");
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
                    case 'cabang':
                        SfLookup("<?= base_url() ?>m_cabang/lookup", function(id, name, json) {
                            $scope.h.id_cabang = id;
                            $scope.h.nm_cabang = name;
                            $scope.$apply();
                        });
                        break;
                    case 'satuan':
                        SfLookup("<?= base_url() ?>m_satuan/lookup", function(id, name, json) {
                            $scope.h.id_satuan = id;
                            $scope.h.nm_satuan = name;
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
