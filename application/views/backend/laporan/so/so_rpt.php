<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
<h3>Laporan Stock Opname</h3>
<hr>
<div class="">
    <div class="col-md-3">
        <label>Cabang</label>
        <select ng-model="cabang" class="form-control input-sm">
            <option ng-repeat="v in [['WR001','Temanggung'],['WR002','Tembarak']]" ng-value="v[0]">{{v[1]}}</option>
        </select>
    </div>

    <br style="clear: both;">

    <div id="pil-tanggal">
        <div class="col-md-3">
            <label>Dari Tanggal</label>
            <input type="text" class="date form-control input-sm" ng-model="date1">
        </div>

    </div>


    <div class="col-md-3">
        <label>&nbsp;</label>
        <button class="btn btn-success btn-block btn-sm" type="button" ng-click="cetak()">Cetak</button>
    </div>
</div>
<script>
$(document).ready(function() {

});
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
    NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?= base_url() ?>laporan");
    $scope.f = {
        crud: 'c',
        tab: 'list',
        // pk: 'id'
    };
    $scope.h = {};
    $scope.cabang = "<?=getSession('id_cabang')?>";
    $scope.date1 = moment().format("<?=date('Y/m/d')?>");

    $scope.cetak = function() {
        if (!$scope.date1) {
            swal("", "Pilih tanggal SO dahulu!", "error");
            return false;
        }
        window.open(SfService.getUrl("/prinSo?date1=" + $scope.date1 + "&cabang=" + $scope.cabang));
    }



}]);
</script>
