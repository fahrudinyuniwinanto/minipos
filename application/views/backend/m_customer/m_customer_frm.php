<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
<div class="ibox float-e-margins" ng-show="f.tab=='list'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-primary" ng-click="new()">Buat Baru</button>
        </div>
        <h3>Daftar Customer</h3>
    </div>
    <div class="ibox-content form-inline">
        <div class="input-group m-b">
            <input type="text" ng-model="f.q" class="form-control input-sm" placeholder="" ng-enter="getList()">
            <span class="input-group-addon pointer" ng-click="getList()">Cari</span>
        </div>
        <div id="div1" class="table-responsive">
            <table ng-table="tableList" show-filter="false" class="table table-condensed table-bordered table-hover"
                style="white-space: nowrap;">
                <tr ng-repeat="(k,v) in $data" class="pointer" ng-click="read(v.id)" ng-class="v.cicilan?'warning':''">
                    <td title="'No'">{{k+1}}</td>
                    <td title="'Id'" filter="{id: 'text'}" sortable="'id'">{{v.id}}</td>
                    <td title="'Nama'" filter="{nama: 'text'}" sortable="'nama'">{{v.nama}}</td>
                    <td title="'Cicilan'" filter="{cicilan: 'text'}" sortable="'cicilan'" class="text-right">{{v.cicilan|number}}</td>
                    <td title="'Total Hutang'" filter="{hutang: 'text'}" sortable="'hutang'" class="text-right">{{v.cicilan?v.hutang:''|number}}</td>
                    <td title="'Alamat'" filter="{alamat: 'text'}" sortable="'alamat'">{{v.alamat}}</td>
                    <td title="'Kode Pos'" filter="{kode_pos: 'text'}" sortable="'kode_pos'">{{v.kode_pos}}</td>
                    <td title="'Telp'" filter="{telp: 'text'}" sortable="'telp'">{{v.telp}}</td>
                    <td title="'Fax'" filter="{fax: 'text'}" sortable="'fax'">{{v.fax}}</td>
                    <td title="'Npwp'" filter="{npwp: 'text'}" sortable="'npwp'">{{v.npwp}}</td>
                    <td title="'Contact Persons'" filter="{cp: 'text'}" sortable="'cp'">{{v.cp}}</td>
                    <td title="'Jenis Customer'" filter="{jenis: 'text'}" sortable="'jenis'">{{v.jenis}}</td>
                    <td title="'Nik'" filter="{ktp: 'text'}" sortable="'ktp'">{{v.ktp}}</td>
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
        <h3>Form {{f.page}}</h3>
    </div>
    <div class="ibox-content frmEntry">
        <div class="row">
            <div class="col-sm-4">
                <label title="id">ID</label>
                <input type="text" ng-model="h.id" class="form-control input-sm" readonly>
                <label title="nama">Nama</label>
                <input type="text" ng-model="h.nama" class="form-control input-sm text-uppercase" required>
                <label title="alamat">Alamat</label>
                <textarea ng-model="h.alamat" class="form-control input-sm"></textarea>
                <label title="kode_pos">Kode Pos</label>
                <input type="text" ng-model="h.kode_pos" class="form-control input-sm numeric">
                <label title="telp">Telpon</label>
                <input type="text" ng-model="h.telp" class="form-control input-sm">
            </div>
            <div class="col-sm-4">
                <label title="fax">Fax</label>
                <input type="text" ng-model="h.fax" class="form-control input-sm numeric">
                <label title="npwp">NPWP</label>
                <input type="text" ng-model="h.npwp" class="form-control input-sm numeric">
                <label title="cp">Contact Persons</label>
                <input type="text" ng-model="h.cp" class="form-control input-sm">
                <label title="jenis">Jenis Objek</label>
                <select ng-model="h.jenis" class="form-control input-sm">
                    <option ng-repeat="v in [['UMUM','UMUM'],['MK','MITRA KERJA'],['DINAS','DINAS ATAU LEMBAGA']]"
                        ng-value="v[0]">{{v[1]}}</option>
                </select>
                <label title="ktp">NIK</label>
                <input type="text" ng-model="h.ktp" class="form-control input-sm numeric">
            </div>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
    NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?=base_url()?>m_customer");
    $scope.f = {
        crud: 'c',
        tab: 'list',
        pk: 'id',
        page: 'Customer',
    };
    $scope.h = {};
    <?php if ($page == 'CUSTOMER'): ?>
    $scope.f.page = "Customer";
    $scope.h.jenis = "UMUM";
    <?php elseif ($page == 'DOKTER'): ?>
    $scope.f.page = "Dokter";
    $scope.h.jenis = "MK";
    <?php endif?>

    <?php if ($directNew == 1): ?>
    $scope.f.tab = 'frm';
    $("body").addClass("mini-navbar");
    <?php endif?>


    $scope.new = function() {
        $scope.f.tab = 'frm';
        $scope.f.crud = 'c';
        $scope.h = {
            jenis: "UMUM",
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