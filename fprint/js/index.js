app.config(($routeProvider) => {
    $routeProvider
        .when('/', {
            templateUrl: "./js/dir/materialtobeload.html",
            controller: "homepage"
        })
        .when('/materialsummary', {
            templateUrl: "./js/dir/materialloadsummary.html",
            controller: "MaterialToBeLoadSummary"
        })
        .when('/materialtobeloadbacklog', {
            templateUrl: './js/dir/mtblbacklog.html',
            controller: 'mtblbacklog'
        })
        .when('/goprint', {
            templateUrl: "./js/dir/goprint.html",
            controller: 'goprint'
        })
        .when('/mprint', {
            templateUrl: "./js/dir/mprint.html",
            controller: 'mprint'
        })
        .when('/poprint', {
            templateUrl: './js/dir/poprint.html',
            controller: 'poprint'
        })
        .when('/pobprint', {
            templateUrl: './js/dir/pobprint.html',
            controller: 'pobprint'
        })
        .when('/ponew', {
            templateUrl: './js/dir/ponew.html',
            controller: 'ponewprint'
        })
        .when('/poadvice', {
            templateUrl: "./js/dir/poadvice.html",
            controller: 'poadvices'
        })
        .when('/budgetsummary', {
            templateUrl: './js/dir/budgetsummary.html',
            controller: 'budgetsummary'
        })
        .when('/budgetmaterials', {
            templateUrl: './js/dir/budgetmaterials.html',
            controller: 'budgetmaterial'
        })
        .when('/budgetglass', {
            templateUrl: './js/dir/budgetglass.html',
            controller: 'budgetglass'
        })
        .when('/projects_budget_summary', {
            templateUrl: './js/dir/projectsbudgetsummary.html',
            controller: 'projectbudgetsummary'
        })
        .when('/project_budget_summary', {
            templateUrl: './js/dir/project_budget_summary.html',
            controller: 'projectbudget'
        })
        .when('/project_budget_summary_n', {
            templateUrl: './js/dir/project_budget_summary_n.html',
            controller: 'projectbudget_n'
        })
        .when('/project_po_rpt', {
            templateUrl: './js/dir/project_po_rpt.html',
            controller: 'projectporpt'
        })
        .when('/project_po_rptg', {
           templateUrl : './js/dir/project_po_rptg.html'
        })
        .when('/404', {
            templateUrl : "./js/dir/index.html"
        })

        //ams
        .when('/amslp', {
            templateUrl: './js/dir/ams_lp.html',
            controller: 'ams_lp'
        })
        .when('/ams_print_project_summary', {
            templateUrl: './js/dir/ams/index.html',
            controller : 'ams_project_summary'
        })
        .when('/ams_print_project_downpayment', {
            templateUrl: './js/dir/ams/downpayment.html',
            controller : 'ams_project_downpayment'
        })
        .when('/ams_print_project_valuvations', {
            templateUrl: './js/dir/ams/workdone.html',
            controller : 'ams_project_workdone'
        })
        //ams
        .otherwise({
            redirectTo: "/404"
        })
})