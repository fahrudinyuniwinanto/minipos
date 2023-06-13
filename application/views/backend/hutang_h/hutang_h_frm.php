<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
<div class="ibox float-e-margins" ng-show="f.tab=='list'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-primary" ng-click="new()">Buat Baru</button>
        </div>
        <h3>Daftar Pembayaran Hutang</h3>
    </div>
    <div class="ibox-content form-inline">
        <div class="input-group m-b">
            <input type="text" ng-model="f.q" class="form-control input-sm" placeholder="" ng-enter="getList()">
            <span class="input-group-addon pointer" ng-click="getList()">Cari Suplier</span>
        </div>
        <div id="div1" class="table-responsive">
            <table ng-table="tableList" show-filter="false" class="table table-condensed table-bordered table-hover"
                style="white-space: nowrap;">
                <tr ng-repeat="(k,v) in $data" class="pointer" ng-click="read(v.id)">
                    <td title="'No'">{{k+1}}</td>
                    <td title="'ID'" filter="{id: 'text'}" sortable="'id'">{{v.id}}</td>
                    <td title="'Tanggal Bayar'" filter="{tanggal_bayar: 'text'}" sortable="'tanggal_bayar'"
                        align="center">
                        {{v.tanggal_bayar}}</td>
                    <td title="'Suplier'" filter="{vendor: 'text'}" sortable="'vendor'"><strong>{{v.vendor}}</strong></td>
                    <td title="'Total'" filter="{jumlah_bayar: 'text'}" sortable="'jumlah_bayar'" align="right">
                        <strong>{{v.jumlah_bayar|number}}</strong>
                    </td>
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
            <button ng-if="f.crud=='c'" type="button" class="btn btn-sm btn-primary" ng-click="save()">Simpan</button>
        </div>
        <h3>Form Pembayaran ke Vendor {{h.vendor}}</h3>
    </div>
    <div class="ibox-content frmEntry">
        <div class="row">
            <div class="col-sm-4">
                <label title="id_group1">Supplier <small class="text-navy pointer" ng-click="addSupplier()"><i
                            class="fa fa-plus-circle"></i>&nbsp;tambah supplier</small></label>
                <div class="input-group">
                    <input type="text" ng-model="h.vendor" class="form-control input-sm" placeholder="" readonly
                        required>
                    <span class="input-group-addon pointer" ng-click="lookup('vendor')"><i
                            class="fa fa-search"></i></span>
                </div>
                <label title="alamat">Alamat</label>
                <textarea ng-model="h.alamat" class="form-control input-sm" readonly></textarea>
            </div>
            <div class="col-sm-4">
                <label title="id">ID Pembayaran</label>
                <input type="text" awnum='default' ng-model="h.id" class="form-control" readonly>
                <label title="tanggal">Tanggal</label>
                <input type="text" ng-model="h.tanggal_bayar" class="form-control date" ng-readonly="f.crud=='u'"
                    required>
                    <label title="cara_bayar">Cara Bayar</label>
                <select ng-model="h.cara_bayar" class="form-control input-sm" ng-readonly="f.crud=='u'" required>
                    <option ng-repeat="v in [['CASH','CASH'],['TRANSFERBRI','TRANSFER BRI'],['TRANSFERBPD','TRANSFER BANK JATENG']]" ng-value="v[0]">{{v[1]}}
                    </option>
                </select>
            </div>
            <div class="col-sm-4">
                <table class="table invoice-total">
                    <tbody>
                        <tr>
                            <td style="width:10%"><strong>Jumlah Dana</strong></td>
                            <td>
                                <input ng-readonly="!h.vendor || f.crud=='u'" type="text" awnum='default'
                                    ng-model="h.dana" ng-value="h.dana|number:0" class="form-control"
                                    ng-keyup="grandTotal()" required>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:10%"><strong>Total</strong></td>
                            <td>
                                <input type="text" awnum='default' ng-value="h.jumlah_bayar|number:0"
                                    class="form-control" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:10%"><strong>Sisa Dana</strong></td>
                            <td>
                                <input type="text" awnum='default' ng-value="h.sisa|number:0" class="form-control"
                                    readonly>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-condensed" style="white-space: nowrap;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Faktur</th>
                            <th>Tanggal</th>
                            <th>Hutang</th>
                            <th ng-if="f.crud=='c'">Diangsur</th>
                            <th ng-if="f.crud=='c'">Sisa</th>
                            <th>Potongan Rp (-)</th>
                            <th>Pembulatan Rp (-)</th>
                            <th>Tambah Rp (+)</th>
                            <!-- <th>Keterangan</th> -->
                            <th>Alokasi</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="(k,v) in d" class="">
                            <td>{{k+1}}</td>
                            <td>{{v.no_faktur}}</td>
                            <td>{{v.tanggal}}</td>
                            <td align="right">{{v.total|number:0}}</td>
                            <td ng-if="f.crud=='c'" align="right">{{v.angsuran|number:0}}</td>
                            <td ng-if="f.crud=='c'" align="right"><strong>{{v.hutang|number:0}}</strong></td>
                            <td align="right" class='p-0'><input type="text" ng-readonly="f.crud=='u'"
                                    ng-model="v.potongan_rp" class="form-control input-sm no-border-text"
                                    ng-keyup="hitungRow(k)" placeholder="..." awnum='default'>
                            </td>
                            <td align="right" class='p-0'><input type="text" ng-readonly="f.crud=='u'"
                                    ng-model="v.pembulatan_rp" class="form-control input-sm no-border-text"
                                    ng-keyup="hitungRow(k)" placeholder="..." awnum='default'>
                            </td>
                            <td align="right" class='p-0'><input type="text" ng-readonly="f.crud=='u'"
                                    ng-model="v.tambah_rp" class="form-control input-sm no-border-text"
                                    ng-keyup="hitungRow(k)" placeholder="..." awnum='default'>
                            </td>
                            <!-- <td></td> -->
                            <td align="right" class='p-0'><input type="text" ng-readonly="f.crud=='u'"
                                    ng-model="v.alokasi" class="form-control input-sm no-border-text"
                                    ng-keyup="grandTotal()" placeholder="..." awnum='default'>
                            <td>
                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" ng-model="v.allow_pay" ng-checked="v.allow_pay==1"
                                            ng-true-value="1" ng-false-value="0" ng-click="setAlokasi()"
                                            class="onoffswitch-checkbox" id="example{{k}}">
                                        <label class="onoffswitch-label" for="example{{k}}">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
    NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?=base_url()?>hutang_h");
    $scope.f = {
        crud: 'c',
        tab: 'list',
        pk: 'id'
    };
    $scope.h = {}; //tabel hutang dan vendor
    $scope.d = []; //tabel beli_h join hutang_d

    $scope.new = function() {

        $scope.f.tab = 'frm';
        $scope.f.crud = 'c';
        $scope.h = {
            // tanggal_bayar: moment().format('YYYY/MM/DD'),
        };
        $scope.d = [];
        angular.element('#dana').focus();
    }


    // $scope.checkChanged = function(k, allowpay) {
    //     if (!$scope.h.dana) {
    //         swal('', 'Isikan dana dahulu', 'warning');
    //         $scope.d[k].allow_pay = 0;
    //         return false;
    //     }
    //     console.log($scope.d[k]);
    //     if ($scope.d[k].allow_pay == 0) {
    //         $scope.d[k].bayar = 0;
    //         $scope.d[k].potongan_rp = 0;
    //         $scope.d[k].pembulatan_rp = 0;
    //         $scope.d[k].tambah_rp = 0;
    //         $scope.d[k].alokasi = 0;
    //     }
    //     $scope.hitungRow(k);
    // }
    $scope.hitungRow = function(k) {
        let totalrow = 0;
        let total = $scope.d[k].total == null ? 0 : $scope.d[k].total;
        let angsuran = $scope.d[k].angsuran == null ? 0 : $scope.d[k].angsuran;
        let potongan_rp = $scope.d[k].potongan_rp == null ? 0 : $scope.d[k].potongan_rp;
        let pembulatan_rp = $scope.d[k].pembulatan_rp == null ? 0 : $scope.d[k].pembulatan_rp;
        let tambah_rp = $scope.d[k].tambah_rp == null ? 0 : $scope.d[k].tambah_rp;
        let sisa = parseFloat(total) - parseFloat(angsuran);

        if ($scope.d[k].allow_pay == 1) { //jika nilai 0 maka alokasi dikosongkan
            totalrow = (parseFloat(sisa) - parseFloat(potongan_rp) -
                parseFloat(pembulatan_rp) + parseFloat(tambah_rp));
        } else {
            $scope.d[k].alokasi = 0;
        }
        $scope.d[k].alokasi = totalrow;
        console.log($scope.d);
        $scope.grandTotal();

    }

    $scope.setAlokasi = () => {

        var dana = $scope.h.dana;
        angular.forEach($scope.d, function(v, k) {
            if (v.allow_pay == 1) {
                var nilai = Math.round((v.total - v.angsuran - v.potongan_rp - v.pembulatan_rp - v
                    .tambah_rp)/1)*1;
                if (nilai > dana) {
                    $scope.d[k].alokasi = dana;
                    dana = dana - dana;
                } else {
                    $scope.d[k].alokasi = nilai;

                    dana = dana - nilai;
                }
            } else {
                $scope.d[k].alokasi = 0;
            }

            $scope.grandTotal();
        })
    }


    $scope.grandTotal = function() {
        let total = 0;
        let dana = $scope.h.dana == null ? 0 : $scope.h.dana;
        let sisa = $scope.h.sisa == null ? 0 : $scope.h.sisa;
        angular.forEach($scope.d, function(v, k) {
            let dalokasi = v.alokasi == null ? 0 : v.alokasi;
            total = parseFloat(total) + parseFloat(dalokasi);
        });
        $scope.h.jumlah_bayar = parseFloat(total);
        $scope.h.sisa = parseFloat(dana) - parseFloat($scope.h.jumlah_bayar);

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

        if ($scope.h.dana != Math.round($scope.h.jumlah_bayar)) {
            swal('', 'Jumlah dana harus sama dengan total bayar', 'warning');
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
            $scope.grandTotal();
            // $("input").attr('readonly', true);
            // $("select").attr('readonly', true);
            // $("textarea").attr('readonly', true);
        });
    }


    $scope.readByIdVendor = function(idvendor) {
        SfService.get(SfService.getUrl("/readByIdVendor/" + idvendor), {}, function(jdata) {
            $scope.f.tab = 'frm';
            $scope.f.crud = 'c';
            $scope.h = jdata.data.h;
            $scope.d = jdata.data.d;
            $scope.grandTotal();
            $scope.h.tanggal_bayar = moment().format('YYYY/MM/DD');
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
            case 'beli':
                SfLookup("<?=base_url()?>beli_h/lookup", function(id, name, json) {
                    console.log(json);
                    $scope.h.id_beli = id;
                    $scope.h.nm_beli = id;
                    $scope.$apply();
                });
                break;
            case 'vendor':
                SfLookup("<?=base_url()?>m_supplier/lookup", function(id, name, json) {
                    $scope.h.id_vendor = id;
                    $scope.h.vendor = name;
                    $scope.h.alamat = json.alamat;

                    $scope.readByIdVendor(id);

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