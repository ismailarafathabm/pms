import BudgetGlassService from './../services/budgetglass.js';
export default function projectbudget($scope, $http, $compile, $rootScope, $filter) {
    get_projectinfo()
    function get_projectinfo() {
        let project_id = sessionStorage.getItem("nafco_project_current");
        let post_data = {
            naf_user: userinfo,
            project_no: project_id
        }
        var req = $http.post(api_url + "Project/view.php", post_data);
        req.then(res => {
            //console.log(res.data);
            if (res.data.msg === "1") {
                $scope.viewproject = res.data.data;
                console.log($scope.viewproject);
                $scope.newproject = res.data.data;

            } else {
                alert(res.data.data);
            }
        });
    }

    const bg = new BudgetGlassService();

    const gridDiv = document.querySelector('#myGrid');
    var filterParams = {
        comparator: function (filterLocalDateAtMidnight, cellValue) {
            var dateAsString = cellValue;
            var dateParts = dateAsString.split('-');
            var cellDate = new Date(
                Number(dateParts[0]),
                Number(dateParts[1]) - 1,
                Number(dateParts[2])
            );

            if (filterLocalDateAtMidnight.getTime() === cellDate.getTime()) {
                return 0;
            }

            if (cellDate < filterLocalDateAtMidnight) {
                return -1;
            }

            if (cellDate > filterLocalDateAtMidnight) {
                return 1;
            }
        },
    };
   
        
    
    const columnDefs = bg.colsbudgetsummary($scope, $compile, $scope.access);
    const gridOptions = bg.gridoptions(columnDefs);
    function dateComparator(date1, date2) {
        var date1Number = monthToComparableNumber(date1);
        var date2Number = monthToComparableNumber(date2);

        if (date1Number === null && date2Number === null) {
            return 0;
        }
        if (date1Number === null) {
            return -1;
        }
        if (date2Number === null) {
            return 1;
        }

        return date1Number - date2Number;
    }

    function monthToComparableNumber(date) {
        if (date === undefined || date === null || date.length !== 10) {
            return null;
        }

        var yearNumber = date.substring(6, 10);
        var monthNumber = date.substring(3, 5);
        var dayNumber = date.substring(0, 2);

        var result = yearNumber * 10000 + monthNumber * 100 + dayNumber;
        return result;
    }
    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);
    loadsummary();
    $scope.excelexport = () => {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();
            var mname = `PROJECT BUDGET SUMMAY`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }
    $scope.sum = {
        budget: 0,
        po: 0,
        balance : 0,
    }
    async function loadsummary() {
        $scope.sum = {
            budget: 0,
            po: 0,
            balance: 0,
        }
        let _finaldata = [];
        gridOptions.api.setRowData([]);
        const fd = bg.FormData();
        fd.append("projectid", sessionStorage.getItem("nafco_project_current_sno"));
        const res = await bg.bsp(fd);
        if (res.msg !== 1) {
            gridOptions.api.setRowData([]);
            alert(res.data);
            return;
        }
        
        
        res.data.map(i => {           
            _finaldata.push(
                {
                    bmmaterialtype : i.materialtype,                    
                    budgetval: i.budgetval,
                    poval: i.po,
                    balance: i.bal
                }
            );
        })
        gridOptions.api.setRowData(_finaldata);
        let _budget = 0;
        let _po = 0;
        let _bal = 0;
        _finaldata.map(i => {
            _budget += (+i.budgetval);
            _po += (+i.poval);
            _bal += (+i.balance);
        })

        $scope.sum = {
            budget: _budget,
            po: _po,
            balance : _bal,
        }
        $scope.$apply();
    }


    $scope.polist = {
        isloading: false,
        data: []
    };

    document.getElementById("dia_po_history").style.display = "none";
    $scope.getpurchase = async (x) => {
        document.getElementById("dia_po_history").style.display = "flex";
        $scope.selectedmaterial = x;
        $scope.polist = {
            isloading: true,
            data: []
        };
        const fd = bg.FormData();
        fd.append('itemtype', x);
        fd.append('poproject', sessionStorage.getItem("nafco_project_current_sno"));
        const res = await bg.bipo(fd);
        if (res?.msg !== 1) {
            $scope.polist = {
                isloading: false,
                data: []
            };
            alert(res.data);
            $scope.$apply();
            return;
        }
        $scope.polist = {
            isloading: false,
            data: res.data
        };
        $scope.sumofpo = res.data.reduce((a, b) => (+a) + (+b.ponewtotval), 0);
        $scope.$apply();
        return;        
    }
    $scope.materialbudgets = [];
    $scope.glassbudgets = [];
    $scope.getmaterialbudget = async (type) => {        
        const fd = bg.FormData();
        fd.append('bmproject', sessionStorage.getItem("nafco_project_current_sno"));
        fd.append("bmmaterialtype", type);
        if (type === "Glass") {
            location.href = `${print_location}/Dashboard/Main/index.php#!/budgetglass`;
            return;    
        }
        $scope.selectedmaterial = type;
        await _getMaterialbudget(fd);
    }
    document.getElementById("dia_budget_items").style.display = "none";
    
    async function _getMaterialbudget(fd) {
        document.getElementById("dia_budget_items").style.display = "flex";
        $scope.materialbudgets = [];
        const res = await bg.bmbt(fd);
        if (res?.msg !== 1) {
            alert(res.data);
            $scope.materialbudgets = [];
            $scope.$apply();
        }

        $scope.materialbudgets = res.data;
        $scope.mtotal = res.data.reduce((a, b) => (+a) + (+b.bmdiscountval), 0);
        $scope.$apply();
        return;
    }

    $scope.printfrm = () => {
        let printdata = [];
        gridOptions.api.forEachNodeAfterFilterAndSort(i => {
            printdata.push(i.data);
        });
        let prj = $scope.viewproject;

        localStorage.removeItem("pms_budget_summary_print");
        localStorage.removeItem("pms_budget_summary_project");

        localStorage.setItem("pms_budget_summary_print", JSON.stringify(printdata));
        localStorage.setItem("pms_budget_summary_project", JSON.stringify(prj));
        window.open(`${print_location}/fprint/#!/budgetsummary`, "_blank", "width:1200px;height:500px");
    }
}