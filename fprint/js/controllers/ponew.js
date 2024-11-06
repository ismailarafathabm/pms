export default function ponew($scope, $rootScope) {
    $rootScope.printtitle = "PURCHASE ORDER";
    $scope.coverletter = "With reference to the above mentioned subject , hereby we confirm our order for the item listed below;"
    $scope.lt1 = " Meanwhile, Pleased Arrange and make delivery as soon as possible to our warehouse";
    $scope.lt2 = "Your usual cooperation is highly appreciated."
    $scope.print = JSON.parse(localStorage.getItem("pms_ponew_print"));
    console.log($scope.print);
    let refno = $scope.print.ponewrefno;
    console.log(refno);
    $scope.total = $scope.print.dt.reduce((a, b) => (+a) + (+b.ponewdtwgttotprice), 0);
    $scope.qtytot = $scope.print.dt.reduce((a, b) => (+a) + (+b.ponewdtqty), 0);
    $scope.wttot = $scope.print.dt.reduce((a, b) => (+a) + (+b.ponewdtwgt), 0);
    $scope.areatot = $scope.print.dt.reduce((a, b) => (+a) + (+b.ponewdtarea), 0);

    $scope.totalextra = $scope.print.dt.reduce((a, b) => (+a) + (+b.extraamount), 0);
    $scope.totalcurrent = $scope.print.dt.reduce((a, b) => (+a) + (+b.currentamount), 0);
    
    $scope.vatam = (+$scope.totalcurrent) * (+$scope.print.ponewvat) / 100;
    console.log($scope.vatam);
    console.log($scope.print.ponewtotval);
    document.title = `Purchase Order - ${refno}`;
    console.log($scope.print);
}