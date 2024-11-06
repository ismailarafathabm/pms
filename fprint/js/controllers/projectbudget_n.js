export default function projectbudget_n($scope,$rootScope) {
    $rootScope.printtitle = "PROJECT BUDGET SUMMARY";
    $scope.data = JSON.parse(localStorage.getItem("pms_print_project_budget"));
    $scope.project = JSON.parse(localStorage.getItem("pms_currentproject"));

    $scope.summofbudget = $scope.data.reduce((a, b) => (+a) + (+b.bmdiscountval), 0);
}