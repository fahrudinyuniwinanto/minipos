<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
<div class="ibox float-e-margins" ng-show="f.tab=='list'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-primary" ng-click="new()">Buat Baru</button>
        </div>
        <h3>Daftar Pembayaran Piutang</h3>
    </div>
    <div class="ibox-content form-inline">
        <div class="input-group m-b">
            <input type="text" ng-model="f.q" class="form-control input-sm" placeholder="" ng-enter="getList()">
            <span class="input-group-addon pointer" ng-click="getList()">Cari Dokter</span>
        </div>
        <div id="div1" class="table-responsive">
            <table ng-table="tableList" show-filter="false" class="table table-condensed table-bordered table-hover"
                style="white-space: nowrap;">
                <tr ng-repeat="(k,v) in $data" class="pointer" ng-click="read(v.id)"
                ng-class="v.jenis_pembayaran=='DOKEL'?'success':(v.jenis_pembayaran=='MK'?'warning':'info')">
                    <td title="'No'">{{k+1}}</td>
                    <td title="'ID'" filter="{id: 'text'}" sortable="'id'">{{v.id}}</td>
                    <td title="'Jenis'" filter="{jenis_pembayaran: 'text'}" sortable="'jenis_pembayaran'">
                        {{v.jenis_pembayaran}}</td>
                    <td title="'Tanggal Bayar'" filter="{tanggal_bayar: 'text'}" sortable="'tanggal_bayar'"
                        align="center">
                        {{v.tanggal_bayar}}</td>
                    <td title="'Dokter'" filter="{dokter: 'text'}" sortable="'dokter'"><strong>{{v.dokter}}</strong></td>
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
        <h3>Form Piutang {{h.dokter}} {{h.jenis_pembayaran}}</h3>
    </div>
    <div class="ibox-content frmEntry">
        <div class="row">
            <div class="col-sm-4">
                <label title="jenis_pembayaran">Jenis</label>
                <select ng-model="h.jenis_pembayaran" class="form-control input-sm" ng-change="changeJenis()"
                    ng-disabled="f.crud=='u'" required>
                    <option ng-repeat="v in [['MK','MITRA KERJA'],['DOKEL','DOKTER KELUARGA']]" ng-value="v[0]">{{v[1]}}
                    </option>
                </select>
                <label title="id_group1">Dokter <small class="text-navy pointer" ng-click="addDokter()"><i
                            class="fa fa-plus-circle"></i>&nbsp;tambah dokter</small></label>
                <div class="input-group">
                    <input type="text" ng-model="h.dokter" class="form-control input-sm" placeholder="" readonly
                        required>
                    <span class="input-group-addon pointer" ng-hide="!h.jenis_pembayaran || f.crud=='u'"
                        ng-click="lookup('dokter')"><i class="fa fa-search"></i></span>
                </div>
                <label title="alamat">Alamat</label>
                <textarea ng-model="h.alamat" class="form-control input-sm" readonly></textarea>
            </div>
            <div class="col-sm-4">
                <label title="id">ID Piutang</label>
                <input type="text" awnum='default' ng-model="h.id" class="form-control" readonly>
                <!-- <label title="shift">Shift</label>
                <select ng-model="h.shift" class="form-control input-sm" ng-disabled="f.crud=='u'" required>
                    <option ng-repeat="v in [['PAGI','PAGI'],['SIANG','SIANG']]" ng-value="v[0]">{{v[1]}}
                    </option>
                </select> -->
                <label title="tanggal">Tanggal</label>
                <input type="text" ng-model="h.tanggal_bayar" class="form-control date" ng-readonly="f.crud=='u'"
                    ng-readonly="!h.id_dokter">
                <label title="cara_bayar">Cara Bayar</label>
                <select ng-model="h.cara_bayar" class="form-control input-sm" ng-disabled="f.crud=='u'" required>
                    <option
                        ng-repeat="v in [['CASH','CASH'],['TRANSFERBRI','TRANSFER BRI'],['TRANSFERBPD','TRANSFER BANK JATENG']]"
                        ng-value="v[0]">
                        {{v[1]}}
                    </option>
                </select>
            </div>
            <div class="col-sm-4">
                <table class="table invoice-total">
                    <tbody>
                        <tr>
                            <td style="width:10%"><strong>Jumlah Dana</strong></td>
                            <td>
                                <input type="text" ng-readonly="!h.dokter || f.crud=='u'" awnum='default'
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
                            <th>No. Penjualan</th>
                            <th>Tanggal</th>
                            <th>Piutang (Rp)</th>
                            <th ng-if="f.crud=='c'">Diangsur</th>
                            <th ng-if="f.crud=='c'">Sisa</th>
                            <th>Potongan Rp (-)</th>
                            <th>Pembulatan Rp (-)</th>
                            <th>Tambah Rp (+)</th>
                            <th>Alokasi</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="(k,v) in d" class="">
                            <td>{{k+1}}</td>
                            <td>{{v.no_trs}}</td>
                            <td>{{v.tanggal}}</td>
                            <td align="right">{{v.total|number:0}}</td>
                            <td ng-if="f.crud=='c'" align="right">{{v.angsuran|number:0}}</td>
                            <td ng-if="f.crud=='c'" align="right">{{v.hutang|number:0}}</td>
                            <td align="right" class='p-0'><input type="text" ng-model="v.potongan_rp"
                                    ng-readonly="f.crud=='u'" class="form-control input-sm no-border-text"
                                    ng-keyup="hitungRow(k)" placeholder="..." awnum='default'>
                            </td>
                            <td align="right" class='p-0'><input type="text" ng-model="v.pembulatan_rp"
                                    ng-readonly="f.crud=='u'" class="form-control input-sm no-border-text"
                                    ng-keyup="hitungRow(k)" placeholder="..." awnum='default'>
                            </td>
                            <td align="right" class='p-0'><input type="text" ng-model="v.tambah_rp"
                                    ng-readonly="f.crud=='u'" class="form-control input-sm no-border-text"
                                    ng-keyup="hitungRow(k)" placeholder="..." awnum='default'>
                            </td>
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
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
    NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?=base_url()?>piutang_h");
    $scope.f = {
        crud: 'c',
        tab: 'list',
        pk: 'id'
    };
    $scope.h = {
        shift: "<?=getSession('shift')?>"
    };
    $scope.d = [];

    $scope.new = function() {
        $scope.f.tab = 'frm';
        $scope.f.crud = 'c';
        $scope.h = {
            // tanggal_bayar: moment().format('YYYY/MM/DD')
        };
        $scope.d = [];
        angular.element('#dana').focus();
    }

    $scope.changeJenis = () => {
        $scope.h = {
            tanggal_bayar: moment().format('YYYY/MM/DD'),
            id_dokter: "",
            dokter: "",
            alamat: "",
            jenis_pembayaran: $scope.h.jenis_pembayaran
        };
        $scope.d = [];
    }

    $scope.hitungRow = function(k) {
        let totalrow = 0;
        let total = $scope.d[k].total == null ? 0 : $scope.d[k].total;
        let angsuran = $scope.d[k].angsuran == null ? 0 : $scope.d[k].angsuran;
        let potongan_rp = $scope.d[k].potongan_rp == null ? 0 : $scope.d[k].potongan_rp;
        let pembulatan_rp = $scope.d[k].pembulatan_rp == null ? 0 : $scope.d[k].pembulatan_rp;
        let tambah_rp = $scope.d[k].tambah_rp == null ? 0 : $scope.d[k].tambah_rp;

        if ($scope.d[k].allow_pay == 1) { //jika nilai 0 maka alokasi dikosongkan
            totalrow = (parseFloat(total) - parseFloat(angsuran) - parseFloat(potongan_rp) -
                parseFloat(
                    pembulatan_rp) + parseFloat(tambah_rp));
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
        console.log('total ' + total);
        grandtotal = parseFloat(total);
        $scope.h.jumlah_bayar = grandtotal;
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
        if (SfFormValidate('.frmEntry') == false || !$scope.h.shift || !$scope.h.cara_bayar) {
            swal('', 'Data not valid', 'error');
            return false;
        }

        if ($scope.h.dana != Math.floor($scope.h.jumlah_bayar)) {
            console.log('dana=' + $scope.h.dana + " bayar=" + Math.floor($scope.h.jumlah_bayar));
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
        });
    }

    $scope.readByIdDokter = function(iddokter) {
        SfService.get(SfService.getUrl("/readByIdDokter/" + iddokter + "/" + $scope.h
            .jenis_pembayaran), {}, function(jdata) {
            $scope.f.tab = 'frm';
            $scope.f.crud = 'c';
            $scope.h = jdata.data.h;
            $scope.d = jdata.data.d;
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
            case 'jual':
                SfLookup("<?=base_url()?>jual_h/lookup", function(id, name, json) {
                    console.log(json);
                    $scope.h.id_jual = id;
                    $scope.h.nm_jual = id;
                    $scope.$apply();
                });
                break;
            case 'dokter':
                SfLookup("<?=base_url()?>m_customer/lookup", function(id, name, json) {
                    console.log(json);
                    $scope.h.id_dokter = id;
                    $scope.h.dokter = name;
                    $scope.h.alamat = json.alamat;
                    $scope.readByIdDokter(id);
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