export default function budgetsummary($scope, $rootScope) {
    $rootScope.printtitle = "BUDGET SUMMAY";
    $scope.project = JSON.parse(localStorage.getItem("pms_budget_summary_project"));
    $scope.summary = JSON.parse(localStorage.getItem("pms_budget_summary_print"));

    $scope.summoff = {
        budget: 0,
        ordered: 0,
        balance : 0
    }
    let _budget = 0;
    let _ordered = 0;
    $scope.summary.map(i => {
        _budget += (+i.budgetval);
        _ordered += (+i.poval);
    })
    let _balance = (+_budget) - (_ordered);
    $scope.summoff = {
        budget: _budget,
        ordered : _ordered,
        balance : _balance
    }

}
