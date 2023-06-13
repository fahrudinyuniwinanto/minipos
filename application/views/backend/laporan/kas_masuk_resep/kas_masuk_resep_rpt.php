<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
<h3>Laporan Kas Masuk Resep</h3>
<hr>
<div class="">
    <div class="col-md-3">
        <label>Dari Tanggal</label>
        <input type="text" class="date form-control input-sm" ng-model="date1">
    </div>
    <div class="col-md-3">
        <label>Sampai Tanggal</label>
        <input type="text" class="date form-control input-sm" ng-model="date2">
    </div>
    <div class="col-md-3">
        <label>&nbsp;</label>
        <button class="btn btn-success btn-block btn-sm" type="button" ng-click="cetak()">Cetak</button>
    </div>
</div>
<script>
    app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http, NgTableParams, SfService, FileUploader) {
        SfService.setUrl("<?=base_url()?>laporan");
        $scope.f = {
            crud: 'c',
            tab: 'list',
            // pk: 'id'
        };
        $scope.h = {};
        $scope.date1 = moment().format("YYYY/01/01");
        $scope.date2 = moment().format("YYYY/MM/DD");

        $scope.cetak = function() {
            if (moment($scope.date1).format("YYYY") != moment($scope.date2).format("YYYY")) {
                swal("", "Range tanggal harus dalam tahun yang sama!", "error");
                return false;
            }
            window.open(SfService.getUrl("/prinKasMasukResep?date1=" + $scope.date1 + "&date2=" + $scope.date2));
        }


    }]);
</script>
