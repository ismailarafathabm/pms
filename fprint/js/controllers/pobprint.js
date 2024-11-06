export default function pobprint($scope, $rootScope) {
    $rootScope.printtitle = "PO Budget Form";
    console.log("new work satart")
    $scope.preswork = {
        totbudget: 100,
        previous: 0,
        current: 0,
        balance: 0
    };
    
    $scope.print = JSON.parse(localStorage.getItem('pms_print_purchaes_pob'));
    $scope.preswork = {
        totbudget: 100,
        previous: calc($scope.print.pob.pobprvalue,$scope.print.pob.pobtotbudget),
        current: calc($scope.print.pob.pobcvalue,$scope.print.pob.pobtotbudget),
        balance: calc($scope.print.pob.pobavailablebudget,$scope.print.pob.pobtotbudget),
    }
    function calc(a, b) {
        let c = ((+a) / (+b)) * 100;
        return Math.round(c);
            
    }
    console.log($scope.print);
    $scope.currentproject = JSON.parse(localStorage.getItem('pms_currentproject'));
}