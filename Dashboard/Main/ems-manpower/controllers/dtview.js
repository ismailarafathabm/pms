import API_Services from "../services/apiServices.js";

export default function manpowerDtview($scope, $compile) {
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
    $scope.isLoading = false;
    const cols = _cols($scope, $compile);
    const gridOptions = apis._gridOptions(cols);
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.setRowData([]);
    $scope.clearFilters = () => {
        filterClear();
    }

    function filterClear() {
        gridOptions.columnApi.applyColumnState({
            defaultState: {
                sort: null,
            },
        })
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

    const rpt_src_dialog2 = document.getElementById("rpt_src_dialog2");
    rpt_src_dialog2.style.display = "flex";
    let _startdate = document.getElementsByName("startdate")[0];
    let _enddate = document.getElementsByName("enddate")[0];
    $scope.filterdata_submit = async () => await LoadManpower();
    async function LoadManpower() {
        if ($scope.isLoading) return;
        gridOptions.api.setRowData([]);
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
        const res = await apis.GET(`pms-manpower/dtview.php?stdate=${_startdate.value}&enddate=${_enddate.value}`);
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
        rpt_src_dialog2.style.display = "none";
        let _xdata = [];
        res.data.map(async (i) => {
            
            const _dt = await _dtReport(i);
            _dt.map(j => {
                _xdata.push(j)
            })
            gridOptions.api.setRowData(_xdata);
        })
        $scope.isLoading = false;
        $scope.$apply();

    }

    async function _dtReport(_date) {
        const res = await apis.GET(`pms-manpower/dtviews.php?mdate=${_date}`);
        if (!res.isSuccess) {
            console.log(res.msg);
            //$scope.isLoading = false;
            //$scope.$apply();
            return [];
        }
        if (!res.data) {
            console.log("No Data found");
            return []
            //rpt_src_dialog2.style.display = "none";
            //$scope.isLoading = false;
           // $scope.$apply();
            
        }

        return res.data;


    }

}

function _cols(s, c) {
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
    let cols = [{
        headerName: 'Date',
        field: 'mdate',
        cellRenderer: function (params) {
            return `<div>${params.data.mdate_d}</div>`
        },
        cellClass: 'dateType',
        sort: 'desc',
        filter: 'agDateColumnFilter',
        filterParams: filterParams,
        width: 100,
        sort: 'asc',
        sortIndex: 0,

    },
    {
        headerName: 'Project NO',
        field: 'projectno',
        width: 100,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        sort: 'asc',
        sortIndex: 1,
    },
    {
        headerName: 'Project Name',
        field: 'projectname',
        width: 180,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],

    },
    {
        headerName: 'Location',
        field: 'projectlocation',
        width: 100,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },
    {
        headerName: 'Region',
        field: 'projectregion',
        width: 150,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },
    {
        headerName: 'File No',
        field: 'fileno',
        filter: 'agMultiColumnFilter',
        width: 80,

        sortingOrder: ['asc', 'desc'],
    },
    {
        headerName: 'Name',
        field: 'ename',
        width: 160,
        sort: 'asc',
        filter: 'agMultiColumnFilter',
        sortIndex: 2,
    },
    {
        headerName: 'Designation',
        field: 'eposition',
        width: 120,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },
    {
        headerName: 'Status',
        field: 'filenostatustxt',
        width: 120,
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellRenderer: function (par) {
            var rtntxt;
            if (par.data.filenostatus === '1') {
                rtntxt = `<span style="color:green">
            <i class="fa fa-check"></i> PRESENT</span>`;

            } else if (par.data.filenostatus === '3') {
                //fa fa-wheelchair-alt
                rtntxt = `<span style="color:#1029c3">
            <i class="fa fa-wheelchair-alt"></i> SICK</span>`;
            } else {
                rtntxt = `<span style="color:red">
            <i class="fa fa-times"></i> ABSENT</span>`;
            }
            return rtntxt;
        }
    }, {
        headerName: 'Project Manager',
        field: 'mangername',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellRenderer: function (d) {
            if (d.data.mangername === 'NAN' || d.data.mangername === NaN) {
                return `NONE`;
            } else {
                return d.data.mangername;
            }
        }
    },
    {
        headerName: 'Project Engineer',
        field: 'engname',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellRenderer: function (d) {
            if (d.data.engname === 'NAN' || d.data.engname === NaN) {
                return `NONE`;
            } else {
                return d.data.engname;
            }
        }
    },
    {
        headerName: 'Foreman',
        field: 'formanname',
        cellRenderer: function (d) {
            if (d.data.formanname === 'NAN' || d.data.formanname === NaN) {
                return `NONE`;
            } else {
                return d.data.formanname;
            }
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },
    {
        headerName: 'Leadman',
        field: 'formatsubname',
        cellRenderer: function (d) {
            if (d.data.formatsubname === 'NAN' || d.data.formatsubname === NaN) {
                return `NONE`;
            } else {
                return d.data.formatsubname;
            }
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },
    {
        headerName: 'NOTES',
        field: 'mannotes',
        width: 150,
        cellRenderer: function (p) {
            return p.data.mannotes === false || p.data.mannotes === "" + false ? '-' : p.data.mannotes;
        },
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
    },
    ];
    return cols;
}