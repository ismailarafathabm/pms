export default function projectporpt($scope, $rootScope) {
    $rootScope.printtitle = "PO SUMMARY REPORT"; 
    $scope.rpt = JSON.parse(localStorage.getItem("pms_print_po_rpt"));
    $scope.sumoff = {
        area: $scope.rpt.reduce((a,b)=> (+a) + (+b.area),0),
        qty: $scope.rpt.reduce((a,b)=> (+a) + (+b.qty),0),
        tonnage: $scope.rpt.reduce((a,b)=> (+a) + (+b.wght),0),
        subttoal: $scope.rpt.reduce((a,b)=> (+a) + (+b.totalprice),0),
        totvat: $scope.rpt.reduce((a,b)=> (+a) + (+b.vatvalue),0),
        totamount : $scope.rpt.reduce((a,b)=> (+a) + (+b.ponewtotval),0),
    }
    console.log($scope.rpt, $scope.sumoff)
}