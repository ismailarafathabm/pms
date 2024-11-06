export default function ams_lp($scope, $rootScope) {
    $rootScope.printtitle = "LOADING PERMISSION";
    let _data = localStorage.getItem("ams_print_lp");
    $scope.printdata = JSON.parse(_data);
}