export default function poprint($scope, $rootScope) {
    $rootScope.printtitle = "Purchase Order";
    $scope.print = JSON.parse(localStorage.getItem('pms_print_purchaes_po'));
    
    $scope.currentproject = JSON.parse(localStorage.getItem('pms_currentproject'));

}