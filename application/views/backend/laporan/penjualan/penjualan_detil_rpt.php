<!-- //Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode -->
<!doctype html>
<h3>Laporan Penjualan</h3>
<hr>
<div class="">
    <div id="pil-tanggal">
        <div class="col-md-3">
            <label>Dari Tanggal</label>
            <input type="text" class="date form-control input-sm" ng-model="date1">
        </div>
        <div class="col-md-3">
            <label>Sampai Tanggal</label>
            <input type="text" class="date form-control input-sm" ng-model="date2">
        </div>
    </div>
    <div id="pil-bulan">

        <div class="col-md-3">
            <label>Bulan</label>
            <select class="form-control input-sm" name="bulan" ng-model="bulan">
                <!-- <option selected="selected">Bulan</option> -->
                <?php
                $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                $jlh_bln = count($bulan);
                for ($c = 0; $c < $jlh_bln; $c++) {
                    $vbln = $c+1;
                    echo "<option value=$vbln> $bulan[$c] </option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <label>Tahun </label>
            <select class="form-control input-sm" name="tahun" ng-model="tahun">
                <?php
                $data_tahun = $this->db
                    ->query("select distinct year(tanggal) as tahun from jual_h")->result();
                foreach ($data_tahun as $kjd => $vjd) :
                    echo "<option value=$vjd->tahun> $vjd->tahun </option>";
                endforeach;

                ?>
            </select>
        </div>
    </div>
    <div id="pil-tahun">
        <div class="col-md-3">
            <label>Tahun </label>
            <select class="form-control input-sm" name="tahun" ng-model="tahun">
                <?php
                $data_tahun = $this->db
                    ->query("select distinct year(tanggal) as tahun from jual_h")->result();
                foreach ($data_tahun as $kjd => $vjd) :
                    echo "<option value=$vjd->tahun> $vjd->tahun </option>";
                endforeach;

                ?>
            </select>

        </div>
    </div>
    <div class="col-md-3">
        <label>&nbsp;</label>
        <button class="btn btn-success btn-block btn-sm" type="button" ng-click="cetak()">Cetak</button>
    </div>
</div>
<script>
$(document).ready(function() {
    $("#pil-bulan").hide();
    $("#pil-tahun").hide();

    $('#pilihan').on('change', function() {
        if (this.value == 'tanggal') {
            $("#pil-tanggal").show();
            $("#pil-bulan").hide();
            $("#pil-tahun").hide();
        } else if (this.value == 'bulan') {
            $("#pil-tanggal").hide();
            $("#pil-bulan").show();
            $("#pil-tahun").hide();
        } else if (this.value == 'tahun') {
            $("#pil-tanggal").hide();
            $("#pil-bulan").hide();
            $("#pil-tahun").show();
        } else {
            $("#pil-tanggal").hide();
            $("#pil-bulan").hide();
            $("#pil-tahun").hide();
        }
    });
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
    $scope.date1 = moment().format("YYYY/01/01");
    $scope.date2 = moment().format("YYYY/MM/DD");

    $scope.cetak = function() {
        if (moment($scope.date1).format("YYYY") != moment($scope.date2).format("YYYY")) {
            swal("", "Range tanggal harus dalam tahun yang sama!", "error");
            return false;
        }
      

        window.open(SfService.getUrl("/prinPenjualanDetil?date1=" + $scope.date1 + "&date2=" + $scope
            .date2));
    }



}]);
</script>
