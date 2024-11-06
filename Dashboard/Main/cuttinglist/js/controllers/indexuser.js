import cuttinglistservices from "../services/index.js";
import * as models from './models.js';
export default function Cuttinglistsusers($scope, $compile) {
    
    let _rptdata = [];
    const cts = new cuttinglistservices();
    let access = {};
    const columnDefs = models.rptcolsusers($scope, access, $compile);
    const gridOptions = models.gridoptionsx(columnDefs);

    console.log(models.gridoptionsx(columnDefs));
    console.log(gridOptions);

    $scope.gregorianDatepickerConfigdotravels = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian'
    };
    moment.locale('en');
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    moment.locale('en');

    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };


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

    $scope.excelexport = () => {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            // var date = new Date();
            // var day = date.getDate();
            // var month = date.getMonth();
            // var year = date.getFullYear();
            var mname = `Material Request For Project : ${$scope.viewproject.project_name}`;
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }
    //LoadData()
    async function LoadData() {
        const res = await cts.GET("cuttinglists/indexct.php");
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        gridOptions.api.setRowData(res.data);
        return;
    }
    //--temp stoped
    GetRowCount()
    let splitval = 500;
    let rowcount = 0;
    async function GetRowCount() {
        const res = await cts.GET("cuttinglists/ctrows.php");
        if (res?.msg !== 1) {
            alert(res.data);
            return;
        }
        rowcount = (+res.data);
        let splitcount = rowcount / splitval;
        let rowstart = [];

        console.log(splitcount);
        let n = 0;
        rowstart.push(n);
        for (var i = 0; i < splitcount; i++) {
            n = n + splitval;
            rowstart.push(n)
        }

        LoadReports(rowstart)

        $scope.$apply();
        //gridOptions.api.setRowData(res.data);
    }
    // LoadReports();
    $scope.isrptloading = false;
    const gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
   //new agGrid.Grid(gridDiv, gridOptions);
    //gridOptions.api.setRowData([]);

    async function LoadReports(x) {
        $scope.isrptloading = true;
        let _griddatas = [];
        x.map(async (i) => {

            const res = await fetchDatas(i);

            res.data.map(k => {
                _griddatas.push(k);
            })
            _rptdata = _griddatas;
            gridOptions.api.setRowData(_griddatas);
            //gridApi.setGridOption('rowData', _griddatas);
            if (_griddatas.length === rowcount) {
                $scope.isrptloading = false;
                $scope.$apply();
            }

        })

        console.log(_rptdata);
    }

    async function fetchDatas(sno) {
        const res = await cts.GET(`cuttinglists/index.php?nrows=${sno}`);
        return res;
    }
  
    $scope.clearFilters = function () {
        gridOptions.columnApi.applyColumnState({
            defaultState: {
                sort: null,
            },
        });
        
        gridOptions.api.setFilterModel(null);
        gridOptions.api.setRowData([]);
        gridOptions.api.setRowData(_rptdata);
        gridOptions.columnApi.applyColumnState({
            state: [{ colId: 'issuedate', sort: 'desc' }],
        });
        

    }

    $scope.exportExcel = function () {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            let excelfilename = "Cutting List Report";
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();

            var param = {
                fileName: excelfilename,
                sheetName: "SHEET1",
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }

    $scope.printResult = () => {
        let _data = [];
        gridOptions.api.forEachNodeAfterFilterAndSort((_) => {
            _data.push(_.data);
        })

        let printwindow = window.open(`${print_location}/sprint/cuttinglists.html`, '_blank', "width:1300px;height:700px");
        printwindow.forprintdata = JSON.stringify(_data);
        printwindow.fordate = printoutdate;
        printwindow.project_name = $scope.viewproject.project_name;
        printwindow.type = "N";
    }
    $scope.datefilter = {
        diashow: false,
        isloading: false,
        data: {
            fromdate: '',
            todate : ''
        }
    };
    _getThisWeek();
    async function _getThisWeek() {
        console.log("AAAAAA");
        const res = await cts.GET(`cuttinglists/weekget.php`);
        if (res?.msg !== 1) {
            return;
        }

        $scope.datefilter = {
            ...$scope.datefilter,
            data: {
                fromdate: res.data.fday,
                todate : res.data.fd,
            }
        };

        console.log(res.data);
        console.log($scope.datefilter);

        $scope.$apply();

    }

    $scope.showDatefilter = (status) => {
        $scope.datefilter['diashow'] = status;    
        console.log($scope.datefilter);
    }
    function _convertDate(d) {
        const x = d.split('-');

        const date = x[0];
        const month = x[1];
        const year = x[2];

        return `${year}-${month}-${date}`;
    }
    let printoutdate = "";
    $scope.filterbydate = () => {
        const _fromdate = $scope.datefilter?.data?.fromdate ?? '';
        const _todate = $scope.datefilter?.data?.todate ?? '';

        if (!_fromdate || _fromdate === '') {
            alert("Enter Form Date");
            return;
        }

        if (!_todate || _todate === '') {
            alert("Enter To Date");
            return;
        }
        printoutdate = `FROM ${_fromdate} TO ${_todate}`;
        console.log(printoutdate);
        const fdate = _convertDate(_fromdate);
        const todate = _convertDate(_todate);
        gridOptions.api.setRowData([]);
        const filterdata = _rptdata.filter(x => x.issuedate >= fdate && x.issuedate <= todate);
        let sortdata = filterdata.sort((a, b) => {
            if (a.issuedate < b.issuedate) {
                return -1;
            }
            if (a.issuedate > b.issuedate) {
                return 1;
            }
            return 1;
        })
        gridOptions.api.setRowData(sortdata);
        gridOptions.columnApi.applyColumnState({
            state: [{ colId: 'issuedate', sort: 'desc' }],
        });
        $scope.datefilter['diashow'] = false;    

        
    }
  
}