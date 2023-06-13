<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
<div class="ibox float-e-margins" ng-show="f.tab=='list'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-primary" ng-click="new()">Buat Baru</button>
        </div>
        <h3>Daftar Jual_h</h3>
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
                    <td title="'Tanggal Jual'" filter="{id: 'text'}" sortable="'id'">{{v.tanggal}}</td>
                    <td title="'Customer'" filter="{id_customer: 'text'}" sortable="'id_customer'">{{v.id_customer}}</td>
                    <td title="'Purchase Order'" filter="{id_po: 'text'}" sortable="'id_po'">{{v.id_po}}</td>
                    <td title="'Jenis Ppn'" filter="{jenis_ppn: 'text'}" sortable="'jenis_ppn'">{{v.jenis_ppn}}</td>
                    <td title="'Potongan Persen'" filter="{potongan_persen: 'text'}" sortable="'potongan_persen'">{{v.potongan_persen}}</td>
                    <td title="'Potongan Rp'" filter="{potongan_rp: 'text'}" sortable="'potongan_rp'">{{v.potongan_rp}}</td>
                    <td title="'Tanggal Jatuh Tempo'" filter="{jatuh_tempo: 'text'}" sortable="'jatuh_tempo'">{{v.jatuh_tempo}}</td>
                    <td title="'Dp'" filter="{dp: 'text'}" sortable="'dp'">{{v.dp}}</td>
                    <td title="'Cara Bayar'" filter="{cara_bayar: 'text'}" sortable="'cara_bayar'">{{v.cara_bayar}}</td>
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
        <h3>Form Jual_h</h3>
    </div>
    <div class="ibox-content frmEntry">
        <div class="row">
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-md-4">
                        <label title="id">ID</label>
                        <input type="text" ng-model="h.id" class="form-control input-sm" readonly>
                    </div>
                    <div class="col-md-8">
                        <label title="id_po">No Purchase Order</label>
                        <input type="text" ng-model="h.id_po" class="form-control input-sm">
                    </div>
                </div>
                <label title="tanggal">Tanggal</label>
                <div class="input-group">
                    <input type="text" ng-model="h.tanggal" class="form-control input-sm date" placeholder="">
                    <span class="input-group-addon"><i class="fa fa-calendar" ng-click="h.tanggal"></i></span>
                </div>
                <label title="id_customer">Customer <small class="text-navy pointer" ng-click="addSupplier()"><i class="fa fa-plus-circle"></i>&nbsp;tambah customer</small></label>
                <div class="input-group">
                    <input type="text" ng-model="h.nm_customer" class="form-control input-sm" placeholder="" readonly>
                    <span class="input-group-addon pointer" ng-click="lookup('customer')"><i class="fa fa-search"></i></span>
                </div>
                <label title="jenis_ppn">Jenis PPN</label>
                <input type="text" ng-model="h.jenis_ppn" class="form-control input-sm">
                <label title="potongan_persen">Potongan Persen</label>
                <div class="input-group">
                    <input type="text" ng-model="h.potongan_persen" class="form-control input-sm" placeholder="">
                    <span class="input-group-addon">%</span>
                </div>
                <label title="potongan_rp">Potongan Rp</label>
                <div class="input-group">
                    <input type="text" ng-model="h.potongan_rp" class="form-control input-sm" placeholder="" awnum="default">
                    <span class="input-group-addon">%</span>
                </div>
            </div>
            <div class="col-sm-4">

                <label title="jatuh_tempo">Tanggal Jatuh Tempo</label>
                <div class="input-group">
                    <input type="text" ng-model="h.jatuh_tempo" class="form-control input-sm date" placeholder="">
                    <span class="input-group-addon"><i class="fa fa-calendar" ng-click="h.jatuh_tempo"></i></span>
                </div>
                <label title="keterangan">Keterangan</label>
                <input type="text" ng-model="h.keterangan" class="form-control input-sm">
                <label title="dp">DP</label>
                <div class="input-group">
                    <input type="text" ng-model="h.dp" class="form-control input-sm" placeholder="" awnum="default">
                    <span class="input-group-addon">%</span>
                </div>
                <label title="cara_bayar">Cara Bayar</label>
                <input type="text" ng-model="h.cara_bayar" class="form-control input-sm">
            </div>
            <div class="col-sm-4">
                <label title="biaya1">Biaya1</label>
                <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" ng-model="h.biaya1" class="form-control input-sm" placeholder="" awnum="default">
                </div>
                <label title="keterangan_biaya1">Keterangan Biaya1</label>
                <input type="text" ng-model="h.keterangan_biaya1" class="form-control input-sm">
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

        $scope.new = function() {
            $scope.f.tab = 'frm';
            $scope.f.crud = 'c';
            // $scope.h = {
            //     tanggal: moment().format('YYYY/MM/DD')
            // };
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


        $scope.addCustomer = function(id) {
            if (id == undefined) {
                var id = $scope.h[$scope.f.pk];
            }
            window.open('<?= base_url() ?>/m_customer', '', 'width=950,toolbar=0,resizable=0,scrollbars=yes,height=520,top=100,left=100').focus();
        }

        $scope.lookup = function(icase, fn) {
            switch (icase) {
                case 'customer':
                    SfLookup("<?= base_url() ?>m_customer/lookup", function(id, name, json) {
                        $scope.h.id_customer = id;
                        $scope.h.nm_customer = name;
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
