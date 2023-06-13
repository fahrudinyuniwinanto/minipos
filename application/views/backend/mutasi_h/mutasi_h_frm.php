<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
<div class="ibox float-e-margins" ng-show="f.tab=='list'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-primary" ng-click="new()">Buat Baru</button>
        </div>
        <h3>Daftar Mutasi Barang</h3>
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
                    <td title="'Tanggal'" filter="{tanggal: 'text'}" sortable="'tanggal'">{{v.tanggal|date:'medium'}}</td>
                    <td title="'Total'" filter="{total: 'text'}" sortable="'total'" align='right'><strong>{{v.total|number:0}}</strong></td>
                    <td title="'Dari Cabang'" filter="{dari: 'text'}" sortable="'dari'">{{v.dari=='WR001'?'Waringin Temanggung':'Waringin Tembarak'}}</td>
                    <td title="'Ke Cabang'" filter="{ke: 'text'}" sortable="'ke'">{{v.ke=='WR001'?'Waringin Temanggung':'Waringin Tembarak'}}</td>
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
        <h3>Form Mutasi Barang</h3>
    </div>
    <div class="ibox-content frmEntry">
        <div class="row">
            <div class="col-sm-4">
                <label title="id">Id</label>
                <input type="text" ng-model="h.id" class="form-control input-sm" readonly>
                <label title="tanggal">Tanggal</label>
                <input type="text" ng-model="h.tanggal" class="form-control input-sm date">
            </div>
            <div class="col-sm-4">
                <label title="dari">Dari Cabang</label>
                <select ng-model="h.dari" class="form-control input-sm">
                    <option ng-repeat="v in [['WR001','Waringin Temanggung'],['WR002','Waringin Tembarak']]"
                        ng-value="v[0]">{{v[1]}}</option>
                </select>
                <label title="ke">Ke Cabang</label>
                <select ng-model="h.ke" class="form-control input-sm">
                    <option ng-repeat="v in [['WR001','Waringin Temanggung'],['WR002','Waringin Tembarak']]"
                        ng-value="v[0]">{{v[1]}}</option>
                </select>
            </div>
            <div class="col-sm-4">
                <table class="table invoice-total">
                    <tbody>
                        <tr>
                            <td class="total" style="width:10%"><strong>Total Akhir</strong></td>
                            <td class="total total-val">
                                <input type="text" awnum='default' ng-model="h.total" class="form-control"
                                    style="text-align: right;font-size:20px;marginpx;" readonly>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <table class="table table-bordered table-hover table-condensed" style="white-space: nowrap;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>Qty</th>
                    <th>Hrg Satuan</th>
                    <th>Total</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="(k,v) in d" class="">
                    <td>{{k+1}}</td>
                    <td ng-click="lookup('d_barang',k)">
                        <div class="" title="ID: {{v.id_barang}}">
                            <span class="text-success"><i class="fa fa-search"></i>&nbsp;</span>{{v.nm_barang}}
                        </div>
                    </td>
                    <td>{{v.id_satuan}}</td>
                    <td class='p-0'><input type="text" ng-model="v.qty"
                            class="form-control input-sm no-border-text" ng-keyup="hitungRow(k)" placeholder="..."
                            awnum='default'></td>
                    <td class="p-0"><input type="text" ng-model="v.hrg_satuan" awnum="default"
                            class="form-control input-sm no-border-text" readonly></td>
                    <td class="p-0"><input type="text" ng-model="v.total" awnum="default"
                            class="form-control input-sm no-border-text" readonly></td>
                    <td><button class="btn btn-danger btn-xs" ng-click="delD(k)">Hapus</button></td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-success btn-sm" ng-click="addD()">Tambah Barang</button>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
    NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?=base_url()?>mutasi_h");
    $scope.f = {
        crud: 'c',
        tab: 'list',
        pk: 'id'
    };
    $scope.h = {
        tanggal: moment().format('YYYY/MM/DD'),
    };

    $scope.d = [];
    $scope.hitungRow = function(k) {
        let hrg_satuan = $scope.d[k].hrg_satuan == null ? 0 : $scope.d[k].hrg_satuan;
        let qty = $scope.d[k].qty == null ? 0 : $scope.d[k].qty;

        let totalrow = (qty * hrg_satuan);
        $scope.d[k].total = totalrow;
        console.log($scope.d);
        $scope.grandTotal();
    }


    $scope.grandTotal = function() {
        let total = 0;
        angular.forEach($scope.d, function(v, k) {
            let dtotal = v.total == null ? 0 : v.total;
            total = parseFloat(total) + parseFloat(dtotal);
        });
        console.log('total ' + total);
        //data header
        grandtotal = parseFloat(total)
        $scope.h.total = grandtotal;
    }


    $scope.new = function() {
        $scope.f.tab = 'frm';
        $scope.f.crud = 'c';
        $scope.h = {
            tanggal: moment().format('YYYY/MM/DD'),
            dari: "<?=getSession('id_cabang')?>",
            ke: "<?=getSession('id_cabang')=='WR001'?'WR002':'WR001'?>",
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
        $scope.d.splice(k, 1);
        $scope.hitungRow(k);
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
            'width=950,toolbar=0,resizable=0,scrollbars=yes,height=520,top=100,left=100').focus();
    }



    $scope.lookup = function(icase, fn) {
        switch (icase) {
            case 'd_barang':
                SfLookup("<?=base_url()?>m_barang/lookup", function(id, name, json) {
                    $scope.d[fn].id_barang = id;
                    $scope.d[fn].nm_barang = json.nama;
                    $scope.d[fn].id_satuan = json.id_satuan;
                    $scope.d[fn].hrg_satuan = json.harga_beli;
                    $scope.d[fn].qty = 1;
                    $scope.hitungRow(fn);
                    // $scope.d[fn].total = (json.harga_beli * 1);
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