export default function mprint($scope, $rootScope) {
    console.log("working");
    document.title = "Purchase Order Approval Form";
    $rootScope.printtitle = "Purchase Order Approval Form";
    $scope.printdata = JSON.parse(localStorage.getItem('pms_print_purcashe_material_order'));
    console.log($scope.printdata);
}