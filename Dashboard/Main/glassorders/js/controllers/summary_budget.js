import POService from './../services/po.js';
export default function summary_budget($scope,$compile) {
    const po = new POService();
      //gird options
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
    $scope.access = {};
    const columnDefs = po.budgetsummarycols($scope, $compile, $scope.access);
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


    LoadProject();

    async function LoadProject() {
        const res = await po.budgetsummary();
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }

        $scope.pos = res.data;
        gridOptions.api.setRowData(res.data ?? []);
       // sumofcal(res.data);
        $scope.$apply();
    }
    localStorage.removeItem("pms_print_budget_rpt");
    $scope.printResult = () => {
        let _data = [];
        gridOptions.api.forEachNodeAfterFilterAndSort(i => {
            if ($scope.avoidpo) {    
                if((+i.data.poamount) !== 0){
                    _data.push(i.data);
                }
                
            } else {
                _data.push(i.data);
            }
            
        })

        localStorage.removeItem("pms_print_budget_rpt");
        localStorage.setItem("pms_print_budget_rpt", JSON.stringify(_data));
        window.open(`${print_location}/fprint/#!/projects_budget_summary`, "_blank", "width:1200px;height:500px");
    }
}