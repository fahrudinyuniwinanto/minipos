<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
<div class="ibox float-e-margins" ng-show="f.tab=='list'">
    <div class="ibox-title">
        <div class="pull-right form-inline">
            <button type="button" class="btn btn-sm btn-primary" ng-click="new()">Buat Baru</button>
        </div>
        <h3>Form Entry Qty Stok Awal</h3>
    </div>
    <div class="ibox-content form-inline">
        <div class="input-group m-b">
            <input type="text" ng-model="f.q" class="form-control input-sm" placeholder="" ng-enter="getList()">
            <span class="input-group-addon pointer" ng-click="getList()">Cari</span>
        </div>
        <div id="div1" class="table-responsive">
            <table ng-table="tableList" show-filter="false" class="table table-condensed table-bordered table-hover"
                style="white-space: nowrap;">
                <tr ng-repeat="(k,v) in $data">
                    <td title="'No'">{{k+1}}</td>
                    <td title="'ID'" filter="{id: 'text'}" sortable="'id'">{{v.id}}</td>
                    <td title="'Barcode'" filter="{barcode: 'text'}" sortable="'barcode'" class="text-center">
                        {{v.barcode?v.barcode:'-'}}</td>
                    <td title="'Nama'" filter="{nama: 'text'}" sortable="'nama'">{{v.nama}}</td>
                    <td title="'Satuan'" filter="{id_satuan: 'text'}" sortable="'id_satuan'" class="text-center">
                        {{v.id_satuan}}</td>
                        <td title="'Qty Stock Awal'" class="p-0"><input type="text" class="form-control input-sm no-border-text" ng-keyup="saveRow(v.id,$event.target.value)" value="{{v.qty_sawal}}"></td>
                </tr>
            </table>
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


    $scope.saveRow=function(id,val){
        SfService.post(SfService.getUrl('/saveRow'), {
            id: id,
            val: val,
        }, function(jdata) {
            console.log(jdata);
            // swal('', jdata.data, 'success');
        });
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

    $scope.prin = function(id) {
        if (id == undefined) {
            var id = $scope.h[$scope.f.pk];
        }
        window.open(SfService.getUrl('/prin') + "?id=" + encodeURI(id), 'print_' + id,
            'width=950,toolbar=0,resizable=0,scrollbars=yes,height=520,top=100,left=100').focus();
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
