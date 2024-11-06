export default function projectbudgetsummary($scope, $rootScope) {
    $rootScope.printtitle = "PROJECTS BUDGET SUMMARY";
    $scope.data = JSON.parse(localStorage.getItem("pms_print_budget_rpt"));
    console.log($scope.data);
}