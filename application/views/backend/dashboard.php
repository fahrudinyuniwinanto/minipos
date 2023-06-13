<div class="wrapper wrapper-content">
    <div class="row">


        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right"><?=tanggal_indo(date('Y-m-d'))?></span>
                    <h5>Penjualan hari ini</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="no-margins font-bold">Rp.{{(h.today.umum.total)?h.today.umum.total:0|number:0}}
                            </h3>
                            <div class="text-navy">
                                <h5>{{(h.today.umum.jml)?h.today.umum.jml:0|number:0}} Penjualan Umum</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3 class="no-margins font-bold">Rp.{{(h.today.mk.total)?h.today.mk.total:0|number:0}}</h3>
                            <div class="text-navy">
                                <h5>{{(h.today.mk.jml)?h.today.mk.jml:0|number:0}}
                                    Penjualan MK</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3 class="no-margins font-bold">Rp.{{(h.today.resep.total)?h.today.resep.total:0|number:0}}
                            </h3>
                            <div class="text-navy">
                                <h5>{{(h.today.resep.jml)?h.today.resep.jml:0|number:0}}
                                    Penjualan Resep</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right"><?=date('M Y')?></span>
                    <h5>Penjualan bulan ini</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="no-margins font-bold">
                                Rp.{{(h.thismonth.umum.total)?h.thismonth.umum.total:0|number:0}}</h3>
                            <div class="text-navy">
                                <h5>{{(h.thismonth.umum.jml)?h.thismonth.umum.jml:0|number:0}} Penjualan Umum</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3 class="no-margins font-bold">
                                Rp.{{(h.thismonth.mk.total)?h.thismonth.mk.total:0|number:0}}</h3>
                            <div class="text-navy">
                                <h5>{{(h.thismonth.mk.jml)?h.thismonth.mk.jml:0|number:0}} Penjualan MK</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3 class="no-margins font-bold">
                                Rp.{{(h.thismonth.resep.total)?h.thismonth.resep.total:0|number:0}}</h3>
                            <div class="text-navy">
                                <h5>{{(h.thismonth.resep.jml)?h.thismonth.resep.jml:0|number:0}} Penjualan Resep</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>List Penjualan Terakhir</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-3 m-b-xs">
                            <div class="input-group"><input type="text" placeholder="Cari No Transaksi" ng-model="f.q"
                                    class="input-sm form-control" ng-enter="getList()"> <span class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-primary" ng-click="getList()">
                                        Cari</button> </span></div>
                        </div>
                        <div class="col-sm-9">
                        </div>
                    </div>
                    <div class="table-responsive" ng-show="f.tab=='list'">
                        <table ng-table="tableList" show-filter="false"
                            class="table table-condensed table-bordered table-hover" style="white-space: nowrap;">
                            <tr ng-repeat="(k,v) in $data" class="">
                                <td title="'No'" align="center">{{k+1}}</td>
                                <td title="'No Transaksi'" filter="{no_trs: 'text'}" sortable="'no_trs'">{{v.no_trs}}
                                </td>
                                <td title="'Jenis'" filter="{jenis: 'text'}" sortable="'jenis'" class="text-center">
                                    {{v.jenis}}
                                </td>
                                <td title="'Tanggal Beli'" filter="{tanggal: 'text'}" sortable="'tanggal'"
                                    class="text-center">{{v.tanggal}}</td>
                                <td title="'Customer'" filter="{id_suplier: 'text'}" sortable="'id_suplier'"
                                    align="center">{{v.nm_customer}}</td>
                                <!-- <td title="'No PO'" filter="{id_po: 'text'}" sortable="'id_po'">{{v.id_po}}</td> -->
                                <td title="'Total'" filter="{total: 'text'}" sortable="'total'" class="text-right">
                                    {{v.total|number:0}}</td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
<div class="footer">
    <div class="pull-right">
        10GB of <strong>250GB</strong> Free.
    </div>
    <div>
        <strong>Copyright</strong> Example Company &copy; 2014-2015
    </div>
</div>

</div>
<!-- ChartJS-->
<script src="<?=base_url()?>/assets/vendor/inspinia/js/plugins/chartJs/Chart.min.js"></script>
<script type="text/javascript">
app.controller('mainCtrl', ['$scope', '$http', 'NgTableParams', 'SfService', 'FileUploader', function($scope, $http,
    NgTableParams, SfService, FileUploader) {
    SfService.setUrl("<?=base_url()?>backend");
    $scope.f = {
        crud: 'c',
        tab: 'list',
        pk: 'id'
    };
    $scope.h = {};
    $scope.c = {};

    $scope.getList = function() {
        $scope.tableList = new NgTableParams({}, {
            getData: function($defer, params) {
                var $btn = $('button').button('loading');
                return $http.get("<?=base_url()?>jual_h/getList", {
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

    $scope.getTot = function() {
        var $btn = $('button').button('loading');
        return $http.get(SfService.getUrl("/getTot"), {
            params: {}
        }).then(function(jdata) {
            $scope.h = jdata.data.h;
            $scope.c = jdata.data.c;
        }, function(error) {
            $btn.button('reset');
            swal('', error.data, 'error');
        });

    }
    $scope.getTot();
    $scope.getList();

}]);
</script>

<script>
$(document).ready(function() {

    var lineData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
                label: "Example dataset",
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
                label: "Example dataset",
                fillColor: "rgba(26,179,148,0.5)",
                strokeColor: "rgba(26,179,148,0.7)",
                pointColor: "rgba(26,179,148,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(26,179,148,1)",
                data: [28, 48, 40, 19, 86, 27, 90]
            }
        ]
    };

    var lineOptions = {
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        bezierCurve: true,
        bezierCurveTension: 0.4,
        pointDot: true,
        pointDotRadius: 4,
        pointDotStrokeWidth: 1,
        pointHitDetectionRadius: 20,
        datasetStroke: true,
        datasetStrokeWidth: 2,
        datasetFill: true,
        responsive: true,
    };


    var ctx = document.getElementById("lineChart").getContext("2d");
    var m
    yNewChart = new Chart(ctx).Line(lineData, lineOptions);

});
</script>
