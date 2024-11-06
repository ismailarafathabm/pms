export default function poadvices($scope, $rootScope) {
    $rootScope.printtitle = "PAYMENT ADVICE";    
    $scope.po = JSON.parse(localStorage.getItem("pms_print_po_info"));
    $scope.advice = JSON.parse(localStorage.getItem("pms_print_paymentadvice"));
    console.log($scope.poinfo, $scope.advice);
    
    let refno = $scope.advice.padvancesno;
    console.log(refno);
    $scope.total = $scope.po.dt.reduce((a, b) => (+a) + (+b.ponewdtwgttotprice), 0);
    $scope.qtytot = $scope.po.dt.reduce((a, b) => (+a) + (+b.ponewdtqty), 0);
    $scope.wttot = $scope.po.dt.reduce((a, b) => (+a) + (+b.ponewdtwgt), 0);
    $scope.areatot = $scope.po.dt.reduce((a, b) => (+a) + (+b.ponewdtarea), 0);

    $scope.totalextra = $scope.po.dt.reduce((a, b) => (+a) + (+b.extraamount), 0);
    $scope.totalcurrent = $scope.po.dt.reduce((a, b) => (+a) + (+b.currentamount), 0);
    console.log($scope.totalcurrent)
    $scope.vatam = (+$scope.totalcurrent) * (+$scope.po.ponewvat) / 100;
    console.log($scope.vatam);
    console.log($scope.po.ponewtotval);
    document.title = `Purchase Order - ${refno}`;
}