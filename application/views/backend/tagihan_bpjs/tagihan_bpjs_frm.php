<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
<div class="ibox float-e-margins" ng-show="f.tab=='list'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <form enctype="multipart/form-data" action="<?=base_url()?>ReadExcel/importBpjs" method="post">
                <div class="input-group">
                    <input type="file" class="form-control" name="tagihanbpjs" />
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-info remove">
                            <span class="glyphicon glyphicon-upload"></span> Upload Data BPJS
                        </button>
                    </span>
                </div>
            </form>
        </div>
        <h3>Daftar Tagihan Bpjs</h3>
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
                    <!-- <td title="'Bulan Pelayanan'" filter="{bulan_pelayanan: 'text'}" sortable="'bulan_pelayanan'"> -->
                        <!-- {{v.tgl_pelayanan|date:'mm-yyyy'}}</td> -->
                    <td title="'No Fpk'" filter="{no_fpk: 'text'}" sortable="'no_fpk'">{{v.no_fpk}}</td>
                    <td title="'Obat'" filter="{barang: 'text'}" sortable="'barang'">{{v.nama}}</td>
                    <td title="'Ref Asal Resep'" filter="{ref_asal: 'text'}" sortable="'ref_asal'">{{v.ref_asal}}</td>
                    <td title="'Jenis Resep'" filter="{jenis: 'text'}" sortable="'jenis'">{{v.jenis}}</td>
                    <td title="'No Kartu Bpjs'" filter="{no_kartu: 'text'}" sortable="'no_kartu'">{{v.no_kartu}}</td>
                    <td title="'No Resep'" filter="{no_resep: 'text'}" sortable="'no_resep'">{{v.no_resep}}</td>
                    <td title="'Tgl Pelayanan'" filter="{tgl_pelayanan: 'text'}" sortable="'tgl_pelayanan'">
                        {{v.tgl_pelayanan}}</td>
                    <td title="'Jumlah Obat'" filter="{qty: 'text'}" sortable="'qty'">{{v.qty}}</td>
                    <td title="'Biaya Tagihan'" filter="{tagihan: 'text'}" sortable="'tagihan'">{{v.tagihan}}</td>
                    <td title="'Jumlah Obat Disetujui'" filter="{qty_disetujui: 'text'}" sortable="'qty_disetujui'">
                        {{v.qty_disetujui}}</td>
                    <td title="'Biaya Disetujui'" filter="{tagihan_disetujui: 'text'}" sortable="'tagihan_disetujui'">
                        {{v.tagihan_disetujui}}</td>
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
            <button type="button" class="btn btn-sm btn-warning" ng-click="prin()" ng-if="f.crud=='u'">Cetak</button>
            <button type="button" class="btn btn-sm btn-danger" ng-click="del()" ng-if="f.crud=='u'">Hapus</button>
        </div>
        <h3>Form Tagihan Bpjs</h3>
    </div>
    <div class="ibox-content frmEntry">
        <div class="row">
            <div class="col-sm-4">
                <label title="id">ID</label>
                <input type="text" ng-model="h.id" class="form-control input-sm" readonly>
                <label title="bulan_pelayanan">Bulan Pelayanan</label>
                <input type="text" ng-model="h.bulan_pelayanan" class="form-control input-sm date">
                <label title="no_fpk">No FPK</label>
                <input type="text" ng-model="h.no_fpk" class="form-control input-sm">
                <label title="ref_asal">Ref Asal Resep</label>
                <input type="text" ng-model="h.ref_asal" class="form-control input-sm">
                <label title="jenis">Jenis Resep</label>
                <select ng-model="h.jenis" class="form-control input-sm">
                    <option ng-repeat="v in [['PRB','PRB']]" ng-value="v[0]">{{v[1]}}
                    </option>
                </select>
</div>
<div class="col-sm-4">
                <label title="no_kartu">No Kartu BPJS</label>
                <input type="text" ng-model="h.no_kartu" class="form-control input-sm" awnum="default">
                <label title="no_resep">No Resep</label>
                <input type="text" ng-model="h.no_resep" class="form-control input-sm" awnum="default">
                <label title="tgl_pelayanan">Tgl Pelayanan</label>
                <input type="text" ng-model="h.tgl_pelayanan" class="form-control input-sm date">
                <label title="obat">Obat</label>
                <input type="text" ng-model="h.obat" class="form-control input-sm">
                <label title="qty">Jumlah Obat</label>
                <input type="text" ng-model="h.qty" class="form-control input-sm" awnum="default">
                </div>
<div class="col-sm-4">
    <label title="tagihan">Biaya Tagihan</label>
                <input type="text" ng-model="h.tagihan" class="form-control input-sm" awnum="default">
                <label title="qty_disetujui">Jumlah Obat Disetujui</label>
                <input type="text" ng-model="h.qty_disetujui" class="form-control input-sm" awnum="default">
                <label title="tagihan_disetujui">Biaya Disetujui</label>
                <input type="text" ng-model="h.tagihan_disetujui" class="form-control input-sm" awnum="default">
                <label title="keterangan">Keterangan</label>
                <input type="text" ng-model="h.keterangan" class="form-control input-sm">
            </div>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
    NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?=base_url()?>tagihan_bpjs");
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
        window.open(SfService.getUrl('/prin') + "?id=" + encodeURI(id), 'print_' + id,
            'width=950,toolbar=0,resizable=0,scrollbars=yes,height=520,top=100,left=100').focus();
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
