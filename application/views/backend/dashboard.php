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
                            <h3 class="no-margins font-bold">Rp.{{(h.today.daget)?h.today.daget:0|number:0}}
                            </h3>
                            <div class="text-navy">
                                <h5>Penjualan Gadget</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3 class="no-margins font-bold">Rp.{{(h.today.makanan)?h.today.makanan:0|number:0}}</h3>
                            <div class="text-navy">
                                <h5>Penjualan Makanan</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3 class="no-margins font-bold">Rp.{{(h.today.pakaian)?h.today.pakaian:0|number:0}}
                            </h3>
                            <div class="text-navy">
                                <h5>Penjualan Pakaian</h5>
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
                            <h3 class="no-margins font-bold">Rp.{{(h.month.daget)?h.month.daget:0|number:0}}
                            </h3>
                            <div class="text-navy">
                                <h5>Penjualan Gadget</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3 class="no-margins font-bold">Rp.{{(h.month.makanan)?h.month.makanan:0|number:0}}</h3>
                            <div class="text-navy">
                                <h5>Penjualan Makanan</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3 class="no-margins font-bold">Rp.{{(h.month.pakaian)?h.month.pakaian:0|number:0}}
                            </h3>
                            <div class="text-navy">
                                <h5>Penjualan Pakaian</h5>
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
                                <td title="'Customer'" filter="{customer: 'text'}" sortable="'customer'" class="text-center">
                                    {{v.customer}}
                                </td>
                                <td title="'Tanggal Beli'" filter="{tanggal: 'text'}" sortable="'tanggal'"
                                    class="text-center">{{v.tanggal}}</td>
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
