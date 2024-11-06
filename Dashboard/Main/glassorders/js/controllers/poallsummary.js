import POService from './../services/po.js';
export default function poallsummary($scope,$compile) {
    const po = new POService();
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
    const columnDefs = po.colsposummary($scope, $compile, $scope.access);
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
    //gridOptions.api.setRowData([]);
    new agGrid.Grid(gridDiv, gridOptions);
    loadrpt();
    async function loadrpt() {
        console.log("Api Called");
        const res = await po.posummary();
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        gridOptions.api.setRowData(res.data);
        return;
    }

    $scope.gotoprojectpo = (pjno, pjid) => {
        console.log("working");
        sessionStorage.clear('nafco_project_current');
        sessionStorage.clear('nafco_project_current_sno');
        sessionStorage.setItem('nafco_project_current', pjno);
        sessionStorage.setItem('nafco_project_current_sno', pjid);
        location.href = `${print_location}/Dashboard/Main/index.php#!/ponv`;
    }

}