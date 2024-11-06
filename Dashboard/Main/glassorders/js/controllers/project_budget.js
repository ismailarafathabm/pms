import POService from './../services/po.js';
export default function project_budget($scope, $compile,$http) {
    const pjcno = sessionStorage.getItem("nafco_project_current_sno");
    const po = new POService();

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
                localStorage.removeItem("currentproject");
                localStorage.setItem("pms_currentproject", JSON.stringify($scope.viewproject));

                console.log($scope.viewproject);
                $scope.newproject = res.data.data;

            } else {
                alert(res.data.data);
            }
        });
    }

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
    const username = userinfo.user_name;
    const _priceaccessusers = ['demo','sam', 'nabil', 'hani', 'AbuZaid', 'nimnim', 'estimation', 'estimations'];
    $scope.access = {
        priceaccess: _priceaccessusers.includes(username),     
        
    };
    const columnDefs = po.colsdef_projectBudget($scope, $compile, $scope.access);
    const gridOptions = po.gridoptions(columnDefs);


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

    $scope.isrptloading = false;
    $scope.excelexport = () => {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();
            var mname = `BUDGET SUMMARY FOR ALL PROJECTS ${day}-${month}-${year}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }

    new agGrid.Grid(gridDiv, gridOptions);

    $scope.sum = {
        cost: 0
    };
    GetRpt();
    async function GetRpt() {
        const fd = po.FormData();
        fd.append('pjcno', pjcno);
        const res = await po.projectbudgetsummary(fd);

        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        const totcost = res.data.reduce((a, b) => a + (+b.bmdiscountval),0);
        $scope.sum = {
            cost: Math.round(totcost)
        };
        gridOptions.api.setRowData(res.data ?? []);
        $scope.$apply();
        return;
    }

    localStorage.removeItem("pms_print_project_budget");
    $scope.printrpt = () => {
        let _printdata = [];
        gridOptions.api.forEachNodeAfterFilterAndSort(i => _printdata.push(i.data));
        localStorage.removeItem("pms_print_project_budget");
        
        localStorage.setItem("pms_print_project_budget", JSON.stringify(_printdata));
        console.log(_printdata);
        window.open(`${print_location}/fprint/#!/project_budget_summary`, "_blank", "width:1200px;height:500px");
        return;
    }
    $scope.printrpt_n = () => {
        let _printdata = [];
        gridOptions.api.forEachNodeAfterFilterAndSort(i => _printdata.push(i.data));
        localStorage.removeItem("pms_print_project_budget");
        
        localStorage.setItem("pms_print_project_budget", JSON.stringify(_printdata));
        console.log(_printdata);
        window.open(`${print_location}/fprint/#!/project_budget_summary_n`, "_blank", "width:1200px;height:500px");
        return;
    }
}