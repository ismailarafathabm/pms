export function ams_project_summary($scope, $rootScope) {
    $rootScope.printtitle = "PROJECT SUMMARY";
    $scope.printdata = JSON.parse(localStorage.getItem("ams_print_projectsummary"));
    const _contval = $scope.printdata.reduce((a, b) => a + (+b.excelcontractval), 0);
    const _additional = $scope.printdata.reduce((a, b) => a + (+b.exceladditional), 0);
    const _asperactual = $scope.printdata.reduce((a, b) => a + (+b.excelasperval), 0);
    const _projecval = $scope.printdata.reduce((a, b) => a + (+b.exceltotalvalue), 0);

    $scope.sumoff = {
        _contval,
        _additional,
        _asperactual,
        _projecval,
    };
}

export function ams_project_downpayment($scope, $rootScope) {
    $rootScope.printtitle = "PROJECT DOWNPAYMENT SUMMARY";
    $scope.printdata = JSON.parse(localStorage.getItem("ams_print_projectdownpayment"));
    console.log($scope.printdata)
    const _contval = $scope.printdata.reduce((a, b) => a + (+b.excelcontractval), 0);
    const _additional = $scope.printdata.reduce((a, b) => a + (+b.exceladditional), 0);
    const _asperactual = $scope.printdata.reduce((a, b) => a + (+b.excelasperval), 0);
    const _projecval = $scope.printdata.reduce((a, b) => a + (+b.exceltotalvalue), 0);

    const _downpayment = $scope.printdata.reduce((a, b) => a + (+b.exceldownpaycollect), 0);
    const _undercollected = $scope.printdata.reduce((a, b) => a + (+b.exceldonwpayundercollection), 0);
    const _vattot = $scope.printdata.reduce((a, b) => a + (+b.exceldownpayvat), 0);
    const _totowvat = $scope.printdata.reduce((a, b) => a + (+b.exceltotalwithvat), 0);
    

    $scope.sumoff = {
        _contval,
        _additional,
        _asperactual,
        _projecval,
        _downpayment,
        _undercollected,
        _vattot,
        _totowvat

    };
}

export function ams_project_workdone($scope, $rootScope) {
    $rootScope.printtitle = "PROJECT WORKDONE SUMMARY";
    $scope.printdata = JSON.parse(localStorage.getItem("ams_print_projectvaluvations"));
    console.log($scope.printdata)
    const _contval = $scope.printdata.reduce((a, b) => a + (+b.excelcontractval), 0);
    const _additional = $scope.printdata.reduce((a, b) => a + (+b.exceladditional), 0);
    const _asperactual = $scope.printdata.reduce((a, b) => a + (+b.excelasperval), 0);
    const _projecval = $scope.printdata.reduce((a, b) => a + (+b.exceltotalvalue), 0);

    const _mo = $scope.printdata.reduce((a, b) => a + (+b.excelmo), 0);
    const _valuvation = $scope.printdata.reduce((a, b) => a + (+b.excelvaluvatonval), 0);

    $scope.sumoff = {
        _contval,
        _additional,
        _asperactual,
        _projecval,
        _mo,
        _valuvation,
    };
}