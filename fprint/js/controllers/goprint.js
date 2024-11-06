export default function goprint($scope, $rootScope) {
    document.title = "Purchase Order Approval Form";
    $rootScope.printtitle = "Purchase Order Approval Form";
    $scope.printdata = JSON.parse(localStorage.getItem("pms_print_purcashe_glass_order"));
}