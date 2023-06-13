<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
<div class="ibox float-e-margins" ng-show="f.tab=='list'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-primary" ng-click="new()">Buat Baru</button>
        </div>
        <h3>Daftar Barang</h3>
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
                    <td title="'ID'" filter="{id: 'text'}" sortable="'id'">{{v.id}}</td>
                    <!-- <td title="'Tipe'" filter="{nama: 'text'}" sortable="'nama'">{{v.tipe}}</td> -->
                    <td title="'Barcode'" filter="{barcode: 'text'}" sortable="'barcode'" class="text-center">
                        {{v.barcode?v.barcode:'-'}}</td>
                    <td title="'Nama'" filter="{nama: 'text'}" sortable="'nama'">{{v.nama}}</td>
                    <!-- <td title="'Group'" filter="{id_group1: 'text'}" sortable="'id_group1'">
                        <span ng-show="v.nm_group1">{{v.nm_group1}}</span>
                    </td> -->
                    <!-- <td title="'Rak'" filter="{rak: 'text'}" sortable="'rak'" class="text-center">{{v.rak}}</td> -->
                    <td title="'Harga Beli'" filter="{harga_beli: 'text'}" sortable="'harga_beli'" class="text-right">
                        {{v.harga_beli|number}}</td>
                    <td title="'Harga Jual'" filter="{harga_jual: 'text'}" sortable="'harga_jual'" class="text-right">
                        {{v.harga_jual|number}}</td>
                    <td title="'Satuan'" filter="{id_satuan: 'text'}" sortable="'id_satuan'" class="text-center">
                        {{v.id_satuan}}</td>
                    <!-- <td title="'Stok Pusat'" filter="{stok_pusat: 'text'}" sortable="'stok_pusat'" class="text-center">
                        {{v.stok_pusat}}</td> -->
                    <td title="'Stock'" filter="{stock: 'text'}" sortable="'stock'" class="text-center">
                        {{v.stock}}</td>
                    <!-- <td title="'30 NOV WR1'" filter="{qty_sawal: 'text'}" sortable="'qty_sawal'" class="text-center">
                        {{v.qty_sawal}}</td>
                    <td title="'30 NOV WR2'" filter="{qty_sawal_cabang2: 'text'}" sortable="'qty_sawal_cabang2'"
                        class="text-center">
                        {{v.qty_sawal_cabang2}}</td> -->
                    <!--  <td title="'Stok Min'" class="text-center"><span ng-show="v.stok_min">{{v.stok_min}}
                            {{v.id_satuan}}</span></td>
                    <td title="'Stok Maks'" class="text-center"><span ng-show="v.stok_maks">{{v.stok_maks}}
                            {{v.id_satuan}}</span></td> -->
                    <!-- <td title="'Diijinkan'">
                        <span ng-if="v.is_beli=='Y'" class="label label-info">Beli</span>
                        <span ng-if="v.is_jual=='Y'" class="label label-info">Jual</span>
                        <span ng-if="v.is_retur_beli=='Y'" class="label label-info">Retur Beli</span>
                        <span ng-if="v.is_retur_jual=='Y'" class="label label-info">Retur Jual</span>
                        <span ng-if="v.is_mutasi=='Y'" class="label label-info">Mutasi</span>
                    </td> -->
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
        <h3>Form Barang</h3>
    </div>
    <div class="ibox-content frmEntry">
        <div class="row">
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-4">
                        <label title="id">ID</label>
                        <input type="text" ng-model="h.id" class="form-control input-sm" readonly>
                    </div>
                    <div class="col-sm-8">
                        <label title="barcode">Barcode</label>
                        <input type="text" ng-model="h.barcode" class="form-control input-sm" ng-keyup="validasi()">
                    </div>
                </div>


                <label title="nama">Nama</label>
                <input type="text" ng-model="h.nama" class="form-control input-sm text-uppercase" required>

                <label title="id_group1">Group <small class="text-navy pointer" ng-click="addGroup1()"><i
                            class="fa fa-plus-circle"></i>&nbsp;tambah group</small></label>
                <div class="input-group">
                    <input type="text" ng-model="h.nm_group1" class="form-control input-sm" placeholder="" readonly>
                    <span class="input-group-addon pointer" ng-click="lookup('group1')"><i
                            class="fa fa-search"></i></span>
                </div>
                
                <!--
                <label title="id_group2">Sub Group 1 <small class="text-navy pointer" ng-click="addGroup2()"><i
                            class="fa fa-plus-circle"></i>&nbsp;tambah group 1</small></label>
                <div class="input-group">
                    <input type="text" ng-model="h.nm_group2" class="form-control input-sm" placeholder="" readonly>
                    <span class="input-group-addon pointer" ng-click="lookup('group2')"><i
                            class="fa fa-search"></i></span>
                </div>
                <label title="id_group3">Sub Group 2 <small class="text-navy pointer" ng-click="addGroup3()"><i
                            class="fa fa-plus-circle"></i>&nbsp;tambah group2</small></label>
                <div class="input-group">
                    <input type="text" ng-model="h.nm_group3" class="form-control input-sm" placeholder="" readonly>
                    <span class="input-group-addon pointer" ng-click="lookup('group3')"><i
                            class="fa fa-search"></i></span>
                </div> -->



            </div>
            <div class="col-sm-4">
                <!-- <label title="tipe">Tipe</label>
                <select ng-model="h.tipe" class="form-control input-sm" required>
                    <option ng-repeat="v in [['BRGJD','BARANG JADI']]" ng-value="v[0]">{{v[1]}}</option>
                </select> -->

                <label title="nm_satuan">Satuan</label>
                <div class="input-group">
                    <input type="text" ng-model="h.nm_satuan" class="form-control input-sm" placeholder="" required
                        readonly>
                    <span ng-if="f.crud=='u'" class="input-group-addon pointer" ng-click="hasTransaction()"><i
                            class="fa fa-search"></i></span>
                    <span ng-if="f.crud=='c'" class="input-group-addon pointer" ng-click="lookup('satuan')"><i
                            class="fa fa-search"></i></span>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label title="stok_min">Stok Min</label>
                        <input type="text" ng-model="h.stok_min" class="form-control input-sm numeric">
                    </div>
                    <div class="col-sm-6">
                        <label title="stok_maks">Stok Maks</label>
                        <input type="text" ng-model="h.stok_maks" class="form-control input-sm numeric">
                    </div>
                </div>
                <div class="row">
                <div class="col-sm-6">
                    <label title="harga_beli">Harga Beli</label>
                    <div class="input-group ">
                        <span class="input-group-addon">Rp</span>
                        <input type="text" ng-model="h.harga_beli" class="form-control input-sm" awnum="default" required>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <!-- <label title="ed">Tanggal Kadaluarsa (ED)</label>
                <input type="text" ng-model="h.ed" class="form-control input-sm date"> -->
                        </div>
                        </div>


            </div>
            <div class="col-sm-4">

                <div class="row">
                    <div class="col-sm-6">
                        <label title="is_beli">dibeli</label>
                        <select ng-model="h.is_beli" class="form-control input-sm">
                            <option ng-repeat="v in [['Y','BOLEH'],['N','TIDAK']]" ng-value="v[0]">{{v[1]}}</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label title="is_jual">dijual</label>
                        <select ng-model="h.is_jual" class="form-control input-sm">
                            <option ng-repeat="v in [['Y','BOLEH'],['N','TIDAK']]" ng-value="v[0]">{{v[1]}}</option>
                        </select>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-6">
                        <label title="is_retur_jual">diretur Jual</label>
                        <select ng-model="h.is_retur_jual" class="form-control input-sm">
                            <option ng-repeat="v in [['Y','BOLEH'],['N','TIDAK']]" ng-value="v[0]">{{v[1]}}</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label title="is_retur_beli">diretur Beli</label>
                        <select ng-model="h.is_retur_beli" class="form-control input-sm">
                            <option ng-repeat="v in [['Y','BOLEH'],['N','TIDAK']]" ng-value="v[0]">{{v[1]}}</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label title="is_mutasi">dimutasi</label>
                        <select ng-model="h.is_mutasi" class="form-control input-sm">
                            <option ng-repeat="v in [['Y','BOLEH'],['N','TIDAK']]" ng-value="v[0]">{{v[1]}}</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label title="ppn_include">PPN Include</label>
                        <select ng-model="h.ppn_include" class="form-control input-sm">
                            <option ng-repeat="v in [['Y','BOLEH'],['N','TIDAK']]" ng-value="v[0]">{{v[1]}}</option>
                        </select>
                    </div>
                </div>
            </div>


        </div>
        <div class="row">
            <hr>
            <div class="col-md-4">
                <div class="table-responsive">
                    <h4>Konversi Satuan</h4>
                    <table class="table table-bordered table-hover table-condensed" style="white-space: nowrap;">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Satuan</th>
                                <th class="text-center">Qty</th>
                                <th colspan="2" class="text-center">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="(k,v) in kvr" ng-class="{'terhapus':v.isactive==0}">
                                <td>{{k+1}}</td>
                                <td class="pointer" ng-click="lookup('d_satuan',k)">
                                    <div class="" title="ID: {{v.satuan_konversi}}"><span class="text-success"><i
                                                class="fa fa-search"></i>&nbsp;</span>{{v.nm_satuan_konversi}}</div>
                                </td>
                                <td class="p-0" class="text-center"><input type="text" ng-model="v.qty_konversi"
                                        class="form-control input-sm no-border-text" placeholder="..."></td>
                                <td class="pointer" ng-click="delD(k)"><i class="fa fa-trash"></i></td>
                                <td class="pointer" ng-click="restoreD(k)"><i class="fa fa-refresh"></i></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success btn-sm" ng-click="addD()"
                        ng-class="f.level_user==3?'hide':''">Tambah Baris</button>
                </div>
            </div>
            <div class="col-md-8">
                <div class="table-responsive">
                    <h4>Harga Jual (Rp)</h4>
                    <table class="table table-bordered table-hover table-condensed" style="white-space: nowrap;">
                        <thead>
                            <tr>
                                <th class="text-center">SATUAN</th>
                                <th ng-repeat="(a,b) in cus" class="text-center">{{b.jenis_customer}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="(k,v) in kvr" ng-class="{'terhapus':v.isactive==0}">
                                <td> {{v.satuan_konversi}} </td>
                                <td ng-repeat="(a,b) in cus">
                                    <input class="form-control input-sm no-border-text text-right" type="text"
                                        ng-model="hj[v.satuan_konversi][b.id]['rp']" readonly awnum="default" />
                                    <!-- {{h.harga_beli*(hj[v.satuan_konversi][b.id]/100)|number}} -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- <button type="button" class="btn btn-success btn-sm" ng-click="addD()">Tambah Baris</button> -->
                </div>
            </div>
            <div class="col-md-8">
                <div class="table-responsive">
                    <h4>Laba (%)</h4>
                    <table class="table table-bordered table-hover table-condensed" style="white-space: nowrap;">
                        <thead>
                            <tr>
                                <th class="text-center">SATUAN</th>
                                <th ng-repeat="(a,b) in cus" class="text-center">{{b.jenis_customer}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="(k,v) in kvr" ng-class="{'terhapus':v.isactive==0}">
                                <td class="bg-info"> {{v.satuan_konversi}} </td>
                                <!-- <td class="text-right bg-info" ng-repeat="(a,b) in cus">{{(((hj[v.satuan_konversi][b.id]/kvr[k]['qty_konversi'])-h.harga_beli)/h.harga_beli*100).toFixed(2)}}%</td> -->
                                <td class="text-right bg-info" ng-repeat="(a,b) in cus">
                                    <input type="text" ng-keyup="hitungLaba(v.satuan_konversi,b.id)"
                                        ng-model="hj[v.satuan_konversi][b.id]['prc']"
                                        class="form-control input-sm no-border-text text-right" placeholder="..."
                                        awnum="default">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- <button type="button" class="btn btn-success btn-sm" ng-click="addD()">Tambah Baris</button> -->
                </div>
            </div>

            <hr>
        </div>
    </div>
</div>
<script>
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
    NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?=base_url()?>m_barang");
    $scope.f = {
        crud: 'c',
        tab: 'list',
        pk: 'id'
    };
    <?php if ($directNew == 1): ?>
    $scope.f.tab = 'frm';
    $("body").addClass("mini-navbar");
    <?php endif?>
    $scope.h = {};
    $scope.kvr = [];
    $scope.hj = {};


    $scope.new = function() {
        $scope.f.tab = 'frm';
        $scope.f.crud = 'c';
        $scope.h = {
            tanggal: moment().format('YYYY/MM/DD')
        };
        $scope.kvr = [];
        $scope.hj = {};

        $scope.cus = [{
                "id": "MK",
                "jenis_customer": "MK/PANEL",
            },
            {
                "id": "RESEP",
                "jenis_customer": "RESEP",
            },
            {
                "id": "UMUM",
                "jenis_customer": "UMUM",
            }
        ];

        console.log($scope.hj);

        $scope.h.is_jual = 'Y';
        $scope.h.is_beli = 'Y';
        $scope.h.is_mutasi = 'Y';
        $scope.h.is_retur_beli = 'Y';
        $scope.h.is_retur_jual = 'Y';
    }

    $scope.copy = function() {
        $scope.f.crud = 'c';
        $scope.h[$scope.f.pk] = '';
    }


    $scope.addD = function() {
        $scope.kvr.push({
            isactive: 1
        });

        //$scope.hj[?][b]=sdf
    }


    $scope.delD = function(k) {
        // $scope.kvr[k].isactive = 0;
        $scope.kvr.splice(k, 1);
    }

    $scope.restoreD = function(k) {
        // $scope.kvr[k].isactive = 1;
    }


    $scope.getList = function() {
        $scope.tableList = new NgTableParams({}, {
            counts: [10, 50, 100, 250, 500, 1000, 2000, 5000],
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
            hj: $scope.hj,
            kvr: $scope.kvr,
        }, function(jdata) {
            console.log(jdata);
            $scope.f.tab = 'list';
            $scope.getList();
        });
    }

    $scope.read = function(id) {
        SfService.get(SfService.getUrl("/read/" + id), {}, function(jdata) {
            console.log(jdata.data.hj);
            $scope.f.tab = 'frm';
            $scope.f.crud = 'u';
            $scope.h = jdata.data.h;
            $scope.hj = jdata.data.hj;
            // $scope.hj = Object.assign({}, jdata.data.hj);
            $scope.cus = jdata.data.cus;
            // $scope.hrg = jdata.data.hrg;
            $scope.kvr = jdata.data.kvr;
        });
    }


    $scope.validasi = function() {
        SfService.post(SfService.getUrl("/validasi"), {
            h: $scope.h
        }, function(jdata) {
            if (jdata.data != "") {
                swal('', jdata.data, 'warning');
                $scope.h.barcode = "";
            }
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


    $scope.addGroup1 = function() {
        window.open("<?=base_url()?>m_group?direct_new=1", '',
            'width=950,toolbar=0,resizable=0,scrollbars=yes,height=520,top=100,left=100').focus();
    }

    $scope.addGroup2 = function() {
        window.open("<?=base_url()?>m_group_d?direct_new=1", '',
            'width=950,toolbar=0,resizable=0,scrollbars=yes,height=520,top=100,left=100').focus();
    }

    $scope.addGroup3 = function() {
        window.open("<?=base_url()?>m_group_d2?direct_new=1", '',
            'width=950,toolbar=0,resizable=0,scrollbars=yes,height=520,top=100,left=100').focus();
    }

    $scope.hasTransaction = function() {
        console.log($scope.h);
        SfService.post(SfService.getUrl("/hasTransaction"), {
            h: $scope.h
        }, function(jdata) {
            console.log(jdata);
            if (jdata.data > 0) {
                swal('', "Barang sudah sudah terjual, satuan barang sudah tidak bisa dirubah",
                    'warning');
            } else {
                $scope.lookup('satuan');
            }
        });
    }

    $scope.hitungLaba = function(sat, jnscust) {
        let harga_beli = $scope.h.harga_beli == null ? 0 : $scope.h.harga_beli;
        let prc = $scope.hj[sat][jnscust]['prc'] == null ? 0 : $scope.hj[sat][jnscust]['prc'];
        $scope.hj[sat][jnscust]['rp'] = parseInt(harga_beli) + (parseInt(harga_beli) * parseInt(prc) /
            100);
    }

    $scope.lookup = function(icase, fn) {
        switch (icase) {
            case 'group1':
                SfLookup("<?=base_url()?>m_group/lookup", function(id, name, json) {
                    $scope.h.id_group1 = id;
                    $scope.h.nm_group1 = name;
                    $scope.$apply();
                });
                break;
            case 'group2':
                SfLookup("<?=base_url()?>m_group_d/lookup", function(id, name, json) {
                    $scope.h.id_group2 = id;
                    $scope.h.nm_group2 = name;
                    $scope.$apply();
                });
                break;
            case 'group3':
                SfLookup("<?=base_url()?>m_group_d2/lookup", function(id, name, json) {
                    $scope.h.id_group3 = id;
                    $scope.h.nm_group3 = name;
                    $scope.$apply();
                });
                break;
            case 'satuan':
                SfLookup("<?=base_url()?>m_satuan/lookup", function(id, name, json) {
                    $scope.h.id_satuan = id;
                    $scope.h.nm_satuan = name;
                    $scope.$apply();
                });
                break;
            case 'd_satuan':
                SfLookup("<?=base_url()?>m_satuan/lookup", function(id,
                    name, json) {
                    $scope.kvr[fn].satuan_konversi = json.id;
                    $scope.kvr[fn].nm_satuan_konversi = name;
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