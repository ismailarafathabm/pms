import API_Services from "../services/apiServices.js";
export default function manpowerAttenAbsent($scope,$compile) {
    const apis = new API_Services();
    $scope.gregorianDatepickerConfig = {
        allowFuture: true,
        dateFormat: 'DD-MM-YYYY',
        defaultDisplay: 'gregorian',
        minDate: moment().subtract(10, 'years'),
        allowFuture: false,
    };
    moment.locale('en');
    $scope.locale = moment.locale();
    $scope.switchLocale = function (value) {
        moment.locale(value);
        $scope.locale = moment.locale();
    };
    const rpt_src_dialog2 = document.getElementById("rpt_src_dialog2");
    rpt_src_dialog2.style.display = "flex";
    $scope.isLoading = false;
    let cols = _cols($scope, $compile);
    var gridDiv = document.querySelector('#myGrid');
    let gridOptions = {}
    let _startdate = document.getElementsByName("startdate")[0];
    let _enddate = document.getElementsByName("enddate")[0];
    $scope.filterdata_submit = async () => await LoadReport();
    async function LoadReport() {
        if ($scope.isLoading) return;
        // gridOptions.api.setRowData([]);
        _startdate = document.getElementsByName("startdate")[0];
        _enddate = document.getElementsByName("enddate")[0];
        if (_startdate.value.trim() === "") {
            alert("Enter Start Date");
            _startdate.focus();
            return;
        }
        if (_enddate.value.trim() === "") {
            alert("Enter End Date");
            _enddate.focus();
            return;
        }
        $scope.isLoading = true;

        const res = await apis.GET(`pms-manpower/monthlyattenabsent.php?stdate=${_startdate.value}&enddate=${_enddate.value}`);
        if (!res.isSuccess) {
            alert(res.msg);
            $scope.isLoading = false;
            $scope.$apply();
            return;
        }
        if (!res.data) {
            alert("No Data found");
            rpt_src_dialog2.style.display = "none";
            $scope.isLoading = false;
            $scope.$apply();
            return;
        }
        if (res.data.length !== 0) {
            var xcols = Object.keys(res.data[0]);
            var xcol = xcols.sort();
            var xcolf = [];
            xcol.map(k => {
                if (k !== 'Project No') {
                    if (k !== 'Project Name') {
                        if (k !== 'Region') {
                            if (k !== 'Total Employees') {
                                xcolf.push(k);
                            }
                        }
                    }
                }
            })

            xcolf = xcolf.sort();
            xcolf.map(k => {
                var l = k.split('-')
                cols.push({
                    headerName: l[2],
                    field: k,
                    width: 60,
                },);

            })

            gridOptions = apis._gridOptions(cols);
            new agGrid.Grid(gridDiv, gridOptions);
            gridOptions.api.setRowData([]);
            gridOptions.api.setRowData(res.data);
            rpt_src_dialog2.style.display = "none";
            $scope.isLoading = false;
            $scope.$apply();
            return;
        }
    }

    $scope.clearFilters = () => {
        filterClear();
    }

    function filterClear() {
        gridOptions.columnApi.applyColumnState({
            defaultState: {
                sort: null,
            },
        });
        gridOptions.api.setFilterModel(null);
    }
    $scope.exportExcel = () => {
        var c = confirm("Are You Sure Export this Report?");
        if (c) {
            let da = document.getElementsByName('startdate')[0].value;
            var mname = `Man Power Daily Report For ${da}`
            var FileName = mname
            var param = {
                fileName: FileName,
                sheetName: FileName
            };
            gridOptions.api.exportDataAsExcel(param);
        }
    }
}

function _cols(s, c) {
    const columndef = [];
    columndef.push({
        headerName: 'Project No',
        field: 'Project No',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 100,
        pinned: 'left',
    },);
    columndef.push({
        headerName: 'Project Name',
        field: 'Project Name',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 400,
        pinned: 'left',
    },);
    columndef.push({
        headerName: 'Region',
        field: 'Region',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 160,
        pinned: 'left',
        sort: 'asc'

    },);
    columndef.push({
        headerName: 'Total Employees',
        field: 'Total Employees',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 70,
        pinned: 'left',
    },);
    return columndef;
}