export default function budgetmaterial($scope, $rootScope) {
    $rootScope.printtitle = "BUDGET SUMMARY - GLASS";
    $scope.project = JSON.parse(localStorage.getItem("pms_budget_summary_project"));
    $scope.summary = JSON.parse(localStorage.getItem("pms_budget_summary_print"));
    $scope.summoff = {
        area: 0,
        total: 0,
        sarea: 0,
        stotal: 0
    };
    let _area = 0;
    let _total = 0;
    let _sarea = 0;
    let _stotal = 0;
    $scope.summary.map(i => {
        _area += (+i.bgarea);
        _total += (+i.bgtotalcost);
        _sarea += (+i.bgshapedarea);
        _stotal += (+i.bgshapedtotalcost);
    })
   
    $scope.summoff = {
        area: _area,
        total: _total,
        sarea: _sarea,
        stotal: _stotal   
    }

    $scope.totalarea = (+_area) + (+_sarea);
    $scope.totalcost = (+_total) + (+_stotal);
}