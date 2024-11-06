import API_Services from "../services/apiServices.js";
export default function emsManpower($scope) {
    //date time picker config
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
    //grid 
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
    //column def
    let gcols = [];
    gcols.push({
        headerName: 'Project No',
        field: 'projectno',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 100,
    },)
    gcols.push({
        headerName: 'Name',
        field: 'projectname',
        cellRenderer: function (d) {
            // return `
            // // <button type="button" class="ism-btn ism-btn-danger" onclick="getinfos('${d.data.projectno}','${d.data.mdate}')" style="padding: 3px 2px;">
            // //     ${d.data.projectname}
            // // </button>
            // `
            return `${d.data.projectname.toUpperCase()}`

        },
        filter: 'agMultiColumnFilter',

        sortingOrder: ['asc', 'desc'],
        width: 495,
        sort: 'asc',
        sortIndex: 2,
    })
    gcols.push({
        headerName: 'Region',
        field: 'projectregion',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 160,
        sort: 'asc',
        sortIndex: 0,
    })
    gcols.push({
        headerName: 'Project Head',
        field: 'pmhfnoname',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 160,
        sort: 'asc',
        sortIndex: 1,
        cellRenderer: function (p) {
            return p.data.pmhfnoname === 'NAN' || p.data.pmhfnoname === 'false' || p.data.pmhfnoname === false ? '-' : p.data.pmhfnoname;
        }
    })
    gcols.push({
        headerName: 'Project Manager',
        field: 'mangername',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 160,
        sort: 'asc',
        sortIndex: 1,
        cellRenderer: function (p) {
            return p.data.mangername === 'NAN' ? 'NONE' : p.data.mangername;
        }
    })
    gcols.push({
        headerName: 'Foreman',
        field: 'formanname',
        filter: 'agMultiColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 160,
        sort: 'asc',
        sortIndex: 1,
        cellRenderer: function (p) {
            return p.data.formanname === 'NAN' ? 'NONE' : p.data.formanname;
        }
    })
    gcols.push({
        headerName: 'Total',
        field: 'totalemp',
        filter: 'agNumberColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellRenderer: function (d) {
            return (+d.data.totalemp) === 0 ? "-" : d.data.totalemp
        },
        width: 70,
    })
    gcols.push({
        headerName: 'Absent',
        field: 'abse',
        filter: 'agNumberColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellRenderer: function (d) {
            return (+d.data.abse) === 0 ? "-" : d.data.abse
        },
        width: 70,
    })
    gcols.push({
        headerName: 'Present',
        field: 'pres',
        filter: 'agNumberColumnFilter',
        sortingOrder: ['asc', 'desc'],
        cellRenderer: function (d) {
            return (+d.data.pres) === 0 ? "-" : d.data.pres
        },
        width: 70,
    })
    gcols.push({
        headerName: 'Rent',
        field: 'totrent',
        filter: 'agNumberColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 70,
        cellRenderer: (p) => (+p.data.totrent) === 0 ? '-' : p.data.totrent
    })
    gcols.push({
        headerName: 'Sub.Con',
        field: 'subcont',
        filter: 'agNumberColumnFilter',
        sortingOrder: ['asc', 'desc'],
        width: 70,
        cellRenderer: (p) => (+p.data.subcont) === 0 ? '-' : p.data.subcont
    })
    //column def

    var gridOptions = {
        suppressContextMenu: true,
        columnDefs: gcols,
        enableCellChangeFlash: true,
        defaultColDef: {

            sortable: true,
            filter: true,
            floatingFilter: true,
            wrapText: true,
            resizable: true,
        },
        multiSortKey: 'ctrl',
        onGridReady: function (params) {
            var defaultSortModel = [{
                colId: 'projectregion',
                sort: 'asc',
                sortIndex: 0
            },
            {
                colId: 'mangername',
                sort: 'asc',
                sortIndex: 1
            },
            {
                colId: 'projectname',
                sort: 'asc',
                sortIndex: 2
            },
            ];

            params.columnApi.applyColumnState({
                state: defaultSortModel
            });
        },
        suppressMenuHide: true,
        colResizeDefault: 'shift',
        excelStyles: [{
            id: 'dateType',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        },
        {
            id: 'dateTypes',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        },
        {
            id: 'dateType_green',
            dataType: "dateTime",
            numberFormat: {
                format: "dd-MMM-yyyy;;;"
            }
        }
        ],
        statusBar: {
            statusPanels: [{
                statusPanel: 'agFilteredRowCountComponent',
                align: 'left'
            },
            {
                statusPanel: 'agTotalAndFilteredRowCountComponent',
                align: 'left'
            },
            ],
        },
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
    };

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
    //grid 
    $scope.isLoading = false;
    let _todays = "";
    const rpt_src_dialog = document.getElementById("rpt_src_dialog");
    rpt_src_dialog.style.display = "flex";
    $scope.manpowerData = [];
    $scope.filterdata_submit = async () => await _getreport();
    async function _getreport() {
        if ($scope.isLoading) return;
        $scope.manpowerDatea = [];
        gridOptions.api.setRowData($scope.manpowerData);
        const _date = document.getElementsByName("startdate")[0];
        if (!_date || _date.value.trim() === "") {
            alert("Enter Date");
            _date.focus();
            return;
        }
        $scope.isLoading = true;
        _todays = _date.value;
        const res = await apis.GET(`pms-manpower/index.php?sdate=${_date.value}`);
        console.log(res);
        if (!res.isSuccess) {
            console.log("bcl");
            alert(res.msg);
            $scope.isLoading = false;
            $scope.$apply();
            return;
        }
        if (!res.data) {
            alert("No data found");
            $scope.isLoading = false;
            $scope.$apply();
            return;
        }

        $scope.manpowerData = res.data;
        $scope.isLoading = false;
        rpt_src_dialog.style.display = "none";
        gridOptions.api.setRowData($scope.manpowerData);
        $scope.$apply();
        return;

    }

    $scope.prints = () => {
        let _x = new Date('2023-02-07');
        let _n = document.getElementsByName("startdate")[0];
        if (_n.value.trim() === "") {
            alert("Please Load Report");
            return;
        }
        let x = _n.value.split('-');
        let _y = x[2];
        let _m = x[1];
        let _d = x[0];
        let _fd = `${_y}-${_m}-${_d}`;

        let _fdd = new Date(_fd);;
        if (_x > _fdd) {
            alert("This Report Only Work After 07-02-2023");
            return;
        }
        let printdata = []
        gridOptions.api.forEachNodeAfterFilterAndSort(i => {
            printdata.push(i.data)
        });
        if (printdata.length === 0) {
            alert("No Data Found");
            return;
        }
        console.log(printdata);
        localStorage.removeItem("print_ems_manpower_daily_new_datas");
        localStorage.removeItem("print_ems_manpower_daily_new_title");
        localStorage.setItem("print_ems_manpower_daily_new_datas", JSON.stringify(printdata));
        let printpagetitle = `Daily Manpower Report For  ${_todays}`;
        localStorage.setItem("print_ems_manpower_daily_new_title", printpagetitle)
        window.open(`${api_pms}/print/manpower/indexnew.html`, '_blank', "width = '1300px', height = '700px'");
    }
    //date time picker config
}