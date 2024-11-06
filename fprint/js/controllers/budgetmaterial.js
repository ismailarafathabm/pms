export default function budgetmaterial($scope, $rootScope) {
    $rootScope.printtitle = "BUDGET SUMMARY - MATERIALS";
    $scope.project = JSON.parse(localStorage.getItem("pms_budget_summary_project"));
    $scope.summary = JSON.parse(localStorage.getItem("pms_budget_summary_print"));
    $scope.summoff = {
        budget: 0,
        discount: 0,
        discountval: 0
        
    }
    let _budget = 0;
    let _ordered = 0;
    let _discountval = 0;
    $scope.summary.map(i => {
        _budget += (+i.bmeval);
        _ordered += (+i.bmdiscountval);
        _discountval += (+i.bmdiscountprice);
    })
   
    $scope.summoff = {
        budget: _budget,
        discount: _ordered,    
        discountval : _discountval
    }
}